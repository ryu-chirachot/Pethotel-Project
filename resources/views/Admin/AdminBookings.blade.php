@extends('layouts.AdminSidebar')

@section('content')
<head>
    <style>
        /* สไตล์เพิ่มเติมสำหรับหน้า Admin จอง */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
        }

        .container {
            max-width: 900px;
            margin-top: 20px;
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

        .card-footer {
            display: flex;
            justify-content: flex-end;
            background-color: #f8f9fa;
            border-bottom-left-radius: 10px;
            border-bottom-right-radius: 10px;
        }

        .badge-booking-code {
            background-color: #ffc107;
            color: #333;
            font-weight: bold;
            padding: 0.5em 0.75em;
            font-size: 14px;
            border-radius: 5px;
        }

        .btn-custom {
            background-color: #007bff;
            color: white;
            border-radius: 30px;
            padding: 10px 20px;
            font-size: 14px;
            transition: background-color 0.3s ease;
        }

        .btn-custom:hover {
            background-color: #0056b3;
        }

        .card-footer {
            background-color: #f8f9fa;
            border-bottom-left-radius: 10px;
            border-bottom-right-radius: 10px;
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
</head>
@if( session('success'))
<script>
        Swal.fire({
  title: "ขยายระยะเวลาการจอง",
  text: "ของคุณ {{ session('success') }} สำเร็จ",
  icon: "success"
});
    </script>
@endif
@if( session('checkout'))
<script>
        Swal.fire({
  title: "เช็คเอาท์สำเร็จ",
  text: "ของคุณ {{ session('checkout') }} สำเร็จ",
  icon: "success"
});
    </script>
@endif

<div class="container">
<div class="row">
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3 class="mb-0"><b>รายการจองทั้งหมด</b></h3>
                <input type="text" class="form-control w-25" right="0px" id="search" placeholder="พิมพ์เพื่อค้นหา..." onkeyup="searchTable()">
            </div>
    

    @if($bookings->isEmpty())
        <div class="alert alert-warning" role="alert">
            ยังไม่มีการจองในเข้ามาในขณะนี้
        </div>
    @else
    @foreach ($bookings as $booking)
    <div class="card">
        <div class="card-header">
            หมายเลขการจอง: <span class="badge-booking-code">{{ $booking->BookingOrderID }}</span>
        </div>
        <div class="card-body">
            <p><strong>ชื่อผู้จอง:</strong> {{$booking->user->name}}</p><hr>
            <p><strong>ชื่อสัตว์เลี้ยง:</strong> {{ $booking->pet->Pet_name }}</p><hr>
            <p><strong>วันที่เข้าพัก:</strong> {{ $booking->Start_date }} <strong>ถึง</strong> {{ $booking->End_date }}</p><hr>
            <p><strong>ห้องพัก:</strong> {{ $booking->room->pet_Type_Room_Type->roomType->Rooms_type_name }}</p><hr>
            <p><strong>วันที่จอง:</strong> {{ $booking->Booking_date }}</p><hr>
            <p><strong>สถานะการจอง:</strong> 
            @if($booking->deleted_at)
            <span class="badge bg-danger">
                    เช็คเอาท์
                </span>
            </p><hr>
                <p><strong>สถานะการชำระเงิน:</strong>
                    <span class="{{ $booking->PaymentDate ? 'badge bg-success' : 'badge bg-secondary' }}">
                    {{$booking->PaymentDate ? 'ชำระเงินแล้ว' : 'รอยืนยันการชำระเงิน'}}
                    </span>
                </p><hr>
            </div>
            <div class="card-footer">
                <a href="{{ route('Admin.bookings.detail', $booking->BookingOrderID) }}" class="btn btn-custom" disabled>ดูรายละเอียด</a>
            </div>
            @else
                <span class="{{ $booking->Booking_status == 1 ? 'badge bg-success' : 'badge bg-secondary' }}">
                    {{ $booking->Booking_status == 1 ? 'เช็คอินแล้ว' : 'รอการยืนยัน' }}
                </span>
            </p><hr>
            
            <p><strong>สถานะการชำระเงิน:</strong>
                <span class="{{ $booking->PaymentDate ? 'badge bg-success' : 'badge bg-secondary' }}">
                    {{$booking->PaymentDate ? 'ชำระเงินแล้ว' : 'รอยืนยันการชำระเงิน'}}
                </span>
            </p><hr>
        </div>
        <div class="card-footer text-right">
            <a href="{{ route('Admin.bookings.detail', $booking->BookingOrderID) }}" class="btn btn-custom">ดูรายละเอียด</a>
        </div>
        @endif
    </div>
    @endforeach
    @endif
</div>
<script>
    function searchTable() {
        var input = document.getElementById("search").value.toLowerCase();
        var cards = document.querySelectorAll(".card"); // เลือกทุกการ์ด
        
        cards.forEach(function(card) {
            var cardText = card.innerText.toLowerCase(); // นำข้อความทั้งหมดในการ์ดมาใช้ในการค้นหา
            if (cardText.includes(input)) {
                card.style.display = ""; // แสดงการ์ด
            } else {
                card.style.display = "none"; // ซ่อนการ์ด
            }
        });
    }
</script>

@endsection
