@extends('layouts.AdminSidebar')
@section('content')
@if (session('error'))
    <script>
        alert("{{ session('error') }}");
    </script>
@endif

@if (session('success'))
    <script>
        Swal.fire({
  title: "รายงานข้อมูล",
  text: "{{ session('success') }}",
  icon: "success"
});
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
<<<<<<< HEAD
                        <thead id="petstatus" class="table-dark">
=======
                        <thead class="table-dark">
>>>>>>> boss
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
<<<<<<< HEAD
                                @foreach ($BooksRooms as $bk)
                                <tr>
                                    <td>{{ $bk->room->Rooms_id }}</td>
                                    <td>{{ $bk->room->pet_Type_Room_Type->roomType->Rooms_type_name }}</td>
                                    <td>
                                        @if ($bk->user->name)
                                            {{ $bk->user->name }}
=======
                            @foreach ($Rooms as $rm)
                                <tr>
                                    <td>{{ $rm->Rooms_id }}</td>
                                    <td>{{ $rm->petTypeRoomType->roomType->Rooms_type_name }}</td>
                                    <td>
                                        @if ($rm->bookings->isNotEmpty())
                                            {{ $rm->bookings->first()->user->name }}
>>>>>>> boss
                                        @else
                                            <span>ไม่มีผู้จอง</span>
                                        @endif
                                    </td>
                                    <td>
<<<<<<< HEAD
                                        @if ($bk->pet->Pet_name)
                                            {{ $bk->pet->Pet_name }}
=======
                                        @if ($rm->bookings->isNotEmpty())
                                            {{ $rm->bookings->first()->pet->Pet_name }}
>>>>>>> boss
                                        @else
                                            <span>ไม่มีสัตว์เลี้ยง</span>
                                        @endif
                                    </td>
<<<<<<< HEAD

                                    <td>
                                    @if ($bk->Start_date)
                                            {{ $bk->Start_date }}
                                    @else
                                        <span>ไม่มีวันจอง</span>
                                    @endif
                                    </td>
                                    <td>
                                    @if ($bk->End_date)
                                            {{ $bk->End_date }}
                                    @else
                                        <span>ไม่มีวันจอง</span>
                                    @endif
                                    </td>
                                    @foreach($bk->pet_status as $petstatus)
                                    <td><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                                        <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
                                        </svg>&nbsp;{{$petstatus->user->name}}</td>
                                    <td>
                                            @if($bk->Booking_status == 2)
                                                <span class="badge bg-warning">ถึงเวลาเช็คเอาท์</span>
                                            @elseif(!$petstatus->Report)
                                                <span class="badge bg-danger">ยังไม่รายงาน</span>
                                            @else
                                                <span class="badge bg-success">รายงานแล้ว</span>
                                            @endif
                                        @endforeach
                                    </td>
                                    <td class="align-items-center">
                                        <a id="Edit" href="{{ route('Admin.editrooms', $bk->room->Rooms_id) }}" class="btn btn-warning btn-sm">
=======
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    @if ($rm->Rooms_status == 1)
                                        <td><span class="badge bg-success">ว่าง</span></td>
                                    @else
                                        <td><span class="badge bg-danger">ไม่ว่าง</span></td>
                                    @endif
                                    <td class="align-items-center">
                                        <a id="Edit" href="{{ route('Admin.editrooms', $rm->Rooms_id) }}" class="btn btn-warning btn-sm">
>>>>>>> boss
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </td>
                                    <td class="align-items-center">
<<<<<<< HEAD
                                        <button class="btn btn-danger btn-sm" onclick="ConfirmDelete('{{ $bk->room->Rooms_id }}')">
=======
                                        <button class="btn btn-danger btn-sm" onclick="ConfirmDelete('{{ $rm->Rooms_id }}')">
>>>>>>> boss
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                    <td class="align-items-center">
<<<<<<< HEAD
                                        <a class="btn btn-primary btn-sm" href="{{route('Admin.pets.detail',$bk->BookingOrderID)}}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope-heart" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v.217l3.235 1.94a2.8 2.8 0 0 0-.233 1.027L1 5.384v5.721l3.453-2.124q.219.416.55.835l-3.97 2.443A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741l-3.968-2.442q.33-.421.55-.836L15 11.105V5.383l-3.002 1.801a2.8 2.8 0 0 0-.233-1.026L15 4.217V4a1 1 0 0 0-1-1zm6 2.993c1.664-1.711 5.825 1.283 0 5.132-5.825-3.85-1.664-6.843 0-5.132"/>
                                            </svg>
                                        </a>
=======
                                        <button class="btn btn-secondary btn-sm">
                                            <i class="fas fa-ellipsis-h"></i>
                                        </button>
>>>>>>> boss
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
<<<<<<< HEAD
<script>
    function ConfirmDelete(id){
        const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: "btn btn-success me-3",
                        cancelButton: "btn btn-danger"
                    },
                    buttonsStyling: true
                    });
                    swalWithBootstrapButtons.fire({
                    title: `คุณแน่ใจใช่ไหมว่าจะลบข้อมูลการจองหมายเลข ${id} ?`,
                    text: "แน่ใจแล้วใช่อ้ะป่าว หายไปเลยนะ!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "ยืนยัน",
                    cancelButtonText: "ยกเลิก",
                    reverseButtons: false
                    }).then((result) => {
                    if (result.isConfirmed) {
                        swalWithBootstrapButtons.fire({
                            title: "ลบ เรียบร้อย",
                            text: "ข้อมูลของคุณถูกลบสำเร็จ",
                            icon: "success"
                        });
                        setTimeout(()=>{
                            window.location.href = `/Admin/Rooms/delete/${id}`;
                        },800)
                    } else if (
                        /* Read more about handling dismissals below */
                        result.dismiss === Swal.DismissReason.cancel
                    ) {
                        swalWithBootstrapButtons.fire({
                        title: "ยกเลิก",
                        text: "ข้อมูลของคุณยังคงอยู่ :)",
                        icon: "error"
                        });
                    }
        });
    }
</script>
=======
>>>>>>> boss

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
<<<<<<< HEAD
@endsection
=======
@endsection
>>>>>>> boss
