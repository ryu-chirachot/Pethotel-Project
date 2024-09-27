@extends('layouts.AdminSidebar')

@section('content')
<div class="container my-5">
    <h1 class="mb-4">รายละเอียดการจอง</h1>

    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <h5 class="card-title fw-bold mb-3">ข้อมูลการจอง</h5>
            <div class="row">
                <div class="col-md-6">
                    <p><strong>ชื่อผู้จอง:</strong> {{ $bookings->user->name }}</p>
                    <p><strong>วันที่เข้าพัก:</strong> {{ $bookings->Start_date }} ถึง {{ $bookings->End_date }}</p>
                    <p><strong>จำนวนคืน:</strong> {{ \Carbon\Carbon::parse($bookings->Start_date)->diffInDays($bookings->End_date) }} คืน</p>
                </div>
                <div class="col-md-6">
                    <p><strong>ห้องพัก:</strong> {{ $bookings->room->pet_Type_Room_Type->roomType->Rooms_type_name }}</p>
                    <p><strong>หมายเลขการจอง:</strong> <span class="badge bg-info text-dark">{{ $bookings->BookingOrderID }}</span></p>
                    <p><strong>สถานะการชำระเงิน:</strong> 
                        @if($bookings->PaymentDate)
                            <span class="badge bg-success">ชำระเงินแล้ว</span>
                        @else
                            <span class="badge bg-warning text-dark">รอยืนยันการชำระเงิน</span>
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <h5 class="card-title fw-bold mb-3">การดำเนินการ</h5>
            @if ($bookings->deleted_at)
                <div class="alert alert-warning" role="alert">
                    การจองนี้ถูกยกเลิกแล้ว ไม่สามารถดำเนินการใดๆ ได้
                </div>
            @else
                <div class="row g-3">
                    <div class="col-md-3">
                        <form action="{{ route('Admin.bookings.extend', $bookings->BookingOrderID) }}" method="POST">
                            @csrf
                            <div class="input-group">
                                <input type="date" name="new_end_date" class="form-control" required>
                                <button id="extend" type="submit" class="btn btn-primary">ขยายเวลา</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-3">
                        <form action="{{ route('Admin.bookings.confirmPayment', $bookings->BookingOrderID) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-success w-100">ยืนยันการชำระเงิน</button>
                        </form>
                    </div>
                    <div class="col-md-3">
                        <form action="{{ route('Admin.bookings.cancel', $bookings->BookingOrderID) }}" method="POST" onsubmit="return Confirmcancel('{{ $bookings->BookingOrderID }}')">
                            @csrf
                            <button type="submit" class="btn btn-danger w-100">ยกเลิกการจอง</button>
                        </form>
                    </div>
                    <div class="col-md-3">
                        <form action="{{ route('Admin.bookings.checkout', $bookings->BookingOrderID) }}" method="POST" onsubmit="return ConfirmCheckout('{{ $bookings->BookingOrderID }}')">
                            @csrf
                            <button type="submit" class="btn btn-info w-100">เช็คเอาท์</button>
                        </form>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <div class="text-end">
        <a href="{{ route('bookings.index') }}" class="btn btn-secondary">กลับไปยังรายการจอง</a>
    </div>
</div>

<style>
    .card {
        border-radius: 15px;
    }
    .btn {
        border-radius: 5px;
    }
    .badge {
        font-size: 0.9em;
    }
</style>

<script>
    function Confirmcancel(id) {
        return Swal.fire({
            title: `ยืนยันการยกเลิกการจอง`,
            text: `คุณแน่ใจใช่ไหมว่าจะยกเลิกการจองหมายเลข ${id}?`,
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "ยืนยัน",
            cancelButtonText: "ยกเลิก",
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire("ยกเลิกการจองสำเร็จ", "การจองได้ถูกยกเลิกแล้ว", "success");
                setTimeout(() => {
                    window.location.href = `/Admin/booking/cancel/${id}`;
                }, 1500);
            }
            return false;
        });
    }

    function ConfirmCheckout(id) {
        return Swal.fire({
            title: `ยืนยันการเช็คเอาท์`,
            text: `คุณแน่ใจใช่ไหมว่าจะดำเนินการเช็คเอาท์สำหรับการจองหมายเลข ${id}?`,
            icon: "question",
            showCancelButton: true,
            confirmButtonText: "ยืนยัน",
            cancelButtonText: "ยกเลิก",
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire("เช็คเอาท์สำเร็จ", "การเช็คเอาท์ได้ถูกดำเนินการแล้ว", "success");
                setTimeout(() => {
                    window.location.href = `/Admin/booking/checkout/${id}`;
                }, 1500);
            }
            return false;
        });
    }
</script>
@endsection