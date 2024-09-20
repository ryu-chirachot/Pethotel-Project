@extends('layouts.AdminSidebar')

@section('content')
<?php
// ตัวอย่างรายการจอง
$bookings = [
    [
        'name' => 'คุณ ดวงใจ ใจดี',
        'nights' => 1,
        'check_in' => '15 สิงหาคม',
        'check_out' => '16 สิงหาคม',
        'room' => 'Standard Room',
        'booking_code' => 'OR12569722564874456'
    ],
// เพิ่มการจองเพิ่มเติมตามความจำเป็น
];

?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pawsome Stay Hotel System</title>
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
<body>
    <div class="container">
        <h1>รายละเอียดการจอง</h1>
        
        <?php foreach ($bookings as $booking): ?>
        <div class="reservation">
            <h2><?php echo $booking['name']; ?></h2>
            <p>1 ผู้เข้าพัก | <?php echo $booking['nights']; ?> คืน</p>
            <p>วันที่เข้าพัก: <?php echo $booking['check_in']; ?> ถึง <?php echo $booking['check_out']; ?></p>
            <p>ห้องพัก: <?php echo $booking['room']; ?></p>
            <p>หมายเลขการจอง: <span class="booking-code"><?php echo $booking['booking_code']; ?></span></p>
        </div>
        <?php endforeach; ?>
        
    </div>
</body>
</html>
@endsection