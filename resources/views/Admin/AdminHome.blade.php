@extends('layouts.AdminSidebar')

@section('content')
<div class="container">
    <div class="display-inline text-center my-4">
        <h3><b>หน้าแรก</b></h3>
    </div>

    <!-- Dashboard Cards Overview -->
    <div class="row text-center">
        <!-- Bookings Card -->
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card bg-info text-white h-100">
                <div class="card-body">
                    <h5 class="card-title">การจอง</h5>
                    <p class="card-text text-center mb-1">การจองวันนี้: {{count($TodayBookings)}}</p>
                    <p class="card-text text-center mb-1">การจองทั้งหมด: {{count($Bookings)}}</p>
                </div>
                <div class="card-footer">
                    <a href="{{ route('Admin.bookings') }}" class="text-white">ดูรายละเอียด &rarr;</a>
                </div>
            </div>
        </div>

        <!-- Available Rooms Card -->
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card bg-success text-white h-100">
                <div class="card-body">
                    <h5 class="card-title">ห้องที่ยังว่างอยู่</h5>
                    <p class="card-text">ว่าง: {{count($AvailableRooms)}} / {{count($Rooms)}}</p>
                </div>
                <div class="card-footer">
                    <a href="{{ route('Admin.rooms') }}" class="text-white">ดูรายละเอียด &rarr;</a>
                </div>
            </div>
        </div>

        <!-- Pets Staying Card -->
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card bg-warning text-white h-100">
                <div class="card-body">
                    <h5 class="card-title">สัตว์เลี้ยง</h5>
                    <p class="card-text">สัตว์เลี้ยงทั้งหมด: {{count($Petbooking)}}</p>
                </div>
                <div class="card-footer">
                    <a href="{{ route('Admin.pets') }}" class="text-white">ดูรายละเอียด &rarr;</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Additional Information -->
    <div class="row">
        <!-- Recent Bookings -->
        <div class="col-lg-6 mb-4">
            <div class="card">
                <div class="card-header">
                    <h5>การจองล่าสุด</h5>
                </div>
                <div class="card-body">
                    <ul>
                        @foreach($Bookings as $booking)
                        <li> <b>ห้องหมายเลข</b>  #{{$booking->BookingOrderID}}- <b>ชื่อผู้จอง</b> {{$booking->user->name}}</li>
                        @endforeach
                    </ul>
                    <a href="{{ route('Admin.bookings') }}">ดูรายละเอียด &rarr;</a>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
