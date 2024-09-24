<<<<<<< HEAD
@extends('layouts.AdminSidebar')

@section('content')
<div class="container">
    
    <h1>Report for Booking #{{ $booking->BookingOrderID }}</h1>
    

    <form action="{{ $booking->Booking_status == 2 ? route('Admin.checkout') : route('Admin.report') }}" method="POST">
        @csrf
        @foreach ($petstatus as $pt)
        <input type="hidden" name="status_id" value="{{ $pt->PetStatusID }}">
        @endforeach
        <input type="hidden" name="booking_id" value="{{ $booking->BookingOrderID }}">
        <div class="form-group">
            <label for="customer_name">ชื่อผู้จอง:</label>
            <input type="text" class="form-control" id="customer_name" value="{{ $booking->user->name }}" disabled>
        </div>

        <div class="form-group">
            <label for="pet_name">ชื่อสัตว์เลี้ยง:</label>
            <input type="text" class="form-control" id="pet_name" value="{{ $booking->pet->Pet_name }}" disabled>
        </div>

        <div class="form-group">
            <label for="room_type">ประเภทห้อง:</label>
            <input type="text" class="form-control" id="room_type" value="{{ $booking->room->pet_Type_Room_Type->roomType->Rooms_type_name }}" disabled>
        </div>

        <div class="form-group">
            <label for="pet_type">ประเภทสัตว์เลี้ยง:</label>
            <input type="text" class="form-control" id="pet_type" value="{{ $booking->room->pet_Type_Room_Type->petType->Pet_nametype }}" disabled>
        </div>

        <div class="form-group">
            <label for="breed">สายพันธุ์:</label>
            <input type="text" class="form-control" id="breed" value="{{ $booking->pet->Pet_breed }}" disabled>
        </div>

        <div class="form-group">
            <label for="check_in">วันเช็คอิน:</label>
            <input type="text" class="form-control" id="check_in" value="{{ $booking->Start_date }}" disabled>
        </div>

        <div class="form-group">
            <label for="check_out">วันเช็คเอาท์:</label>
            <input type="text" class="form-control" id="check_out" value="{{ $booking->End_date }}" disabled>
        </div>

        <div class="form-group">
            @if($booking->Booking_status == 2)
            <label for="report">รายงานการจองให้ วันเช็คเอาท์:</label>
            @else
            <label for="report">รายงานสถานะสัตว์เลี้ยง:</label>
            @endif
            <textarea name="report" id="report" class="form-control" rows="5" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary">รายงานข้อมูล</button>
=======
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
>>>>>>> boss
    </form>
</div>
@endsection
