@extends('layouts.AdminSidebar')
@section('content')
@if (session('error'))
    <script>
        alert("{{ session('error') }}");
    </script>
@endif
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3 class="mb-0"><b>สถานะสัตว์เลี้ยง</b></h3>
                <input type="text" class="form-control w-25" right="0px" id="search" placeholder="พิมพ์เพื่อค้นหา..." onkeyup="searchTable()">
            </div>

            <!-- Room Table -->
            <div class="card shadow-sm">
                <div class="card-body">
                    <table id="table" class="table table-hover table-responsive-md table-striped table-bordered">
                        <thead class="table-dark">
                            <tr>
                                <th>หมายเลขการจอง</th>
                                <th>ประเภทห้อง</th>
                                <th>ชื่อผู้จอง</th>
                                <th>ชื่อสัตว์เลี้ยง</th>
                                <th>วันเช็คอิน</th>
                                <th>วันเช็คเอาท์</th>
                                <th>พนักงานดูแล</th>
                                <th>สถานะ</th>
                                <th>แก้ไข</th>
                                <th>ลบ</th>
                                <th>รายงาน</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody">
                            @foreach ($Rooms as $rm)
                                <tr>
                                    <td>{{ $rm->Rooms_id }}</td>
                                    <td>{{ $rm->pet_Type_Room_Type->roomType->Rooms_type_name }}</td>
                                    <td>
                                        @if ($rm->bookings->isNotEmpty())
                                            {{ $rm->bookings->first()->user->name }}
                                        @else
                                            <span>ไม่มีผู้จอง</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($rm->bookings->isNotEmpty())
                                            {{ $rm->bookings->first()->pet->Pet_name }}
                                        @else
                                            <span>ไม่มีสัตว์เลี้ยง</span>
                                        @endif
                                    </td>
                                    <td>ดึง booking</td>
                                    <td>ดึง booking</td>
                                    <td>ดึง auth ID</td>
                                    @if ($rm->Rooms_status == 1)
                                        <td><span class="badge bg-success">ว่าง</span></td>
                                    @else
                                        <td><span class="badge bg-danger">ไม่ว่าง</span></td>
                                    @endif
                                    <td class="align-items-center">
                                        <a id="Edit" href="{{ route('Admin.editrooms', $rm->Rooms_id) }}" class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </td>
                                    <td class="align-items-center">
                                        <button class="btn btn-danger btn-sm" onclick="ConfirmDelete('{{ $rm->Rooms_id }}')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                    <td class="align-items-center">
                                        <button class="btn btn-secondary btn-sm">
                                            <i class="fas fa-ellipsis-h"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Pagination -->
            <nav class="mt-3">
                <ul class="pagination justify-content-center">
                    <li class="page-item">
                        <a class="page-link" href="#">หน้าที่แล้ว</a>
                    </li>
                    <li class="page-item active">
                        <a class="page-link" href="#">1</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#">2</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#">หน้าถัดไป</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>

<script> 
    function searchTable() {
        var input = document.getElementById("search").value.toLowerCase();
        var rows = document.querySelectorAll("#table tbody tr");
        rows.forEach(function(row) {
            var rowData = row.innerText.toLowerCase();
            if (rowData.includes(input)) {
                row.style.display = ""; // Show row
            } else {
                row.style.display = "none"; // Hide row
            }
        });
}
</script>
@endsection
