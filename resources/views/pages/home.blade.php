@extends('layout.app')

@section('content')
@include('layout.navbar')
<section class="pb-5">
    <div class="container pt-2">
        <div class="row align-items-center justify-content-center mb-5">
            <div class="col-12 col-md-10 col-lg-8 text-center mb-5 mb-lg-0">
                <h2 class="fw-bold mb-3">Find Your Ideal Ride</h2>
                <p class="lead text-muted mb-4">Browse through our wide selection of cars and book the perfect vehicle for your needs.</p>
{{--                <a class="btn bg-gradient-primary" href="{{url('/rentals')}}">Browse Cars</a>--}}
            </div>
        </div>
    </div>
</section>


<section class="py-5">
    <div class="container">
        <h2 class="fw-bold text-center mb-5">Available Cars</h2>
        <div class="row">
            @foreach($cars as $car)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="{{ $car->car_image }}" class="card-img-top" alt="{{ $car->brand }} {{ $car->model }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $car->brand }} {{ $car->model }}</h5>
                            <p class="card-text">Daily Rent: ${{ $car->daily_rent_price }}</p>
                            <a href="{{ url('/cars/'.$car->id) }}" class="btn btn-primary">Details</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<footer class="py-5 bg-light">
    <div class="container text-center pb-5 border-bottom">
        <a class="d-inline-block mx-auto mb-4" href="#">
            <img class="img-fluid"src="{{asset('/images/car-logo.jpg')}}" alt="" width="96px">
        </a>
        <ul class="d-flex flex-wrap justify-content-center align-items-center list-unstyled mb-4">
            <li><a class="link-secondary me-4" href="#">Login</a></li>
            <li><a class="link-secondary" href="#">Rentals</a></li>
        </ul>
        <div>
            <a class="d-inline-block me-4" href="#">
                <img src="{{asset('/images/facebook.svg')}}">
            </a>
            <a class="d-inline-block me-4" href="#">
                <img src="{{asset('/images/twitter.svg')}}">
            </a>
        </div>
    </div>
    <div class="container">
        <p class="text-center">All rights reserved © Car Rental 2023-2024</p>
    </div>
</footer>


@endsection
