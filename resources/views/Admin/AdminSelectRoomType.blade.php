@extends('layouts.AdminSidebar')

@section('content')
@if (session('success'))
    <script>
        Swal.fire({
  title: "ทำรายการสำเร็จ",
  text: "{{ session('success') }}",
  icon: "success"
});
    </script>
@endif
<div class="container">
    <div class="row">
        <div class="col-12">
            <h2 class="my-4">เลือกประเภทห้องพัก</h2>
            <form action="{{ route('Admin.rooms.create') }}" method="GET">
                <div class="form-group mb-3">
                    <label>ประเภทสัตว์เลี้ยง *</label>
                    <div class="input-group">
                        <select name="pet_type" class="form-control" required>
                            @foreach ($Pet_types as $pt)
                            <option value="{{ $pt->Pet_nametype }}">{{ $pt->Pet_nametype }}</option>
                            @endforeach
                        </select>
                        <div class="input-group-append">
                            <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#addPetTypeModal">
                                เพิ่มประเภทสัตว์เลี้ยง
                            </button>
                        </div>
                    </div>
                </div>

                <div class="form-group mb-3">
                    <label>ประเภทห้อง *</label>
                    <div class="input-group">
                        <select name="room_type" class="form-control" required>
                            @foreach ($Room_types as $room_type)
                            <option value="{{ $room_type->Rooms_type_name }}">{{ $room_type->Rooms_type_name }}</option>
                            @endforeach
                        </select>
                        <div class="input-group-append">
                            <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#addRoomTypeModal">
                                เพิ่มประเภทห้อง
                            </button>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">ดำเนินการต่อ</button>
                    <a href="{{ route('Admin.rooms') }}" class="btn btn-secondary">ยกเลิก</a>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal ประเภทสัตว์ -->
<div class="modal fade" id="addPetTypeModal" tabindex="-1" aria-labelledby="addPetTypeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addPetTypeModalLabel">เพิ่มประเภทสัตว์เลี้ยง</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('Admin.petTypes.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="new_pet_type">ชื่อประเภทสัตว์เลี้ยง</label>
                        <input type="text" class="form-control" id="new_pet_type" name="new_pet_type" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                    <button type="submit" class="btn btn-primary">บันทึก</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal for adding new room type -->
<div class="modal fade" id="addRoomTypeModal" tabindex="-1" aria-labelledby="addRoomTypeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addRoomTypeModalLabel">เพิ่มประเภทห้อง</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('Admin.roomTypes.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="new_room_type">ชื่อประเภทห้อง</label>
                        <input type="text" class="form-control" id="new_room_type" name="new_room_type" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                    <button type="submit" class="btn btn-primary">บันทึก</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    
    $('#addPetTypeModal, #addRoomTypeModal').on('hidden.bs.modal', function () {
        location.reload();
    });
    
</script>

@endsection

