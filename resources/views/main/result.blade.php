@extends('layouts.searchbar')
@section('content')
@foreach($groupedRooms as $roomTypeName => $roomGroup)
<!-- ส่วนที่จะทำ -->
<head>
 <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
</head>
<body>
<div class="container mt-4">
        <!-- ลูปเพื่อแสดงห้องที่ค้นเจอ -->
        @foreach($roomGroup as $room)
        <div class="card mx-auto mb-4" style="max-width: 540px;">
            <div class="card-header bg-warning text-white d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0"> {{ $roomTypeName }} </h5>
                <span class="badge bg-success">ว่าง{{$count}} ห้อง</span> <!-- ตัวอย่างการใช้จำนวนห้อง -->
            </div>
            <div class="card-body">
                <div class="row g-2 mb-3">
                    <!-- ตัวอย่างภาพห้อง -->
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
                <p class="card-text small mb-3">
                     คำอธิบายห้อง
                     {{$room->pet_Type_Room_Type->Rooms_type_description}}
                </p>
                <a  type="button" href="{{route('info')}}" class="btn btn-success float-end">จองเลย</a>
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
        
        @endforeach
        
    @endforeach 

</div>
@section('title','ผลการค้นหา')
@endsection
