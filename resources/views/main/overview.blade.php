@extends('layouts.Navbar')
@section('content')
<!-- ส่วนที่จะทำ -->
<style>
        body {
            font-family: 'Kanit', sans-serif;
            background-color: #f4f4f4;
            margin:2 ;
            padding: 20px;
        }
        .booking-summary {
            background-color: white;
            max-width: 500px;
            margin: 0 auto;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }
        .detail-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            border-bottom: 1px solid #eee;
            padding-bottom: 5px;
        }
        .detail-label {
            font-weight: bold;
            color: #555;
        }
        .detail-value {
            color: #333;
            word-wrap: break-word;
            white-space: pre-line;
            max-width: 15em;
        }
        .buttons {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }
        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }
        .btn-back {
            background-color: #6c757d;
            color: white;
        }
        .btn-confirm {
            background-color: #28a745;
            color: white;
        }
        .btn:hover {
            opacity: 0.9;
        }
        
    </style>

<body>
    <div class="booking-summary">
        <h1>รายละเอียดการจอง</h1>
        <div class="detail-row">
            <span class="detail-label">ประเภทห้อง:</span>
            <span class="detail-value">Standard Room</span>
        </div>
        <div class="detail-row">
            <span class="detail-label">เช็คอิน:</span>
            <span class="detail-value">18/09/2024</span>
        </div>
        <div class="detail-row">
            <span class="detail-label">เช็คเอาท์:</span>
            <span class="detail-value">20/09/2024</span>
        </div>
        <div class="detail-row">
            <span class="detail-label">ชื่อของสัตว์เลี้ยง:</span>
            <span class="detail-value">{{$p_name}}</span>
        </div>
        <div class="detail-row">
            <span class="detail-label">ประเภทสัตว์เลี้ยง:</span>
            <span class="detail-value">บลาๆๆ</span>
        </div>
        <div class="detail-row">
            <span class="detail-label">สายพันธุ์:</span>
            <span class="detail-value">{{$p_breed}}</span>
        </div>
        <div class="detail-row">
            <span class="detail-label">อายุ:</span>
            <span class="detail-value">{{$p_age}}</span>
        </div>
        <div class="detail-row">
            <span class="detail-label">น้ำหนัก:</span>
            <span class="detail-value">{{$p_weight}}</span>
        </div>
        <div class="detail-row">
            <span class="detail-label">เพศ:</span>
            <span class="detail-value">{{$p_gender}}</span>
        </div>
        <div class="detail-row">
            <span class="detail-label">ประวัติการฉีดวัคซีน:</span>
            <span class="detail-value">ชื่อวัคซีนที่เลือก</span>
        </div>
        <div class="detail-row">
            <span class="detail-label">คำแนะนำเพิ่มเติม:</span>
            <span class="detail-value">{{$p_description}}</span>
        </div>
        <div class="buttons">
            <button class="btn btn-back" onclick="history.back()">แก้ไขข้อมูล</button>
            <button class="btn btn-confirm" onclick="location.href='payment.html'">ยืนยันและชำระเงิน</button>
        </div>
    </div>
    </body>
    @section('title','สรุป')
@endsection