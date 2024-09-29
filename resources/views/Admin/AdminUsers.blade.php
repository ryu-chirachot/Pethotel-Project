@extends('layouts.AdminSidebar')

@section('content')

<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
                <h3 class="mb-0"><b>รายการผู้ใช้ทั้งหมด</b></h3>
            <div class="d-flex align-items-center">
                <input type="text" class="form-control" style="width: 250px;" id="search" placeholder="พิมพ์เพื่อค้นหา..." onkeyup="searchTable()">
            </div>
    </div>
    @if($users->count() === 0)
        <div class="alert alert-warning" role="alert">
            ยังไม่พบผู้ใช้
        </div>
    @else
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">ผู้ใช้ทั้งหมด</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="usersTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ชื่อ</th>
                                <th>อีเมล</th>
                                <th>จำนวนสัตว์เลี้ยง</th>
                                <th>จำนวนการจอง</th>
                                <th>สถานะ</th>
                                <th>การดำเนินการ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    {{ count($user->pets)}}
                                </td>
                                <td>{{ count($user->bookings)}}</td>
                                <td>
                                    @if($user->trashed())
                                        <span class="text-danger">ถูกลบ</span>
                                    @else
                                        <span class="text-success">ใช้งาน</span>
                                    @endif
                                </td>
                                <td>
                                    <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#userDetailsModal{{ $user->id }}">
                                        ดูรายละเอียด
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @foreach($users as $user)
    <!-- Modal สำหรับแสดงรายละเอียดผู้ใช้ -->
    <div class="modal fade" id="userDetailsModal{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="userDetailsModalLabel{{ $user->id }}" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="userDetailsModalLabel{{ $user->id }}">รายละเอียดผู้ใช้: {{ $user->name }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h6 class="font-weight-bold">ข้อมูลสัตว์เลี้ยง</h6>
                    <ul class="list-group mb-3">
                        @forelse($user->pets as $pet)
                        <li class="list-group-item">
                            <strong>ชื่อ:</strong> {{ $pet->name }}, 
                            <strong>ประเภท:</strong> {{ $pet->type }}, 
                            <strong>สายพันธุ์:</strong> {{ $pet->breed }}
                        </li>
                        @empty
                        <li class="list-group-item">ไม่มีข้อมูลสัตว์เลี้ยง</li>
                        @endforelse
                    </ul>

                    <h6 class="font-weight-bold">ประวัติการจอง</h6>
                    <ul class="list-group">
                        @forelse($user->bookings as $booking)
                        <li class="list-group-item">
                            <strong>หมายเลขการจอง:</strong> #{{ $booking->BookingOrderID }}, 
                            <strong>วันที่จอง:</strong> {{ $booking->PaymentDate }}, 
                            <strong>สถานะ:</strong> 
                            @if($booking->trashed())
                                <span class="badge badge-danger">ยกเลิก</span>
                            @else
                                <span class="badge badge-success">ยืนยันแล้ว</span>
                            @endif
                        </li>
                        @empty
                        <li class="list-group-item">ไม่มีประวัติการจอง</li>
                        @endforelse
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                </div>
            </div>
        </div>
    </div>
    @endforeach
@endif
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

<script>
$(document).ready(function() {
    $('#usersTable').DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Thai.json"
        }
    });
});
</script>

@endsection



