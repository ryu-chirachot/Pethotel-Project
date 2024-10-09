@extends('layouts.AdminSidebar')
@section('content')

<div class="container-fluid py-4">
    @if($bookings->isEmpty())
        <div class="alert alert-warning" role="alert">
            ไม่พบข้อมูลการจองของผู้ใช้
        </div>
    @else
        <div class="card mb-3">
            <div class="card-header">
                <h5 class="mb-0">รายละเอียดผู้ใช้: {{ $bookings->first()->user->name }}</h5> <!-- ใช้ข้อมูลผู้ใช้จาก booking -->
            </div>
            <div class="card-body">
                <h6 class="font-weight-bold">ข้อมูลสัตว์เลี้ยง ทั้งหมด </h6>
                
                <ul class="list-group mb-3">
                    @foreach($Own_pet as $booking)
                        <li class="list-group-item">
                            <strong>ชื่อ:</strong> {{ $booking->Pet_name }} 
                            <strong>ประเภท:</strong> {{ $booking->petType->Pet_nametype }} 
                            <strong>สายพันธุ์:</strong> {{ $booking->Pet_breed }}
                        </li>
                    @endforeach
                </ul>

                <h6 class="font-weight-bold">ประวัติการจอง (ทั้งหมด {{ $bookings->count() }} รายการ)</h6>
                <ul class="list-group">
                    @foreach($bookings as $booking)
                        <li class="list-group-item">
                            <strong>หมายเลขการจอง:</strong> #{{ $booking->BookingOrderID }}<br>
                            <strong>วันที่จอง:</strong> {{$booking->created_at}}
                            <br>
                            <strong>สถานะ:</strong> 
                            @if($booking->trashed())
                                <span class="text-success">เช็คเอาท์</span>
                            @elseif($booking->Booking_status == 3)
                                <span class="text-danger">ยกเลิกแล้ว</span>
                            @elseif($booking->Booking_status == 0)
                                <span class="text-warning">รอการยืนยัน</span>
                            @else
                                <span class="text-primary">ยืนยันแล้ว</span>
                            @endif 
                            <br>
                            <strong>สัตว์ที่เข้าพัก: </strong>{{ $booking->pet->Pet_name }} 
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif
</div>

@endsection
