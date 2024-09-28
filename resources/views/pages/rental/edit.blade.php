@extends('layout.app')

@section('content')
    <div class="container py-5">
        <h2>Edit Rental</h2>

        <form action="{{ route('rentals.update', $rental->id) }}" method="POST">
            @csrf
            @method('POST')
            <div class="mb-3">
                <label for="startDate" class="form-label">Start Date</label>
                <input type="date" name="rental_start_date" class="form-control" value="{{ $rental->rental_start_date }}" required>
            </div>
            <div class="mb-3">
                <label for="endDate" class="form-label">End Date</label>
                <input type="date" name="rental_end_date" class="form-control" value="{{ $rental->rental_end_date }}" required>
            </div>
            <div class="mb-3">
                <label for="totalCost" class="form-label">Total Cost</label>
                <input type="text" name="total_cost" class="form-control" value="{{ $rental->total_cost }}" readonly>
            </div>
            <button type="submit" class="btn btn-primary">Update Rental</button>
        </form>
    </div>
@endsection
