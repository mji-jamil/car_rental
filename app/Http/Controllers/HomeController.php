<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    function HomePage(){
//        return view('pages.home');
        $cars = Car::all();
        return view('pages.home', compact('cars'));
    }
}
