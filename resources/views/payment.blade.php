@extends('layouts.navbar')
@section('content')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<style>
     body {
            font-family: 'Kanit', sans-serif;
            background-color: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            max-width: 800px; /* ปรับขนาด container ให้แคบลง */
            padding: 0; 
        }
        .row {
            margin: 0 -5px; /* ลดระยะห่างระหว่างคอลัมน์ */
        }
        .col {
            padding: 0 5px; /* ลดระยะห่างภายในคอลัมน์ */
        }
        .room-section {
            background-color: #FEFCF4;
            border-radius: 10px;
            padding: 10px; 
            width: 100%;
        }
        
        .card {
            background-color: #FEFCF4;
            border-radius: 8px;
            border: none;
            box-shadow: 0 5px 5px rgba(0,0,0,0.1);
            padding: 20px;
            width: 300px;
            margin-left: auto;
            margin-right:auto ;
            margin: 10px 0 10px 0;
            
        }
       
        h2 {
            margin-top: 0;
            margin-bottom: 20px;
            font-size: 18px;
            font-weight: bold;
        }
        .date-range {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .date {
            text-align: center;
        }
        .date-label {
            font-size: 12px;
            color: #666;
        }
        .date-value {
            font-size: 16px;
            font-weight: bold;
        }
        .time {
            font-size: 14px;
            color: #666;
        }
        .info {
            border-top: 1px solid #eee;
            padding-top: 15px;
        }
        .info p {
            margin: 5px 0;
            font-size: 14px;
            
          
        }
        p{
            text-align: left;
        }
        .room-section{
            background-color: #FEFCF4;
            border-radius: 10px;
            padding: 20px ;
            width: 340px;
       
            
            
        }
        .total-wrapper {
            margin: 15px -20px;
            background-color: #FFE797;
        }
        .total {
            padding: 10px 20px;
            font-weight: bold;
            display: flex;
            justify-content: space-between;
        }
        .card{
            
            
            
        }
        .review-score{
            width: 35px;
            height: 35px;
            background-color: #FFD700;
            border-radius: 5px;
        }
        .payment-option {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }
        button{
            margin-top: 50px;
            width: 100px;
            margin-left: auto;
            margin-right: auto;
            padding: 5px;
            border: none;
            background-color: #FFD700;
            color: #6C620F;
            border-radius: 5px;
        }
       
       
</style>
<body>


<div class="container">
  <div class="row">
    <div class="col">
    <div class="room-section">
    <div class="card ">ห้อง
        <h2>{{$roomTypeName}}</h2>
        <div class="review-score"></div> <br>
        เครื่องปรับอากาศ <br>
        น้ำดื่ม <br>
        เบาะนอน <br>
        ลานสำหรับวิ่ง 
      </div>
      <div class="card">
        <h2>รายละเอียดการจอง</h2>
        <div class="date-range">
            <div class="date">
                <div class="date-label">เช็คอิน</div>
                <div class="date-value">{{$checkIn}}</div>
                <div class="time">ตั้งแต่ 14:00</div>
            </div>
            <div class="date">
                <div class="date-label">เช็คเอาท์</div>
                <div class="date-value">{{$checkOut}}</div>
                <div class="time">ถึง 12:00</div>
            </div>
        </div>
    </div>
    </div>
    </div>
    <div class="col">
    <div class="room-section">
    <div class="card">
        <h2>สรุปราคา</h2>
        <p>ราคา/ห้อง</p>
        <div class="total-wrapper">
            <div class="total">
                <span>ยอดรวม</span>
                <span>THB 300.00</span>
            </div>
        </div>
        <h2>ช่องทางการชำระเงิน</h2>
        <div class="payment-option">
            <label for="cash">เงินสด</label>
            <input type="radio" id="cash" name="payment" value="cash">
        </div>
        <div class="payment-option">
            <label for="promptpay">พร้อมเพย์</label> 
            <input type="radio" id="promptpay" name="payment" value="promptpay"> 
        </div>
        <input<b>ยืนยัน</b></button>
 
       
    </div>
    </div>
    
</body>
</html>