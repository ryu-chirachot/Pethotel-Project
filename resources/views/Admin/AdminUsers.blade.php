@extends('layouts.AdminSidebar')

@section('content')
<head>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

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
                            <td>{{ $user->pets->count() }}</td> <!-- จำนวนสัตว์เลี้ยง -->
                            <td>{{ $user->bookings->count() }}</td> <!-- จำนวนการจอง -->
                            <td>
                                @if($user->trashed())
                                    <span class="text-danger">ถูกลบ</span>
                                @else
                                    <span class="text-success">ใช้งาน</span>
                                @endif
                            </td>
                            <td>
                                <a class="btn btn-info btn-sm" href="{{ route('Admin.user.detail', $user->id) }}">
                                    ดูรายละเอียด
                                </a>
                            </td>
                        </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif
</div>

<script>
    function searchTable() {
        var input = document.getElementById("search").value.toLowerCase();
        var rows = document.querySelectorAll("#usersTable tbody tr");
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
