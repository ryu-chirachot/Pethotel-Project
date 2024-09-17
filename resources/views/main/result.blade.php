@extends('layouts.searchbar')
@section('content')
<!-- ส่วนที่จะทำ -->
<head>
    <link rel="stylesheet" href="/css/result.css">
</head>
<body>
    <div class="container">
        <div class="room-card">
            <div class="room-images">
                <img src="room-image-1.jpg" alt="Room image 1" class="room-image">
                <img src="room-image-2.jpg" alt="Room image 2" class="room-image">
                <img src="room-image-3.jpg" alt="Room image 3" class="room-image">
            </div>
            <div class="room-details">
                <div class="room-header">
                    <h2 class="room-title">
                    @if($rooms->isEmpty())
                        <p>No rooms found for the selected pet type.</p>
                    <!-- elseif($rooms->ประเภทห้อง=อะไรให้เอาค่านั้นมาใส่) --> 
                    @else
                    </h2>
                    <span class="room-availability">{{$count}}</span>
                    
                </div>
                <p class="room-description">Standard Room ที่ออกแบบมาเพื่อตอบโจทย์สัตว์เลี้ยงของคุณ โดยมีสิ่งอำนวยความสะดวกครบครันที่ตอบสนองความต้องการของสัตว์เลี้ยง ทั้งยังมีความปลอดภัยสูงเพื่อให้คุณมั่นใจได้เต็มที่ รวมถึงมีพื้นที่สำหรับทำกิจกรรมและออกกำลัง นอกจากนี้ยังมีระบบถ่ายเทอากาศให้มีอิเล็กทรอนกลิ่นตลอดเวลาเช่นกัน</p>
                <div class="room-amenities">
                    <div class="amenity">
                        <img src="ac-icon.png" alt="AC icon" class="amenity-icon">
                        <span>เครื่องปรับอากาศ</span>
                    </div>
                    <div class="amenity">
                        <img src="bed-icon.png" alt="Bed icon" class="amenity-icon">
                        <span>เบาะนอน</span>
                    </div>
                    <div class="amenity">
                        <img src="water-icon.png" alt="Water icon" class="amenity-icon">
                        <span>น้ำดื่ม</span>
                    </div>
                    <div class="amenity">
                        <img src="camera-icon.png" alt="Camera icon" class="amenity-icon">
                        <span>สามารถรับชมวีดีโอได้</span>
                    </div>
                </div>
                <button class="book-button">จอง</button>
            </div>
        </div>
        <!-- ถ้าเป็นห้องคนละประเภทให้ทำเป็นอีกบล็อก (ลูปสร้างทั้งบล็อก) -->
         @endif
</body>
</html>
@endsection