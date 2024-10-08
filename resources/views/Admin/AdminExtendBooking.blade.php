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


@if (session('extend'))
    <script>
        Swal.fire({
    title: "ขยายระยะเวลาการเข้าพักสำเร็จ",
    text: "{{ session('extend') }}",
    icon: "success"
});
    </script>
@endif

@if(session('checkout'))
    <script>
        Swal.fire({
            title: "เช็คเอาท์สำเร็จ",
            text: "ของคุณ {{ session('checkout') }} สำเร็จ",
            icon: "success"
        });
    </script>
@endif

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3 class="mb-0"><b>รายการจองทั้งหมด</b></h3>
                <div class="d-flex align-items-center">
                    <input type="text" class="form-control" style="width: 250px;" id="search" placeholder="พิมพ์เพื่อค้นหา..." onkeyup="searchTable()">
                </div>
            </div>
            <!-- การจอง Filters -->
            <div class="d-flex justify-content-between mb-3">
                <div>
                    <a class="btn btn-outline-secondary me-2" href="/Admin/Bookings">การจองทั้งหมด ({{$allBook->count()}})</a>
                    <a class="btn btn-outline-success me-2" href="/Admin/Bookings/TodayBook">การจองของวันนี้ ({{$today->count()}})</a>
                    <a class="btn btn-outline-danger me-2" href="/Admin/Bookings/Expiredbooking">การจองที่พักเลยกำหนด ({{$expired->count()}})</a>
                    <a class="btn btn-outline-primary me-2" href="/Admin/Bookings/Extendbooking">การจองที่ขยายเวลา ({{$extend->count()}})</a>
                </div>
            </div>
            @if($bookings->isEmpty())
                <div class="alert alert-warning" role="alert">
                    ยังไม่มีการจองในเข้ามาในขณะนี้
                </div>
            @else
                <div class="card shadow-sm">
                    <div class="card-body">
                        <table id="table" class="table table-hover table-responsive-md table-striped table-bordered">
                            <thead class="table-dark">
                                <tr>
                                    <th>หมายเลขการจอง</th>
                                    <th>ชื่อผู้จอง</th>
                                    <th>ชื่อสัตว์เลี้ยง</th>
                                    <th>ห้องพัก</th>
                                    <th>วันที่จอง</th>
                                    <th>วันที่เข้าพัก</th>
                                    <th>สถานะการจอง</th>
                                    <th>สถานะการชำระเงิน</th>
                                    <th>พนักงานดูแล</th>
                                    <th>การดำเนินการ</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($bookings as $booking)
                                    <tr>
                                        <td>{{ $booking->BookingOrderID }}</td>
                                        <td>{{ $booking->user->name }}</td>
                                        <td>
                                            {{$booking->pet ? $booking->pet->Pet_name : 'ไม่มีข้อมูลสัตว์เลี้ยง' }}
                                        </td>
                                        <td>
                                            {{ $booking->room ? $booking->room->roomType->Rooms_type_name : 'ไม่มีข้อมูลห้อง' }}
                                        </td>
                                        <td>{{ $booking->created_at }}</td>
                                        <td>{{ $booking->Start_date }} ถึง {{ $booking->End_date }}</td>
                                        <td>
                                            @if($booking->deleted_at != NULL)
                                                <span class="badge bg-success">เช็คเอาท์</span>
                                            @elseif($booking->Booking_status == 3)
                                                <span class="badge bg-danger">ยกเลิกการจอง</span>
                                            @else
                                                <span class="{{ $booking->Booking_status == 1 ? 'badge bg-primary text-white' : 'badge bg-warning text-dark' }}">
                                                    {{ $booking->Booking_status == 1 ? 'เช็คอินแล้ว' : 'รอการยืนยัน' }}
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($booking->Booking_status == 3)
                                                <span class="badge bg-warning">คืนเงินแล้ว</span>
                                            @else
                                                <span class="{{ $booking->PaymentDate ? 'badge bg-success text-white' : 'badge bg-warning text-dark' }}">
                                                    {{$booking->PaymentDate ? 'ชำระเงินแล้ว' : 'รอยืนยันการชำระเงิน'}}
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                                                    <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
                                                </svg>&nbsp;{{Auth::user()->name}}
                                        </td>
                                        <td>
                                            <a href="{{ route('Admin.bookings.detail', $booking->BookingOrderID) }}" class="btn btn-primary btn-sm">
                                                <i class="fas fa-eye"></i> ดูรายละเอียด
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>

                        </table>
                        {{$bookings->links('pagination::bootstrap-5')}}
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

<style>
    *{
        font-family: "kanit";
    
    }
    .table th, .table td {
        vertical-align: middle;
    }

    .container {
        padding: 0;
        margin: auto;
    }
</style>


<script>
    function searchTable() {
        var input = document.getElementById("search").value.toLowerCase();
        var rows = document.querySelectorAll("#table tbody tr");
        rows.forEach(function(row) {
            var rowData = row.innerText.toLowerCase();
            if (rowData.includes(input)) {
                row.style.display = "";
            } else {
                row.style.display = "none";
            }
        });
    }
</script>

@endsection