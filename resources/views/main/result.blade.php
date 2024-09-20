@extends('layouts.searchbar')
@section('content')
<!-- ส่วนที่จะทำ -->
<head>
    <link rel="stylesheet" href="/css/result.css">
</head>

@if($rooms->isEmpty())
    <div class="container">
    
        <div class="room-card">
        
            
            
            <div class="room-details">
                <div class="room-header">
                    <h2 class="room-title">
                    
                        <p>ไม่พบห้องที่ว่าง</p>
                   
                    </div>
                    @else
                    </h2>
                    <span class="room-availability">{{$count}}</span>
                <div>
                <p class="room-description">Standard Room </p>
                <div class="room-amenities">
                    

                </div>
                <button class="book-button">จอง</button>
            </div>
        </div>
        <!-- ถ้าเป็นห้องคนละประเภทให้ทำเป็นอีกบล็อก (ลูปสร้างทั้งบล็อก) -->
         @endif
</body>
</html>
@section('title','ผลการค้นหา')
@endsection
