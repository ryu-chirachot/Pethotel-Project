@extends('layouts.AdminSidebar')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <h2 class="my-4">เพิ่มห้องพักใหม่</h2>

                @if(isset($images) && count($images) > 0)
                <form action="{{ route('Admin.rooms.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <!-- Room Images --> 
                    <label>รูปภาพ ห้องพัก *</label>
                    <div class="form-group mb-3" id="form">
                        @for ($i = 0; $i <= 5; $i++)
                            <div class="room-image-upload">
                                <img id="previewImage{{ $i }}" class="img-fluid rounded" src="{{ asset('images/'.$images[$i]) }}">
                                <input type="file" name="room_image[]" id="roomImageInput{{ $i }}" accept="image/*" onchange="previewImage(this, '{{ $i }}')" disabled>
                            </div>
                        @endfor
                    </div>
                        <!-- Room Details -->
                        <div class="form-group mb-3">
                            <label>จำนวนห้องที่ต้องการเพิ่ม *</label>
                            <input type="number" name="room_count" class="form-control" min="1" value="1" required>
                        </div>
                        <div class="form-group mb-3">
                            <label>สถานะห้อง *</label>
                            <select name="room_status" class="form-control">
                                <option value="1">ว่าง</option>
                                <option value="0">ไม่ว่าง</option>
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label>ประเภทสัตว์เลี้ยง *</label>
                            <input type="text" name="pet_type" class="form-control" value="{{ $pettypename }}" readonly>
                            <input type="hidden" name="pet_type_hidden" value="{{ $selectedPetType }}">
                        </div>

                        <div class="form-group mb-3">
                            <label>ประเภทห้อง *</label>
                            <input type="text" name="room_type" class="form-control" value="{{ $roomtypename }}" readonly>
                            <input type="hidden" name="room_type_hidden" value="{{ $selectedRoomType }}">
                        </div>

                        <div class="form-group mb-3">
                            <label>ราคาห้องต่อคืน *</label>
                            <input type="number" name="room_price" class="form-control" value="{{$petRoomType->Room_price}}" readonly>
                        </div>

                        <div class="form-group mb-3">
                            <label>รายละเอียดห้อง *</label>
                            <textarea name="room_description" class="form-control" rows="3"  readonly>{{$petRoomType->Rooms_type_description}}</textarea>
                        </div>

                        
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">เพิ่มห้องพัก</button>
                            <a href="{{ route('Admin.rooms.type') }}" class="btn btn-secondary">ยกเลิก</a>
                        </div>
                    </form>
                @else
                    <form action="{{ route('Admin.rooms.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                    <!-- Room Images --> 
                    <label>รูปภาพ ห้องพัก *</label>
                    <div class="form-group mb-3" id="form">
                        @for ($i = 1; $i <= 6; $i++)
                            <div class="room-image-upload empty">
                                <img id="previewImage{{ $i }}" class="img-fluid rounded">
                                <input type="file" name="room_image[]" id="roomImageInput{{ $i }}" accept="image/*" onchange="previewImage(this, '{{ $i }}')" required>
                            </div>
                        @endfor
                    </div>

                    <!-- Room Details -->
                    <div class="form-group mb-3">
                        <label>จำนวนห้องที่ต้องการเพิ่ม *</label>
                        <input type="number" name="room_count" class="form-control" min="1" value="1" required>
                    </div>

                    <div class="form-group mb-3">
                        <label>สถานะห้อง *</label>
                        <select name="room_status" class="form-control">
                            <option value="1">ว่าง</option>
                            <option value="0">ไม่ว่าง</option>
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label>ประเภทสัตว์เลี้ยง *</label>
                        <input type="text" name="pet_type" class="form-control" value="{{ $pettypename }}" readonly>
                        <input type="hidden" name="pet_type_hidden" value="{{ $selectedPetType }}">
                    </div>

                    <div class="form-group mb-3">
                        <label>ประเภทห้อง *</label>
                        <input type="text" name="room_type" class="form-control" value="{{ $roomtypename }}" readonly>
                        <input type="hidden" name="room_type_hidden" value="{{ $selectedRoomType }}">
                    </div>

                    <div class="form-group mb-3">
                        <label>ราคาห้องต่อคืน *</label>
                        <input type="number" name="room_price" class="form-control" required>
                    </div>

                    <div class="form-group mb-3">
                        <label>รายละเอียดห้อง *</label>
                        <textarea name="room_description" class="form-control" rows="3" required></textarea>
                    </div>

                    
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">เพิ่มห้องพัก</button>
                        <a href="{{ route('Admin.rooms.type') }}" class="btn btn-secondary">ยกเลิก</a>
                    </div>
                </form>
                @endif
        </div>
    </div>
</div>

<script src="{{ asset('js/Addimg.js') }}"></script>
@endsection