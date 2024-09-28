@extends('layout.app')
@include('layout.navbar')
@section('content')
    <div class="container py-5">
        <h2>Your Rentals</h2>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table">
            <thead>
            <tr>
                <th>Car</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Total Cost</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($rentals as $rental)
                <tr>
                    <td>{{ $rental->car->brand }} {{ $rental->car->model }}</td>
                    <td>{{ $rental->rental_start_date }}</td>
                    <td>{{ $rental->rental_end_date }}</td>
                    <td>${{ $rental->total_cost }}</td>
                    <td>
{{--                        <a href="{{ route('pages.rental.edit', $rental->id) }}" class="btn btn-warning">Edit</a>--}}
                        <form action="{{ route('pages.rental.delete', $rental->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
