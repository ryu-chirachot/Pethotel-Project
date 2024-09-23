<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('css/payment.css') }}">
</head>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Fredoka:wght@300..700&display=swap');
    
    
    .navbar-nav {
        margin-left: auto;
        margin-right: auto;
        }
        .navbar-brand{
        margin-left: 10px;
        font-family: "Fredoka", sans-serif;    
        font-weight: bold;
        left: 10px;
        font-size: 22px; 
        

        }
        .navbar {
        background-color: #FFE797;
        padding: 30px 0 30px 0;
    }
        .navbar-nav {
        position: absolute;
        left: 50%;
        transform: translateX(-50%);
    }
    .nav-item{
        font-family: "Fredoka", sans-serif;   
        font-size: 22px; 

    }
    .room-sections-wrapper {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 60px;
        }
    
 
        
</style>
<body>
<nav class="navbar navbar-expand-lg">
  <div class="container-fluid ">
    <div class="paw"> 
    <a class="navbar-brand" href="#">Pawsome Stay Hotel</a>
    </div>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Booking</a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="#">Contact</a>
        </li>
        
      </ul>
    </div> 
  </div>
</nav>


<div class="container-fluid" id="section">
        <div class="room-sections-wrapper">
            <div class="room-section">
                <div class="card">ห้อง
                    <h2>Room Type</h2>
                    <div class="review-score"></div><br>
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
                            <div class="date-value">จันทร์ 15 ส.ค 2024</div>
                            <div class="time">ตั้งแต่ 14:00</div>
                        </div>
                        <div class="date">
                            <div class="date-label">เช็คเอาท์</div>
                            <div class="date-value">อังคาร 16 ส.ค 2024</div>
                            <div class="time">ถึง 14:00</div>
                        </div>
                    </div>
                    <div class="info">
                        <p>ระยะเวลาการเข้าพัก : <br> <b></b></p>
                        <hr>
                        <p>ท่านเลือก : <br> <b></b> </p>
                    </div>
                </div>
            </div>
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
                   
                </div>
                <button><b>ยืนยัน</b></button>
            </div>
            
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
</body>
</html>