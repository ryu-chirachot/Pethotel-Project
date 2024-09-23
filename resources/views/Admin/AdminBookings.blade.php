@extends('layouts.AdminSidebar')

@section('content')
<head>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        .reservation {
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 20px;
        }
        .reservation h2 {
            font-size: 18px;
            color: #333;
        }
        .booking-code {
            background-color: #ffd700;
            padding: 5px;
            font-weight: bold;
            border-radius: 5px;
        }
    </style>
</head>
    <div class="container">
        @foreach ($bookings as $bk)
        <h1>รายละเอียดการจอง</h1>
        <div class="reservation">
            <p>1 ผู้เข้าพัก | {{$countDates[$bk->BookingOrderID]}} คืน</p> <!-- แสดงจำนวนคืน -->
            <p>วันที่เข้าพัก: {{ $bk->Start_date }} ถึง {{ $bk->End_date }}</p> <!-- แสดงวันที่เข้าพัก -->
            
            <p>ห้องพัก: {{ $bk->room->pet_Type_Room_Type->roomType->Rooms_type_name }}</p> <!-- แสดงชื่อห้องพัก -->
            <p>หมายเลขการจอง: <span class="booking-code">{{ $bk->BookingOrderID }}</span></p> <!-- แสดงหมายเลขการจอง -->
        </div>
        @endforeach
    </div>
@endsection
