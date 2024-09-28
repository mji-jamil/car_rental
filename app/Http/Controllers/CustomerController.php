<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CustomerController extends Controller
{
    function CustomerPage(): View
    {
        return view('pages.dashboard.customer-page');
    }

    function CustomerList(Request $request)
    {
        return User::where('role', 'customer')->get();
    }

    function CustomerCreate(Request $request)
    {
        try {
            User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => $request->input('password'),
                'mobile' => $request->input('mobile'),
                'address' => $request->input('address'),
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Customer created successfully'
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Customer creation failed: ' . $e->getMessage()
            ], 500);
        }

    }

    function CustomerDelete(Request $request, $id)
    {
        $customer = User::find($id);

        if (!$customer) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Customer not found'
            ], 404);
        }

        $customer->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Customer deleted successfully'
        ]);

    }

    public function CustomerUpdate(Request $request, $id)
    {
        $customer = User::find($id);

        if (!$customer) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Customer not found'
            ], 404);
        }

        $customer->update($request->only('name', 'email', 'mobile', 'address'));

        return response()->json([
            'status' => 'success',
            'message' => 'Customer updated successfully'
        ]);
    }

    public function getCustomerById($id)
    {
        $customer = User::find($id);

        if (!$customer) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Customer not found'
            ], 404);
        }

        return response()->json($customer);
    }
}
