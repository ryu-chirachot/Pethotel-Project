@extends('layouts.navbar')
@section('titel','เพิ่มรายละเอียดสัตว์เลี้ยง')
@section('content')

<style>
    body {
        background: linear-gradient(to right, #f8fafc, #f1f5f9);
        font-family: 'Kanit', sans-serif;
    }
    .center-content {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
    }
    .pet-table-container {
        width: 100%;
        max-width: 720px;
        margin: 20px auto;
        background-color: #ffffff;
        border-radius: 15px;
        box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.1);
        padding: 20px;
    }
    table th, table td {
        padding: 20px;
        text-align: center;
        font-size: 16px;
    }
    .btn-primary, .btn-success {
        background-color: #ff9800;
        border: none;
        transition: background-color 0.3s ease;
    }
    .btn-primary:hover, .btn-success:hover {
        background-color: #e68900;
    }
    .modal-content {
        border-radius: 15px;
        background-color: #f9fafb;
        box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.1);
    }
    .modal-header {
        background-color: #ff9800;
        color: white;
        border-bottom: none;
        padding: 20px;
    }
    .form-label {
        font-weight: bold;
    }
    .btn-close {
        color: white;
    }
</style>

    <div class="container center-content">
        <div class="text-center pet-table-container">
            <h2 class="text-3xl font-bold mb-4">สัตว์เลี้ยงของคุณ</h2>

            <!-- เงื่อนไขตรวจสอบว่ามีสัตว์เลี้ยงหรือไม่ -->
            @if($pets->isEmpty())
                <p class="text-danger">ไม่มีประวัติสัตว์เลี้ยงของคุณ</p>
            @else
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
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
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pets as $pet)
                            <tr>
                                <form action="/overview" method="post">
                                    @csrf
                                    <input type="hidden" name="room_id" value="{{ $room_id }}">
                                    <input type="hidden" name="petTypeId" value="{{ $petTypeId }}">
                                    <input type="hidden" name="checkIn" value="{{ $checkIn }}">
                                    <input type="hidden" name="checkOut" value="{{ $checkOut }}">
                                    <input type="hidden" name="roomTypeId" value="{{ $roomTypeId }}">
                                    <input type="hidden" name="roomTypename" value="{{ $roomTypeName }}">
                                    <input type="hidden" name="pet_id" value="{{$pet->Pet_id}}">
                                    <input type="hidden" name="name" value="{{ $pet->Pet_name }}">
                                    <input type="hidden" name="breed" value="{{ $pet->Pet_breed }}">
                                    <input type="hidden" name="age" value="{{ $pet->Pet_age }}">
                                    <input type="hidden" name="weight" value="{{ $pet->Pet_weight }}">
                                    <input type="hidden" name="comment" value="{{ $pet->additional_info }}">
                                    <input type="hidden" name="gender" value="{{ $pet->Pet_Gender }}">
                                    
                                    
                                    <td>{{ $pet->petType->Pet_nametype }}</td>
                                    <td>{{ $pet->Pet_name }}</td>
                                    <td>{{ $pet->Pet_gender == 'M' ? 'ชาย' : 'หญิง' }}</td>
                                    <td>{{ $pet->Pet_breed }}</td>
                                    <td>{{ $pet->Pet_age }} ปี</td>
                                    <td>{{ $pet->Pet_weight }} กก.</td>
                                    <td>{{ $pet->additional_info ?? 'ไม่มี' }}</td>
                                    <td>
                                        <button class="btn btn-primary" type="submit" name="select">เลือก</button>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editPetModal{{$pet->Pet_id}}">
                                            แก้ไข
                                        </button>
                                    </td>
                                </form>
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
                                                        <option value="M" {{ $pet->Pet_gender == 'M' ? 'selected' : '' }}>ผู้</option>
                                                        <option value="F" {{ $pet->Pet_gender == 'F' ? 'selected' : '' }}>เมีย</option>
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
                </div>
            @endif


            
            <!-- ปุ่มเปิด modal สำหรับเพิ่มสัตว์เลี้ยง -->
            <button type="button" class="btn btn-primary mt-4" data-bs-toggle="modal" data-bs-target="#addPetModal">
                เพิ่มสัตว์เลี้ยง
            </button>

            <!-- Modal สำหรับเพิ่มสัตว์เลี้ยง -->
            <div class="modal fade" id="addPetModal" tabindex="-1" aria-labelledby="addPetModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addPetModalLabel">เพิ่มรายละเอียดสัตว์เลี้ยง</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="/overview" method="post">
                                @csrf
                                <input type="hidden" name="room_id" value="{{ $room_id }}">
                                <input type="hidden" name="petTypeId" value="{{ $petTypeId }}">
                                <input type="hidden" name="checkIn" value="{{ $checkIn }}">
                                <input type="hidden" name="checkOut" value="{{ $checkOut }}">
                                <input type="hidden" name="roomTypeId" value="{{ $roomTypeId }}">
                                <input type="hidden" name="roomTypename" value="{{ $roomTypeName }}">

                                <div class="mb-3">
                                    <label for="name" class="form-label">ชื่อของสัตว์เลี้ยง</label>
                                    <input type="text" name="name" class="form-control" placeholder="ชื่อของสัตว์เลี้ยง" required>
                                </div>
                                <div class="mb-3">
                                    <label for="gender" class="form-label">เพศ</label>
                                    <select name="gender" class="form-select" required>
                                        <option value="" disabled selected>เลือกเพศ</option>
                                        <option value="M">ผู้</option>
                                        <option value="F">เมีย</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="breed" class="form-label">สายพันธุ์</label>
                                    <input name="breed" type="text" class="form-control" placeholder="สายพันธุ์" required>
                                </div>
                                <div class="mb-3">
                                    <label for="age" class="form-label">อายุ (ปี)</label>
                                    <input name="age" type="number" class="form-control" placeholder="อายุ (ปี)" required>
                                </div>
                                <div class="mb-3">
                                    <label for="weight" class="form-label">น้ำหนัก (กิโลกรัม)</label>
                                    <input type="number" name="weight" class="form-control" placeholder="น้ำหนัก (กิโลกรัม)" required>
                                </div>
                                <div class="mb-3">
                                    <label for="comment" class="form-label">คำแนะนำ / ข้อกำหนดเพิ่มเติม :</label>
                                    <textarea name="comment" class="form-control" rows="3" placeholder="เช่น โรคประจำตัว , สิ่งที่ต้องทำประจำ"></textarea>
                                </div>
                                <button type="submit" class="btn btn-success w-100">ถัดไป</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
