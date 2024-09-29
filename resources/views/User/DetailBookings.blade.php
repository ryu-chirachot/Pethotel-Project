@extends ('layouts.navbar')
@section('content')

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
                <p><strong>ชื่อสัตว์เลี้ยง:</strong> 
                @foreach($booking->user->pets as $pet)
                {{ $pet->Pet_name}}
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

            @else
                <span class="{{ $booking->Booking_status == 0 ? 'status-checkout' : 'status-check' }}">
                    {{ $booking->Booking_status == 0 ? 'รอการยืนยัน' : 'เช็คอินแล้ว' }}
                </span>
                </p><hr>
                
                <p><strong>สถานะการชำระเงิน:</strong>
                    <span class="{{ $booking->PaymentDate ? 'text-success' : 'payment-pending' }}">
                        {{ $booking->PaymentDate ? 'ชำระเงินแล้ว' : 'รอยืนยันการชำระเงิน' }}
                    </span>
                </p><hr>
            </div>
            <div class="card-footer text-right">
                <a href="{{ route('bookings.show', $booking->BookingOrderID) }}" class="btn btn-primary">ดูรายละเอียด</a>
            </div>
            @endif
        </div>
        @endforeach
    @endif
</div>
<style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
            padding-top: 0;
        }

        .container {
            padding-top: 10px;
            max-width: 900px;
        }

        .card {
            margin-bottom: 20px;
            border-radius: 10px;
            border: none;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: #343a40;
            color: white;
            font-size: 18px;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }

        .card-body {
            font-size: 16px;
        }

        .badge {
            background-color: #ffc107;
            color: #333;
            font-weight: bold;
            padding: 0.5em 0.75em;
        }

        /* .btn-custom {
            background-color: #007bff;
            color: white;
            border-radius: 30px;
            padding: 10px 20px;
            font-size: 14px;
            transition: background-color 0.3s ease;
        }

        .btn-custom:hover {
            background-color: #0056b3;
        } */

        .card-footer {
            background-color: #f8f9fa;
            border-bottom-left-radius: 10px;
            border-bottom-right-radius: 10px;
        }

        .card-footer .btn {
            margin-left: 10px; /* เว้นระยะระหว่างปุ่ม */
        }

        .status-check {
            font-weight: bold;
            color: #28a745;
        }

        .status-checkout {
            font-weight: bold;
            color: #dc3545;
        }

        .payment-pending {
            font-weight: bold;
            color: #ffc107;
        }
    </style>
@endsection