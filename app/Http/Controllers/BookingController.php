<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Rental;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Validator;


class BookingController extends Controller
{
    public function showCarDetails(Request $request,$id)
    {
        $car = Car::findOrFail($id);
        $userId = $request->cookie('user_id');
        return view('pages.cars.show', compact('car', 'userId'));
    }

    public function bookCar(Request $request)
    {
        $car = Car::find($request->car_id);
        if (!$car->availability_status) {
            return response()->json([
                'status' => 'error',
                'message' => 'Car is not available for booking.',
            ], 400);
        }

        Rental::create([
            'customer_id' => $request->input('customer_id'),
            'car_id' => $request->input('car_id'),
            'rental_start_date' => $request->input('rental_start_date'),
            'rental_end_date' => $request->input('rental_end_date'),
            'total_cost' => $request->input('total_cost')
        ]);

        $car->availability_status = 0;
        $car->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Car booked successfully!',
        ], 201);
    }

    public function index()
    {

        $userId = Cookie::get('user_id');

        $rentals = Rental::where('customer_id', $userId)->get();

        return view('pages.rental.index', compact('rentals'));
    }

    public function edit($id)
    {
        $rental = Rental::findOrFail($id);
        return view('pages.rental.edit', compact('rental'));
    }

    public function update(Request $request, $id)
    {
        $rental = Rental::findOrFail($id);
        $rental->rental_start_date = $request->rental_start_date;
        $rental->rental_end_date = $request->rental_end_date;
        $rental->total_cost = $request->total_cost;
        $rental->save();

        return redirect()->route('pages.rental.index')->with('success', 'Rental updated successfully.');
    }

    public function destroy($id)
    {
        Rental::destroy($id);
        return redirect()->route('pages.rental.index')->with('success', 'Rental deleted successfully.');
    }


}
