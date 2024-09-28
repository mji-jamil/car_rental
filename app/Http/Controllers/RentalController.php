<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Rental;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class RentalController extends Controller
{
    public function RentalPage(): View
    {
        return view('pages.dashboard.rental-page');
    }

    public function getCarPrice($id)
    {
        $car = Car::find($id);
        if ($car) {
            return response()->json(['daily_rent_price' => $car->daily_rent_price], 200);
        }

        return response()->json(['message' => 'Car not found'], 404);
    }
//    public function createRental(Request $request)
//    {
//        $validator = Validator::make($request->all(), [
//            'car_id' => 'required|exists:cars,id',
//            'customer_id' => 'required|exists:users,id',
//            'rental_start_date' => 'required|date',
//            'rental_end_date' => 'required|date|after:rental_start_date',
//            'total_cost' => 'required|numeric',
//        ]);
//
//        if ($validator->fails()) {
//            return response()->json(['errors' => $validator->errors()], 422);
//        }
//
//        $rental = Rental::create($request->all());
//
//        return response()->json([
//            'status' => 'success',
//            'message' => 'Rental created successfully',
//            'rental' => $rental
//        ], 201);
//    }
    public function createRental(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'car_id' => 'required|exists:cars,id',
            'customer_id' => 'required|exists:users,id',
            'rental_start_date' => 'required|date',
            'rental_end_date' => 'required|date|after:rental_start_date',
            'total_cost' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $isRented = Rental::where('car_id', $request->car_id)
            ->where(function ($query) use ($request) {
                $query->whereBetween('rental_start_date', [$request->rental_start_date, $request->rental_end_date])
                    ->orWhereBetween('rental_end_date', [$request->rental_start_date, $request->rental_end_date]);
            })
            ->exists();

        if ($isRented) {
            return response()->json(['error' => 'Car is not available during the selected dates.'], 400);
        }

        $rental = Rental::create($request->all());


        $car = Car::find($request->car_id);
        $car->availability_status = 0;
        $car->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Rental created successfully',
            'rental' => $rental
        ], 201);
    }

    public function listRentals()
    {
        return Rental::with(['car:id,name,brand', 'user:id,name'])
            ->get()
            ->map(function ($rental) {
                return [
                    'id' => $rental->id,
                    'customer_name' => $rental->user->name ?? 'N/A',
                    'car_name' => $rental->car->name ?? 'N/A',
                    'car_brand' => $rental->car->brand ?? 'N/A',
                    'rental_start_date' => $rental->rental_start_date,
                    'rental_end_date' => $rental->rental_end_date,
                    'total_cost' => $rental->total_cost,
                    'status' => $rental->status,
                    'car_id' => $rental->car_id,
                    'customer_id' => $rental->customer_id
                ];
            });
    }

    public function listUsersId()
    {
        return response()->json(User::select('id', 'name')->get());
    }

    public function listCarsId()
    {
        return response()->json(Car::select('id', 'name', 'brand')
            ->where('availability_status', 1)
            ->get());
    }

    public function getRentalById($id)
    {
        $rental = Rental::with('car', 'customer')->find($id);

        if (!$rental) {
            return response()->json(['status' => 'failed', 'message' => 'Rental not found'], 404);
        }

        return response()->json($rental);
    }


    public function updateRental(Request $request, $id)
    {
        $rental = Rental::find($id);

        if (!$rental) {
            return response()->json(['status' => 'failed', 'message' => 'Rental not found'], 404);
        }

        $rental->update($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Rental updated successfully'
        ], 200);
    }

    // Delete a rental
    public function deleteRental($id)
    {
        $rental = Rental::find($id);

        if (!$rental) {
            return response()->json(['status' => 'failed', 'message' => 'Rental not found'], 404);
        }

        $rental->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Rental deleted successfully'
        ], 200);
    }
}
