@extends('layout.app')
@include('layout.navbar')

@section('content')
    <div class="container py-5">
        <h2 class="fw-bold">{{ $car->brand }} {{ $car->model }}</h2>
        <img src="{{ $car->car_image }}" class="img-fluid mb-4" alt="{{ $car->brand }} {{ $car->model }}">
        <p>Year: {{ $car->year_of_manufacture }}</p>
        <p>Type: {{ $car->car_type }}</p>
        <p>Daily Rent Price: ${{ $car->daily_rent_price }}</p>
        <p>Status: {{ $car->availability_status == 1 ? 'Available' : 'Not Available' }}</p>

        @if($car->availability_status == 1)
            @if(Cookie::has('token'))
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#bookingModal">Book Now</button>
            @else
                <a href="{{ url('/userLogin') }}" class="btn btn-primary">Login to Book</a>
            @endif
        @else
            <button class="btn btn-secondary" disabled>Not Available</button>
        @endif
    </div>


    <!-- Booking Modal -->
    <div class="modal fade" id="bookingModal" tabindex="-1" aria-labelledby="bookingModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="bookingModalLabel">Book {{ $car->brand }} {{ $car->model }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="bookingForm">
                        <div class="mb-3">
                            <label for="startDate" class="form-label">Start Date</label>
                            <input type="date" class="form-control" id="startDate" required>
                        </div>
                        <div class="mb-3">
                            <label for="endDate" class="form-label">End Date</label>
                            <input type="date" class="form-control" id="endDate" required>
                        </div>
                        <div class="mb-3">
                            <label for="totalCost" class="form-label">Total Cost</label>
                            <input type="text" class="form-control" id="totalCost" name="total_cost" readonly>
                        </div>
                        <input type="hidden" id="carId" value="{{ $car->id }}">
                        <input type="hidden" id="userId" value="{{ $userId }}">

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="submitBooking()">Book</button>
                </div>
            </div>
        </div>
    </div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('startDate').addEventListener('change', calculateTotal);
        document.getElementById('endDate').addEventListener('change', calculateTotal);
    });

    function calculateTotal() {
        const startDate = new Date(document.getElementById('startDate').value);
        const endDate = new Date(document.getElementById('endDate').value);
        const dailyRentPrice = {{ $car->daily_rent_price }};

        if (startDate && endDate && startDate < endDate) {
            const timeDifference = endDate - startDate;
            const days = Math.ceil(timeDifference / (1000 * 3600 * 24));
            const totalCost = days * dailyRentPrice;

            document.getElementById('totalCost').value = `$${totalCost.toFixed(2)}`;
        } else {
            document.getElementById('totalCost').value = '';
        }
    }

    async function submitBooking() {
        const startDate = document.getElementById('startDate').value;
        const endDate = document.getElementById('endDate').value;
        const carId = document.getElementById('carId').value;
        const userId = document.getElementById('userId').value;
        const totalCost = document.getElementById('totalCost').value.replace('$', '').trim();

        if (!startDate || !endDate || !carId || !userId || !totalCost) {
            alert('Please fill all fields before booking.');
            return;
        }

        if (!confirm(`Are you sure you want to book the car from ${startDate} to ${endDate}?`)) {
            return;
        }
        const bookingData = {
            rental_start_date: startDate,
            rental_end_date: endDate,
            car_id: carId,
            customer_id: userId,
            total_cost: totalCost
        };

        console.log('Booking Data:', bookingData);

        try {
            const response = await axios.post('/book-car', bookingData);

            if (response.data.status === 'success') {
                alert('Car booked successfully!');
                window.location.reload();
            } else {
                alert('Error booking the car: ' + response.data.message);
            }
        } catch (error) {
            alert('An error occurred. Please try again.');
            console.error('Booking error:', error);
        }
    }
</script>
