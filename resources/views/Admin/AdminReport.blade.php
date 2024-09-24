@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Report for Booking #{{ $booking->id }}</h1>

    <form action="{{ route('admin.report.submit') }}" method="POST">
        @csrf
        <input type="hidden" name="booking_id" value="{{ $booking->id }}">

        <div class="form-group">
            <label for="customer_name">Customer Name:</label>
            <input type="text" class="form-control" id="customer_name" value="{{ $booking->customer->name }}" disabled>
        </div>

        <div class="form-group">
            <label for="pet_name">Pet Name:</label>
            <input type="text" class="form-control" id="pet_name" value="{{ $booking->pet->name }}" disabled>
        </div>

        <div class="form-group">
            <label for="room_type">Room Type:</label>
            <input type="text" class="form-control" id="room_type" value="{{ $booking->room->type }}" disabled>
        </div>

        <div class="form-group">
            <label for="pet_type">Pet Type:</label>
            <input type="text" class="form-control" id="pet_type" value="{{ $booking->pet->type }}" disabled>
        </div>

        <div class="form-group">
            <label for="breed">Breed:</label>
            <input type="text" class="form-control" id="breed" value="{{ $booking->pet->breed }}" disabled>
        </div>

        <div class="form-group">
            <label for="check_in">Check-in Date:</label>
            <input type="text" class="form-control" id="check_in" value="{{ $booking->check_in }}" disabled>
        </div>

        <div class="form-group">
            <label for="check_out">Check-out Date:</label>
            <input type="text" class="form-control" id="check_out" value="{{ $booking->check_out }}" disabled>
        </div>

        <div class="form-group">
            <label for="report">Report:</label>
            <textarea name="report" id="report" class="form-control" rows="5" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Submit Report</button>
    </form>
</div>
@endsection
