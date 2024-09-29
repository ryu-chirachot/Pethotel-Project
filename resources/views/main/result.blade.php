@extends('layouts.searchbar')

@section('title', 'ผลการค้นหา')

@section('content')

    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">

    <div class="container mt-4">
    @foreach ($groupedRooms as $roomTypeName => $roomGroup)
    <div class="card mx-auto mb-4" style="max-width: 720px;">
        <div class="card-header bg-warning text-white d-flex justify-content-between align-items-center">
            <h5>{{ $roomGroup->first()->pet_Type_Room_Type->roomType->Rooms_type_name }}</h5>
            <span class="badge bg-success">ว่าง {{ $roomCounts[$roomTypeName] }} ห้อง</span>
        </div>
        <div class="card-body">
        {{-- ลูปแสดงรูปภาพจากตัวแปร $img เฉพาะที่มี Rooms_type_id ตรงกับห้องปัจจุบัน --}}
            <div class="row g-1">
                @foreach ($img->where('Rooms_type_id', $roomGroup->first()->pet_Type_Room_Type->Rooms_type_id) as $item)
                    @php
                        // แยกชื่อไฟล์รูปภาพที่คั่นด้วย comma
                        $images = explode(',', $item->image->ImagesPath);
                    @endphp

                    @foreach ($images as $image)
                        <div class="col-md-4">
                            <img src="{{ asset('/images/' . trim($image)) }}" class="img-fluid" alt="Room Image">
                        </div>
                    @endforeach
                @endforeach
            </div>
        </div>

        <p class="card-text small mb-3 m-3">
            คำอธิบายห้อง: {{ $roomGroup->first()->pet_Type_Room_Type->Rooms_type_description }}
        </p>
        <form action="{{ route('info') }}" method="get" class="booking-form">
            
            @foreach ($roomGroup as $room)
                <input type="hidden" name="room_id" value="{{ $room->Rooms_id }}">
                <input type="hidden" name="pet_type_id" value="{{ session('pet_type_id') }}">
                <input type="hidden" name="check_in" value="{{ session('check_in') }}">
                <input type="hidden" name="check_out" value="{{ session('check_out') }}">
                <input type="hidden" name="room_type_name" value="{{ $roomGroup->first()->pet_Type_Room_Type->roomType->Rooms_type_name }}">
                <input type="hidden" name="room_type_id" value="{{ $roomGroup->first()->pet_Type_Room_Type->roomType->Rooms_type_id }}">
            @endforeach
            <button type="submit" class="btn btn-success float-end">จองเลย</button>  
        </form>
    </div>
    @endforeach
</div>
@endsection