@extends('layouts.navbar')
@section('titel','เพิ่มรายละเอียดสัตว์เลี้ยง')
@section('content')

<script src="https://cdn.tailwindcss.com"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
    .center-content {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }
    .pet-table-container {
        width: 80%;
        margin: 10px auto;
    }
    table th, table td {
        padding: 15px;
        text-align: center;
        font-size: 16px;
    }
</style>

<body class="bg-[#e6f2f2] p-4">
    <div class="container center-content">
        <div class="text-center">
            <h2 class="text-2xl font-bold mb-4">สัตว์เลี้ยงของคุณ</h2>

            <!-- เงื่อนไขตรวจสอบว่ามีสัตว์เลี้ยงหรือไม่ -->
            @if($pets->isEmpty())
                <p class="text-danger">ไม่มีประวัติสัตว์เลี้ยงของคุณ</p>
            @else
            
                <div class="pet-table-container">
                    <div class="table-responsive">
                    <table class="table table-bordered table-hover">
    <thead class="table-dark">
        <tr>
            <th class="hidden"></th>
            <th>ชื่อสัตว์เลี้ยง</th>
            <th>สายพันธุ์</th>
            <th>อายุ</th>
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
                <input type="hidden" name="name" value="{{ $pet->Pet_name }}">
                <input type="hidden" name="breed" value="{{ $pet->Pet_breed }}">
                <input type="hidden" name="age" value="{{ $pet->Pet_age }}">
                <input type="hidden" name="weight" value="{{$pet->Pet_weight}}">
                <input type="hidden" name="comment" value="{{$pet->Pet_info}}">
                <input type="hidden" name="gender" value="{{$pet->Pet_Gender}}">
                <td>{{ $pet->Pet_name }}</td>
                <td>{{ $pet->Pet_breed }}</td>
                <td>{{ $pet->Pet_age }} ปี</td>
                <td><button class="btn btn-primary" type="submit" name="select">เลือก</button></td>
            </form>
        </tr>
        @endforeach
    </tbody>
</table>

                    </div>
                </div>
            @endif

            <!-- ปุ่มเปิด modal -->
            <button type="button" class="btn btn-primary mt-4" data-bs-toggle="modal" data-bs-target="#addPetModal">
                เพิ่มสัตว์เลี้ยง
            </button>

            <!-- Modal -->
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
                                <!-- ค่าเดิมจากหน้าก่อนหน้า -->
                                <input type="hidden" name="room_id" value="{{ $room_id }}">
                                <input type="hidden" name="petTypeId" value="{{ $petTypeId }}">
                                <input type="hidden" name="checkIn" value="{{ $checkIn }}">
                                <input type="hidden" name="checkOut" value="{{ $checkOut }}">
                                <input type="hidden" name="roomTypeId"  value="{{ $roomTypeId }}">
                                <input type="hidden" name="roomTypename"  value="{{ $roomTypeName }}">

                                <div class="mb-3">
                                    <label for="name" class="form-label">ชื่อของสัตว์เลี้ยง</label>
                                    <input type="text" name="name" class="form-control" placeholder="ชื่อของสัตว์เลี้ยง" required>
                                </div>
                                <div class="mb-3">
                                    <label for="gender" class="form-label">เพศ</label>
                                    <select name="gender" class="form-select" required>
                                        <option value="" disabled selected>เลือกเพศ</option>
                                        <option value="M">ชาย</option>
                                        <option value="F">หญิง</option>
                                    </select>
                                    
                                </div>
                                <div class="mb-3">
                                    <label for="breed" class="form-label">สายพันธุ์</label>
                                    <input name="breed" type="text" class="form-control" placeholder="สายพันธุ์" required>
                                </div>
                                <div class="mb-3">
                                    <label for="age" class="form-label">อายุ</label>
                                    <input name="age" type="number" class="form-control" placeholder="อายุ" required>
                                </div>
                                <div class="mb-3">
                                    <label for="weight" class="form-label">น้ำหนัก (kg)</label>
                                    <input type="number" name="weight" class="form-control" placeholder="น้ำหนัก (kg)" required>
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
</body>

@endsection