@extends('layouts.searchbar')
@section('content')
<head>
 <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
</head>
<div class="container mt-4">
    <!-- วนลูปแต่ละประเภทห้อง -->
    @foreach($groupedRooms as $roomTypeName => $roomGroup)
    <div class="card mx-auto mb-4" style="max-width: 540px;">
        <div class="card-header bg-warning text-white d-flex justify-content-between align-items-center">
        {{ $roomGroup->first()->pet_Type_Room_Type->roomType->Rooms_type_name }} <!-- แสดงชื่อประเภทห้อง -->
        </h5>
        <span class="badge bg-success">ว่าง {{ $roomCounts[$roomTypeName] }} ห้อง</span> <!-- แสดงจำนวนห้องในประเภท -->
        </div>
        
            <div class="row g-2 mb-3">
                <!-- รูปภาพห้อง -->
                <div class="col-4">
                    <img src="https://via.placeholder.com/300x200" alt="Room view 1" class="img-fluid rounded">
                </div>
                <div class="col-4">
                    <img src="https://via.placeholder.com/300x200" alt="Room view 2" class="img-fluid rounded">
                </div>
                <div class="col-4">
                    <img src="https://via.placeholder.com/300x200" alt="Room view 3" class="img-fluid rounded">
                </div>
            </div>
        <div class="card-body">
            <p class="card-text small mb-3">
            
                คำอธิบายห้อง: {{ $roomGroup->first()->pet_Type_Room_Type->Rooms_type_description }}
                <!-- แสดงคำอธิบายห้องจากห้องแรกในประเภทนั้น -->
                
            </p>
            <form action="{{ route('info') }}" method="POST" class="booking-form">
                @csrf
                @foreach($rooms as $room)
                    <input type="hidden" name="room_id" value="{{$room->Rooms_id}}">
                    <input type="hidden" name="pet_type_id" value="{{ session('pet_type_id') }}">
                    <input type="hidden" name="check_in" value="{{ session('check_in') }}">
                    <input type="hidden" name="check_out" value="{{ session('check_out') }}">
                    <input type="hidden" name="room_type_name" value="{{ $roomGroup->first()->pet_Type_Room_Type->roomType->Rooms_type_name }}">
                    <input type="hidden" name="room_type" value="{{ $roomGroup->first()->pet_Type_Room_Type->roomType->Rooms_type_id }}">
                @endforeach<!--  ปิดลูปไอดีห้อง -->
                <button type="submit" class="btn btn-success float-end">จองเลย</a>  
            </form>
            </div>
                <div class="card-footer bg-light">
                    <div class="d-flex justify-content-center">
                        <div class="d-flex align-items-center mx-2">
                            <i class="bi bi-fan me-1"></i>
                            <small>เครื่องปรับอากาศ</small>
                        </div>
                        <div class="d-flex align-items-center mx-2">
                            <i class="bi bi-moon me-1"></i>
                            <small>เบาะนอน</small>
                        </div>
                        <div class="d-flex align-items-center mx-2">
                            <i class="bi bi-droplet me-1"></i>
                            <small>น้ำดื่ม</small>
                        </div>
                        <div class="d-flex align-items-center mx-2">
                            <i class="bi bi-brush me-1"></i>
                            <small>อาบน้ำตัดขน</small>
                        </div>
                    </div>
                </div>
            </div>
        
    @endforeach <!-- ปิดลูปประเภทห้อง -->
</div>
@endsection


@section('title','ผลการค้นหา')
