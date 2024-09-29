@extends('layouts.navbar')
@section('title','สัตว์เลี้ยงของฉัน')
@section('content')
<div class="container mt-4">
    <h2 class="text-center mb-4">สัตว์เลี้ยงของฉัน</h2>

    @if($pets->isEmpty())
        <p class="text-center text-danger">ไม่มีประวัติสัตว์เลี้ยงของคุณ</p>
    @else
        <table class="table table-bordered table-hover text-center">
            <thead class="table-dark">
                <tr>
                    
                    <th>ประเภทสัตว์เลี้ยง</th>
                    <th>ชื่อสัตว์เลี้ยง</th>
                    <th>เพศ</th>
                    <th>สายพันธุ์</th>
                    <th>อายุ</th>
                    <th>น้ำหนัก</th>
                    <th>คำแนะนำ</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($pets as $pet)
                <tr>
                    
                    <td>{{ $pet->petType->Pet_nametype }}</td>
                    <td>{{ $pet->Pet_name }}</td>
                    <td>{{ $pet->Pet_gender == 'M' ? 'ชาย' : 'หญิง' }}</td>
                    <td>{{ $pet->Pet_breed }}</td>
                    <td>{{ $pet->Pet_age }} ปี</td>
                    <td>{{ $pet->Pet_weight }} kg</td>
                    <td>{{ $pet->additional_info ?? 'ไม่มี' }}</td>
                    <td>
                        <!-- ปุ่มสำหรับเปิด modal -->
<button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editPetModal{{$pet->Pet_id}}">
    แก้ไข
</button>
</td>
</tr>

<!-- Modal สำหรับแก้ไขสัตว์เลี้ยง -->
<div class="modal fade" id="editPetModal{{$pet->Pet_id}}" tabindex="-1" aria-labelledby="editPetModalLabel{{$pet->Pet_id}}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editPetModalLabel{{$pet->Pet_id}}">แก้ไขข้อมูลสัตว์เลี้ยง</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- ฟอร์มอัปเดตข้อมูลสัตว์เลี้ยง -->
                <form action="{{ route('pet.update') }}" method="post">
                    @csrf
                    <!-- ใช้ POST ตามที่กำหนดไว้ -->
                    <input type="hidden" name="petid" value="{{$pet->Pet_id}}">
                    <div class="mb-3">
                        <label for="pet_name" class="form-label">ชื่อสัตว์เลี้ยง</label>
                        <input type="text" name="pet_name" class="form-control" value="{{ $pet->Pet_name }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="pet_breed" class="form-label">สายพันธุ์</label>
                        <input type="text" name="pet_breed" class="form-control" value="{{ $pet->Pet_breed }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="pet_gender" class="form-label">เพศ</label>
                        <select name="pet_gender" class="form-select" required>
                            <option value="M" {{ $pet->Pet_gender == 'M' ? 'selected' : '' }}>ชาย</option>
                            <option value="F" {{ $pet->Pet_gender == 'F' ? 'selected' : '' }}>หญิง</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="pet_age" class="form-label">อายุ</label>
                        <input type="number" name="pet_age" class="form-control" value="{{ $pet->Pet_age }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="pet_weight" class="form-label">น้ำหนัก</label>
                        <input type="number" name="pet_weight" class="form-control" value="{{ $pet->Pet_weight }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="comment" class="form-label">คำแนะนำ</label>
                        <textarea name="comment" class="form-control" rows="3">{{ $pet->comment }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-success">บันทึกการเปลี่ยนแปลง</button>
                </form>
            </div>
        </div>
    </div>
</div>

                @endforeach
            </tbody>
        </table>
    @endif
</div>

<!-- เพิ่ม Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

@endsection
