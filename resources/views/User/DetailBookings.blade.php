@extends('layouts.navbar')
@section('content')

<link rel="stylesheet" href="{{asset("/css/detailbooking.css")}}">

<div class="container" id="container">
    <h1 class="text-center mb-3">รายการจองห้องพักสัตว์เลี้ยงของคุณ</h1>

    @if($bookings->isEmpty())
        <div class="alert alert-warning" role="alert">
            คุณยังไม่มีการจองในขณะนี้
        </div>
    
    @else
        @foreach ($bookings as $booking)
            <div class="card">
                <div class="card-header">
                    หมายเลขการจอง: <span class="badge-booking-code">{{ $booking->BookingOrderID }}</span>
                </div>
                <div class="card-body">
                    <p><strong>ชื่อผู้จอง:</strong> {{$booking->user->name}}</p><hr>
                    <p><strong>ชื่อสัตว์เลี้ยง:</strong> 
                        {{ $booking->pet ? $booking->pet->Pet_name : 'ไม่มีข้อมูลสัตว์เลี้ยง' }}
                    </p><hr>
                    <p><strong>วันที่เข้าพัก:</strong> {{ $booking->Start_date }} <strong>ถึง</strong> {{ $booking->End_date }}</p><hr>
                    <p><strong>ห้องพัก:</strong> {{ $booking->room->roomType->Rooms_type_name }} </p><hr>
                    <p><strong>หมายเลขห้อง:</strong> {{ $booking->room->Rooms_id }}</p><hr>
                    <p><strong>วันที่จอง:</strong> {{ $booking->created_at }}</p><hr>
                    <p><strong>สถานะการจอง:</strong> 
                    @if($booking->deleted_at)
                        <span class="status-checkout">
                            เช็คเอาท์
                        </span>
                    </p><hr>
                    <p><strong>สถานะการชำระเงิน:</strong>
                        <span class="{{ $booking->PaymentDate ? 'text-success' : 'payment-pending' }}">
                            {{ $booking->PaymentDate ? 'ชำระเงินแล้ว' : 'รอยืนยันการชำระเงิน' }}
                        </span>
                    </p><hr>
                </div>

                <div class="card-footer text-right">
                @if($booking->review)
                    <a href="{{ route('historyreview', $booking->BookingOrderID) }}" class="btn btn-secondary">ประวัติการรีวิว</a>
                    <a href="{{ route('pets.status',$booking->BookingOrderID) }}" class="btn btn-info me-2">ติดตามสถานะสัตว์เลี้ยง</a>
                @else
                    <a href="{{ route('review', $booking->BookingOrderID) }}" class="btn btn-success">รีวิว</a>
                    <a href="{{ route('pets.status',$booking->BookingOrderID) }}" class="btn btn-info me-2">ติดตามสถานะสัตว์เลี้ยง</a>
                @endif

                </div>
                @elseif($booking->Booking_status == 3)
                    <span class="status-checkout">
                            ยกเลิกการจองแล้ว
                        </span>
                        </p><hr>
                    <p><strong>สถานะการชำระเงิน:</strong>
                        <span class="payment-pending">
                            คืนเงินแล้ว
                        </span>
                    </p>
                @elseif($booking->Booking_status == 0)  
                    <span class="{{ $booking->Booking_status == 0 ? 'status-checkout' : 'status-check' }}">
                            {{ $booking->Booking_status == 0 ? 'รอการยืนยัน' : 'เช็คอินแล้ว' }}
                        </span>
                        </p><hr>
                        
                        <p><strong>สถานะการชำระเงิน:</strong>
                            <span class="{{ $booking->PaymentDate ? 'text-success' : 'payment-pending' }}">
                                {{ $booking->PaymentDate ? 'ชำระเงินแล้ว' : 'รอยืนยันการชำระเงิน' }}
                            </span>
                        </p>
                    </div>
                @else
                    <span class="{{ $booking->Booking_status == 0 ? 'status-checkout' : 'status-check' }}">
                        {{ $booking->Booking_status == 0 ? 'รอการยืนยัน' : 'เช็คอินแล้ว' }}
                    </span>
                    </p><hr>
                    
                    <p><strong>สถานะการชำระเงิน:</strong>
                        <span class="{{ $booking->PaymentDate ? 'text-success' : 'payment-pending' }}">
                            {{ $booking->PaymentDate ? 'ชำระเงินแล้ว' : 'รอยืนยันการชำระเงิน' }}
                        </span>
                    </p>
                </div>
                <div class="card-footer text-center">
                    <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#extendModal">
                        <i class="fas fa-calendar-plus me-2"></i>ขยายเวลาการพัก
                    </button>
                    <a href="{{ route('pets.status',$booking->BookingOrderID) }}" class="btn btn-info me-2">ติดตามสถานะสัตว์เลี้ยง</a>
                </div>
                    
                @endif
            </div>
            
        @endforeach
    @endif

    
</div>

        <!-- ขยายการจอง -->
        <div class="modal fade" id="extendModal" tabindex="-1" aria-labelledby="extendModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="extendModalLabel">ขยายเวลาการจอง</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('bookings.extend', $booking->BookingOrderID) }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="new_end_date" class="form-label">วันที่สิ้นสุดใหม่</label>
                                @php
                                    $minDate = \Carbon\Carbon::parse($booking->End_date)->addDay()->format('Y-m-d');
                                @endphp
                                <input type="date" class="form-control" id="new_end_date" name="new_end_date" min="{{ $minDate }}" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                            <button type="submit" class="btn btn-primary">ยืนยันการขยายเวลา</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

@endsection