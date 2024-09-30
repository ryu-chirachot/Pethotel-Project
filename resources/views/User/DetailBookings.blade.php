@extends ('layouts.navbar')
@section('content')


<link rel="stylesheet" href="{{asset("/css/detailbooking.css")}}">



<style>
  
</style>
<div class="container">
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
                <p><strong >ชื่อสัตว์เลี้ยง:</strong> 
                @foreach($booking->user->pets as $pet)
                {{$pet->Pet_name}}
                @endforeach
                </p><hr>
                <p><strong>วันที่เข้าพัก:</strong> {{ $booking->Start_date }} <strong>ถึง</strong> {{ $booking->End_date }}</p><hr>
                <p><strong>ห้องพัก:</strong> {{ $booking->room->pet_Type_Room_Type->roomType->Rooms_type_name }}</p><hr>
                <p><strong>วันที่จอง:</strong> {{ $booking->Booking_date }}</p><hr>
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
                <a href="{{ route('review', $booking->BookingOrderID) }}" class="btn btn-secondary" style="pointer-events: none; ">รีวิว</a>
                <a href="{{ route('bookings.show', $booking->BookingOrderID) }}" class="btn btn-primary">ดูรายละเอียด</a>
            @else
                <a href="{{ route('review', $booking->BookingOrderID) }}" class="btn btn-success">รีวิว</a>
                <a href="{{ route('bookings.show', $booking->BookingOrderID) }}" class="btn btn-primary">ดูรายละเอียด</a>
            @endif

            </div>
            @elseif($booking->Booking_status == 3)
                <span class="status-checkout">
                        ยกเลิกการจองแล้ว
                    </span>
                    </p><hr>
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
                <a href="{{ route('bookings.show', $booking->BookingOrderID) }}" class="btn btn-primary">ดูรายละเอียด</a>
            </div>
            @endif
        </div>
        @endforeach
    @endif

    
</div>

@endsection