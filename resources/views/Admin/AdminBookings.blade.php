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
            position: relative;
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
        .view-details-btn {
            position: absolute;
            bottom: 10px;
            right: 10px;
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }
        .view-details-btn:hover {
            background-color: #45a049;
        }
    </style>
</head>
<div class="display-inline text-center my-1">
    <h3><b>รายการจอง</b></h3>
</div>

<div class="container">
    
    @foreach ($bookings as $bk)
    <h1>รายละเอียดการจอง</h1>
    <div class="reservation">
        <p>ชื่อผู้จอง: {{$bk->user->name}}</p>
        <p>1 ผู้เข้าพัก | {{$countDates[$bk->BookingOrderID]}} คืน</p>
        <p>วันที่เข้าพัก: {{ $bk->Start_date }} ถึง {{ $bk->End_date }}</p>
        <p>ห้องพัก: {{ $bk->room->pet_Type_Room_Type->roomType->Rooms_type_name }}</p>
        <p>หมายเลขการจอง: <span class="booking-code">{{ $bk->BookingOrderID }}</span></p>
        <b>สถานะ : {{$bk->PaymentDate ? 'ชำระเงินแล้ว' : 'รอยืนยันการชำระเงิน'}}</b>
        <a href="{{ route('Admin.bookings.detail', $bk->BookingOrderID) }}" class="view-details-btn">ดูรายละเอียด</a>
    </div>
    @endforeach
</div>
@endsection
