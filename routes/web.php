<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RentalController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\TokenVerificationMiddleware;
use Illuminate\Support\Facades\Route;

// User api
Route::post('/user-registration',[UserController::class,'userRegistration']);
Route::post('/user-login',[UserController::class,'userLogin']);

// Page Routes
Route::get('/',[HomeController::class,'HomePage']);
Route::get('/userRegistration',[UserController::class,'registrationPage']);
Route::get('/userLogin',[UserController::class,'LoginPage']);
Route::get('/dashboard', [UserController::class, 'dashboardPage'])->middleware(TokenVerificationMiddleware::class);
Route::get('/customerPage',[CustomerController::class,'CustomerPage'])->middleware([TokenVerificationMiddleware::class]);
Route::get('/carPage',[CarController::class,'CarPage'])->middleware([TokenVerificationMiddleware::class]);
Route::get('/rentalPage',[RentalController::class,'RentalPage'])->middleware([TokenVerificationMiddleware::class]);

// Customer  API
Route::get("/list-customer",[CustomerController::class,'CustomerList'])->middleware([TokenVerificationMiddleware::class]);
Route::post("/delete-customer/{id}",[CustomerController::class,'CustomerDelete'])->middleware([TokenVerificationMiddleware::class]);
Route::post("/customer-by-id/{id}", [CustomerController::class, 'getCustomerById']);
Route::post("/update-customer/{id}", [CustomerController::class, 'CustomerUpdate'])->middleware([TokenVerificationMiddleware::class]);
Route::post("/create-customer",[CustomerController::class,'CustomerCreate'])->middleware([TokenVerificationMiddleware::class]);

// Car  API
Route::get("/list-car", [CarController::class, 'CarList'])->middleware([TokenVerificationMiddleware::class]);
Route::post("/delete-car/{id}", [CarController::class, 'CarDelete'])->middleware([TokenVerificationMiddleware::class]);
Route::post("/car-by-id/{id}", [CarController::class, 'getCarById']);
Route::post("/update-car/{id}", [CarController::class, 'CarUpdate'])->middleware([TokenVerificationMiddleware::class]);
Route::post("/create-car", [CarController::class, 'CarCreate'])->middleware([TokenVerificationMiddleware::class]);

// Rental API
Route::get("/list-rentals", [RentalController::class, 'listRentals'])->middleware([TokenVerificationMiddleware::class]);
Route::post("/create-rental", [RentalController::class, 'createRental'])->middleware([TokenVerificationMiddleware::class]);
Route::get("/rental-by-id/{id}", [RentalController::class, 'getRentalById'])->middleware([TokenVerificationMiddleware::class]);
Route::post("/update-rental/{id}", [RentalController::class, 'updateRental'])->middleware([TokenVerificationMiddleware::class]);
Route::post("/delete-rental/{id}", [RentalController::class, 'deleteRental'])->middleware([TokenVerificationMiddleware::class]);

Route::get("/list-cars-id", [RentalController::class, 'listCarsId'])->middleware([TokenVerificationMiddleware::class]);

Route::get("/list-users-id", [RentalController::class, 'listUsersId'])->middleware([TokenVerificationMiddleware::class]);
Route::get("/get-car-price/{carId}", [RentalController::class, 'getCarPrice'])->middleware([TokenVerificationMiddleware::class]);

Route::get('/summary', [UserController::class, 'getSummary'])->middleware([TokenVerificationMiddleware::class]);

Route::get('/logout',[UserController::class,'UserLogout']);
Route::get('/cars/{id}', [BookingController::class, 'showCarDetails'])->name('car.show');
Route::post('/book-car', [BookingController::class, 'bookCar']);

Route::get('/rentals', [BookingController::class, 'index'])->name('pages.rental.index');
Route::get('/rentals/{id}/edit', [BookingController::class, 'edit'])->name('pages.rental.edit');
Route::put('/rentals/{id}', [BookingController::class, 'update'])->name('pages.rental.update');
Route::delete('/rentals/{id}', [BookingController::class, 'destroy'])->name('pages.rental.delete');
