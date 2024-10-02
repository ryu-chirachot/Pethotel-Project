@extends('layouts.AdminSidebar')

@section('content')
@if (session('report'))
    <script>
        Swal.fire({
  title: "รายงานสัตว์เลี้ยงสำเร็จ",
  text: "{{ session('report') }}",
  icon: "success"
});
    </script>
@endif

@if (session('success'))
    <script>
        Swal.fire({
  title: "ขยายระยะเวลาการเข้าพัก",
  text: "{{ session('success') }}",
  icon: "success"
});
    </script>
@endif

<div class="container my-5">
    <h1 class="mb-4 text-center">รายละเอียดการจอง</h1>

    <!-- รายละเอียดการจอง-->
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <h5 class="card-title fw-bold mb-3">ข้อมูลการจอง</h5>
            <div class="row mb-3">
                <div class="col-md-6">
                    <p><i class="fas fa-user"></i> <strong>ชื่อผู้จอง:</strong> {{ $bookings->user->name }}</p>
                    <p><i class="fas fa-calendar-alt"></i> <strong>วันที่เข้าพัก:</strong> {{ $bookings->Start_date }} ถึง {{ $bookings->End_date }}</p>
                    <p><i class="fas fa-moon"></i> <strong>จำนวนคืน:</strong> {{ \Carbon\Carbon::parse($bookings->Start_date)->diffInDays($bookings->End_date) }} คืน</p>
                </div>
                <div class="col-md-6">
                    <p><i class="fas fa-bed"></i> <strong>ห้องพัก:</strong> {{ $bookings->room->pet_Type_Room_Type->roomType->Rooms_type_name }}</p>
                    <p><i class="fas fa-receipt"></i> <strong>หมายเลขการจอง:</strong> <span class="badge bg-info text-dark">{{ $bookings->BookingOrderID }}</span></p>
                    <p><i class="fas fa-money-bill"></i> <strong>สถานะการชำระเงิน:</strong> 
                        @if($bookings->PaymentDate)
                            <span class="badge bg-success">ชำระเงินแล้ว</span>
                        @elseif($bookings->Booking_status == 3)
                            <span class="badge bg-warning">คืนเงินแล้ว</span>
                        @else
                            <span class="badge bg-secondary text-dark">รอยืนยันการชำระเงิน</span>
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </div>

    @if ($bookings->deleted_at || $bookings->Booking_status == 3)
    <div class="alert alert-warning" role="alert">
        <i class="fas fa-exclamation-triangle me-2"></i>การจองนี้สิ้นสุดแล้ว ไม่สามารถดำเนินการใดๆ ได้
    </div>
@else
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <h5 class="card-title fw-bold mb-4">การดำเนินการ</h5>
            <div class="row g-3">
                <div class="col-md-6 col-lg-4 mb-3">
                    <div class="d-grid">
                        <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#extendModal">
                            <i class="fas fa-calendar-plus me-2"></i>ขยายเวลา
                        </button>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 mb-3">
                    <form action="{{ route('Admin.bookings.confirmPayment', $bookings->BookingOrderID) }}" method="POST">
                        @csrf
                        <div class="d-grid">
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-check-circle me-2"></i>ยืนยันการชำระเงิน
                            </button>
                        </div>
                    </form>
                </div>
                <div class="col-md-6 col-lg-4 mb-3">
                    <div class="d-grid">
                        <button class="btn btn-info" type="button" data-bs-toggle="modal" data-bs-target="#petStatusModal">
                            <i class="fas fa-paw me-2"></i>รายงานสถานะสัตว์เลี้ยง
                        </button>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 mb-3">
                    <div class="d-grid">
                        <a href="{{ route('Admin.bookings') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-2"></i>กลับไปหน้าการจอง
                        </a>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 mb-3">
                    <form action="{{ route('Admin.bookings.cancel', $bookings->BookingOrderID) }}" method="POST" onsubmit="return Confirmcancel('{{ $bookings->BookingOrderID }}')">
                        @csrf
                        <div class="d-grid">
                            <button type="submit" class="btn btn-danger">
                                <i class="fas fa-times-circle me-2"></i>ยกเลิกการจอง
                            </button>
                        </div>
                    </form>
                </div>
                <div class="col-md-6 col-lg-4 mb-3">
                    <form action="{{ route('Admin.bookings.checkout', $bookings->BookingOrderID) }}" method="GET" >
                        @csrf
                        <div class="d-grid">
                            <button type="button" class="btn btn-warning" onclick="ConfirmCheckout('{{ $bookings->BookingOrderID }}')">
                                <i class="fas fa-sign-out-alt me-2"></i>เช็คเอาท์
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- ขยายการจอง -->
    <div class="modal fade" id="extendModal" tabindex="-1" aria-labelledby="extendModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="extendModalLabel">ขยายเวลาการจอง</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('Admin.bookings.extend', $bookings->BookingOrderID) }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="new_end_date" class="form-label">วันที่สิ้นสุดใหม่</label>
                            <input type="date" class="form-control" id="new_end_date" name="new_end_date" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                        <button type="submit" class="btn btn-primary">ยืนยันการขยายเวลา</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Pet Status รายงาน -->
    <div class="modal fade" id="petStatusModal" tabindex="-1" aria-labelledby="petStatusModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="petStatusModalLabel">รายงานสถานะสัตว์เลี้ยง</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{route('Admin.report')}}" method="POST"> 
                    @csrf
                    <input type="hidden" name="booking_id" value="{{$bookings->BookingOrderID}}">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="pet_status" class="form-label">สถานะสัตว์เลี้ยง</label>
                            <textarea class="form-control" id="pet_status" name="pet_status" rows="3" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                        <button type="submit" class="btn btn-primary">บันทึกสถานะ</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endif

<style>
    .btn {
        font-weight: bold;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .modal-content {
        border-radius: 15px;
    }
    .modal-header {
        background-color: #f8f9fa;
        border-bottom: none;
    }
    .modal-footer {
        border-top: none;
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
                window.location.href = `/Admin/Bookings/cancel/${id}`;
                
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
                window.location.href = `/Admin/Bookings/detail/checkout/${id}`
                
            }
            return false;
        });
    }
</script>
@endsection
