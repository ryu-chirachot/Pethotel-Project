@extends('layouts.AdminSidebar')

@section('content')
@if (session('error'))
    <script>
        alert("{{ session('error') }}");
    </script>
@endif
<div class="container">
    <div class="row">
        <div class="col-12">
            <h2 class="my-4">แก้ไขรายละเอียดห้องพัก #{{$RoomID->Rooms_id}}</h2>
            <form action="{{ route('rooms.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <!-- Room Images -->
                <div class="form-group mb-3">
                    <label>รูปภาพ ห้องพัก</label>
                    <div class="d-flex gap-3">
                    
                    <div class="room-image">
                        <img id="previewImage" src="{{ asset('images/'.$RoomID->petTypeRoomType->image->ImagesPath) }}" class="img-fluid rounded" alt="Room Image" width="200px" height="300px">
                    </div>
                        <div class="room-image-upload">
                            <input type="file" name="imgchange" id="imageInput" accept="image/*" class="form-control">
                        </div>
                    </div>
                </div>

                <!-- Room Details -->
                <div class="form-group mb-3">
                    <label>หมายเลขห้อง *</label>
                    <input type="text" name="room_number" class="form-control" value="{{ $RoomID->Rooms_id }}" required>
                </div>

                <div class="form-group mb-3">
                    <label>สถานะห้อง *</label>
                    <select name="room_status" class="form-control" required>
                        <option value="1" >ว่าง</option>
                        <option value="0" >ไม่ว่าง</option>
                    </select>
                </div>

                <div class="form-group mb-3">
                    <label>ประเภทสัตว์เลี้ยง *</label>
                    <select name="pet_type" class="form-control" required>
                        @foreach ($Rooms as $rm)
                        <option value="{{ $rm->petTypeRoomType->petType->Pet_nametype }}">{{ $rm->petTypeRoomType->petType->Pet_nametype }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group mb-3">
                    <label>ประเภทห้อง *</label>
                    <select name="room_type" class="form-control" required>
                        @foreach ($Rooms as $rm)
                        <option value="{{$rm->petTypeRoomType->roomType->Rooms_type_name}}"> {{$rm->petTypeRoomType->roomType->Rooms_type_name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group mb-3">
                    <label>ราคาห้องต่อคืน *</label>
                    <input type="number" name="room_price" class="form-control" value="{{ $RoomID->petTypeRoomType->Room_price}}" required>
                </div>

                <div class="form-group mb-3">
                    <label>รายละเอียดห้อง *</label>
                    <textarea name="room_description" class="form-control" rows="3">{{ $RoomID->petTypeRoomType->Rooms_type_description }}</textarea>
                </div>

                
                <!-- Submit Button -->
                <div class="form-group">
                    <button type="submit" class="btn btn-success">บันทึกการเปลี่ยนแปลง</button>
                    <a href="{{ route('Admin.rooms') }}" class="btn btn-secondary">ยกเลิก</a>
                </div>
                
            </form>
        </div>
    </div>
</div>
<script>
    const imageInput = document.getElementById('imageInput');
    const previewImage = document.getElementById('previewImage');

    imageInput.addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImage.src = e.target.result;
                previewImage.style.display = 'block';
            };
            reader.readAsDataURL(file);
        }
    });
</script>
@endsection

