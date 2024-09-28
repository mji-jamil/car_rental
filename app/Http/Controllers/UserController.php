<?php

namespace App\Http\Controllers;

use App\Helper\JWTToken;
use App\Models\Car;
use App\Models\Rental;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use function Pest\Laravel\get;

class UserController extends Controller
{
    public function userRegistration(Request $request): JsonResponse
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
                'message' => 'User registered successfully'
            ], 201);

        } catch (Exception $e) {
            return response()->json([
                'status' => 'failed',
                'message' => 'User registration failed: ' . $e->getMessage()
            ], 500);
        }
    }

    function registrationPage(): View
    {
        return view('pages.auth.registration-page');
    }

    function userLogin(Request $request): JsonResponse
    {
        $email = $request->input('email');
        $password = $request->input('password');
        $user = User::where('email', '=', $email)->first();
        $count = User::where('email', '=', $email)->where('password', '=', $password)->select('id')->first();
        if ($count !== null) {
            $token = JWTToken::createToken($email, $count->id);
            return response()->json([
                'status' => 'success',
                'message' => 'User login successfully',
                'user' => [
                    'id' => $user->id,
                    'role' => $user->role
                ]
            ], 200)
                ->cookie('token', $token, 60 * 24 * 30)->cookie('user_id', $user->id, 60 * 24 * 30);;
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'User login failed'
            ]);
        }
    }

    function LoginPage(): View
    {
        return view('pages.auth.login-page');
    }

    function dashboardPage(): View
    {
        return view('pages.dashboard.dashboard-page');
    }

    public function getSummary()
    {
        $totalCars = Car::count();
        $availableCars = Car::where('availability_status', 1)->count();
        $totalRentals = Rental::count();
        $totalEarnings = Rental::sum('total_cost');

        return response()->json([
            'totalCars' => $totalCars,
            'availableCars' => $availableCars,
            'totalRentals' => $totalRentals,
            'totalEarnings' => $totalEarnings,
        ]);
    }

    function UserLogout()
    {
        return redirect('/')->cookie('token', '', -1);
    }

}
