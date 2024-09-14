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
            <h2 class="my-4">เพิ่มห้องพักใหม่</h2>
            <form action="{{ route('Admin.rooms.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <!-- Room Images -->
                <div class="form-group mb-3">
                    <label>รูปภาพ ห้องพัก *</label>
                    <div class="d-flex gap-3">
                        <div class="room-image-upload">
                            <input type="file" name="room_image" id="imageInput" accept="image/*" class="form-control" required>
                            <img id="previewImage" class="img-fluid rounded mt-3" alt="Room Image" style="display:none;" width="200px" height="300px">
                        </div>
                    </div>
                </div>

                <!-- Room Details -->
                <div class="form-group mb-3">
                    <label>หมายเลขห้อง *</label>
                    <input type="text" name="room_number" class="form-control" required>
                </div>

                <div class="form-group mb-3">
                    <label>สถานะห้อง *</label>
                    <select name="room_status" class="form-control" required>
                        <option value="1">ว่าง</option>
                        <option value="0">ไม่ว่าง</option>
                    </select>
                </div>

                    <div class="form-group mb-3">
                    <label>ประเภทสัตว์เลี้ยง *</label>
                    <select name="pet_type" class="form-control" required>
                        @foreach ($Pet_types as $pt)
                        <option value="{{$pt->Pet_nametype}}">{{$pt->Pet_nametype}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group mb-3">
                    <label>ประเภทห้อง *</label>
                    <select name="room_type" class="form-control" required>
                        @foreach ($Room_types as $room_type)
                        <option value="{{$room_type->Rooms_type_name}}"> {{$room_type->Rooms_type_name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group mb-3">
                    <label>ราคาห้องต่อคืน *</label>
                    <input type="number" name="room_price" class="form-control" required>
                </div>

                <div class="form-group mb-3">
                    <label>รายละเอียดห้อง *</label>
                    <textarea name="room_description" class="form-control" rows="3"></textarea>
                </div>

                <!-- Submit Button -->
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">เพิ่มห้องพัก</button>
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
