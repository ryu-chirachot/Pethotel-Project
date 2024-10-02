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
                    @foreach($bookings as $booking)
                        <li class="list-group-item">
                            <strong>ชื่อ:</strong> {{ $booking->pet->Pet_name }} 
                            <strong>ประเภท:</strong> {{ $booking->pet->petType->Pet_nametype }} 
                            <strong>สายพันธุ์:</strong> {{ $booking->pet->Pet_breed }}
                        </li>
                    @endforeach
                </ul>

                <h6 class="font-weight-bold">ประวัติการจอง (ทั้งหมด {{ $bookings->count() }} รายการ)</h6>
                <ul class="list-group">
                    @foreach($bookings as $booking)
                        <li class="list-group-item">
                            <strong>หมายเลขการจอง:</strong> #{{ $booking->BookingOrderID }}<br>
                            <strong>วันที่จอง:</strong> {{ $booking->PaymentDate ? $booking->PaymentDate : 'ยกเลิกการจองแล้ว'}}<br>
                            <strong>สถานะ:</strong> 
                            @if($booking->trashed())
                                <span class="text-success">เช็คเอาท์</span>
                            @elseif($booking->Booking_status == 3)
                                <span class="text-danger">ยกเลิกแล้ว</span>
                            @else
                                <span class="text-primary">ยืนยันแล้ว</span>
                            @endif
                            <br>
                            <strong>สัตว์ที่เข้าพัก: </strong> 
                            <p>{{ $booking->pet->Pet_name }}</p>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif
</div>

@endsection
