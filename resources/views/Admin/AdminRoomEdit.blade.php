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
                <!-- รูป -->
                <div class="form-group mb-3">
                    <label>รูปภาพ ห้องพัก</label>
                    <div class="form-group mb-3" id="form">
                    @for ($i = 0; $i < 6; $i++)
                        <div class="room-image-upload {{ isset($images[$i]) ? '' : 'empty' }}">
                                <img id="previewImage{{ $i }}" 
                                    class="img-fluid rounded"
                                    src="{{ asset('images/'.$images[$i]) }}"
                                    alt="Room Image {{ $i+1 }}">
                                
                                <input type="file" name="room_image[]" 
                                    id="roomImageInput{{ $i }}" 
                                    accept="image/*" 
                                    onchange="previewImage(this, '{{ $i }}')" >
                        </div>
                    @endfor
                    </div>
                </div>

                <!-- รายละเอียด -->
                <div class="form-group mb-3">
                    <label>หมายเลขห้อง *</label>
                    <input type="text" name="room_num" class="form-control" value="{{ $RoomID->Rooms_id }}" disabled>
                    <input type="hidden" name="room_number" value="{{ $RoomID->Rooms_id }}">

                </div>

                <div class="form-group mb-3">
                    <label>สถานะห้อง *</label>
                    <select name="room_status" class="form-control" required>
                        <option value="1" {{ $RoomID->Rooms_status == 1 ? 'selected' : '' }}>ว่าง</option>
                        <option value="0" {{ $RoomID->Rooms_status == 0 ? 'selected' : '' }}>ไม่ว่าง</option>
                        <option value="2" {{ $RoomID->Rooms_status == 2 ? 'selected' : '' }}>ซ่อมบำรุง</option>
                        <option value="3" {{ $RoomID->Rooms_status == 3 ? 'selected' : '' }}>ทำความสะอาด</option>
                    </select>
                </div>

                <div class="form-group mb-3">
                    <label>ประเภทสัตว์เลี้ยง *</label>
                    <select name="pet_type" class="form-control" >
                        @foreach ($petType as $pt)
                        <option value="{{ $pt->Pet_nametype }}" {{ $RoomID->petType->Pet_nametype == $pt->Pet_nametype ? 'selected' : ''}}>{{ $pt->Pet_nametype }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group mb-3">
                    <label>ประเภทห้อง *</label>
                    <select name="room_type" class="form-control" >
                        @foreach ($roomType as $rt)
                        <option value="{{$rt->Rooms_type_name}}" {{ $RoomID->roomType->Rooms_type_name == $rt->Rooms_type_name ? 'selected': '' }} > {{$rt->Rooms_type_name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group mb-3">
                    <label>ราคาห้องต่อคืน *</label>
                    <input type="number" name="room_price" class="form-control" value="{{ $RoomID->Room_price}}" >
                </div>

                <div class="form-group mb-3">
                    <label>รายละเอียดห้อง *</label>
                    <textarea name="room_description" class="form-control" rows="3">{{ $RoomID->Rooms_type_description }}</textarea>
                </div>

                <!-- บันทึก -->
                <div class="form-group">
                    <button type="submit" class="btn btn-success">บันทึกการเปลี่ยนแปลง</button>
                    <a href="{{ route('Admin.rooms') }}" class="btn btn-secondary">ยกเลิก</a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function previewImage(input, imageNumber) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('previewImage' + imageNumber).src = e.target.result;
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection