<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Exception;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CarController extends Controller
{
    // Display the car page
    public function CarPage(): View
    {
        return view('pages.dashboard.car-page');
    }

    // Get list of all cars
    public function CarList(Request $request)
    {
        return Car::all();
    }

    // Create a new car
    public function CarCreate(Request $request)
    {
        try {
            Car::create([
                'name' => $request->input('name'),
                'brand' => $request->input('brand'),
                'model' => $request->input('model'),
                'year_of_manufacture' => $request->input('year_of_manufacture'),
                'car_type' => $request->input('car_type'),
                'daily_rent_price' => $request->input('daily_rent_price'),
                'availability_status' => $request->input('availability_status'),
                'car_image' => $request->input('car_image')
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Car created successfully'
            ], 201);

        } catch (Exception $e) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Car creation failed: ' . $e->getMessage()
            ], 500);
        }
    }

    // Delete a car by id
    public function CarDelete(Request $request, $id)
    {
        $car = Car::find($id);

        if (!$car) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Car not found'
            ], 404);
        }

        $car->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Car deleted successfully'
        ]);
    }

    public function CarUpdate(Request $request, $id)
    {
        $car = Car::find($id);

        if (!$car) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Car not found'
            ], 404);
        }

        $car->update($request->only(
            'name',
            'brand',
            'model',
            'year_of_manufacture',
            'car_type',
            'daily_rent_price',
            'availability_status',
            'car_image'
        ));

        return response()->json([
            'status' => 'success',
            'message' => 'Car updated successfully'
        ], 201);
    }

    public function getCarById($id)
    {
        $car = Car::find($id);

        if (!$car) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Car not found'
            ], 404);
        }

        return response()->json($car);
    }
}
