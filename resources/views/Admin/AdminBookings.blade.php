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
            <h2></h2>
            <p>ดึงDB ผู้เข้าพัก | ดึงDB คืน</p>
            <p>วันที่เข้าพัก: ดึงDB ถึง ดึงDB</p>
            <p>ห้องพัก: ดึงDB</p>
            <p>หมายเลขการจอง: <span class="booking-code">ดึงDB</span></p>
        </div>
        @endforeach
    </div>
@endsection