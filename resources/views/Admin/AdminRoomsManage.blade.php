@extends('layouts.AdminSidebar')

@section('content')

@if (session('success'))
    <script>
        Swal.fire({
  title: "The Internet?",
  text: "That thing is still around?",
  icon: "question"
});
    </script>
@endif
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3 class="mb-0"><b>ห้องพัก</b></h3>
                <input type="text" class="form-control w-25" right="0px" id="search" placeholder="พิมพ์เพื่อค้นหา..." onkeyup="searchTable()">
            </div>

            <!-- Room Filters -->
            <div class="d-flex justify-content-between mb-3">
                <div>
                    <button class="btn btn-outline-secondary me-2">ห้องทั้งหมด ({{count($Rooms)}})</button>
                    <button class="btn btn-outline-success me-2">ห้องที่ว่างอยู่ ({{count($AvailableRooms)}})</button>
                    <button class="btn btn-outline-danger">ห้องที่ไม่ว่าง ({{count($UnAvailableRooms)}})</button>
                </div>
            </div>

            <!-- Room Table -->
            <div class="card shadow-sm">
                <div class="card-body">
                    <table id="table" class="table table-hover table-responsive-md table-striped table-bordered">
                        <thead class="table-dark">
                            <tr>
                                <th>หมายเลขห้อง</th>
                                <th>ประเภทห้อง</th>
                                <th>ประเภทของสัตว์เลี้ยง</th>
                                <th>ชื่อผู้จอง</th>
                                <th>ชื่อสัตว์เลี้ยง</th>
                                <th>สถานะ</th>
                                <th>แก้ไข</th>
                                <th>ลบ</th>
                                <th>อื่นๆ</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($Rooms as $rm)
                            <tr>
                                <td>{{ $rm->Rooms_id }}</td>
                                <td>{{ $rm->petTypeRoomType->roomType->Rooms_type_name }}</td>

                                <!-- แสดงประเภทสัตว์เลี้ยง -->
                                <td>{{ $rm->petTypeRoomType->petType->Pet_nametype }}</td>

                                <!-- แสดงชื่อผู้จอง (ถ้ามีการจอง) -->
                                <td>
                                    @if ($rm->bookings->isNotEmpty())
                                        {{ $rm->bookings->first()->user->name }}
                                    @else
                                        <span>ไม่มีผู้จอง</span>
                                    @endif
                                </td>

                                <!-- แสดงชื่อสัตว์เลี้ยง (ถ้ามีการจอง) -->
                                <td>
                                    @if ($rm->bookings->isNotEmpty())
                                        {{ $rm->bookings->first()->pet->Pet_name }}
                                    @else
                                        <span>ไม่มีสัตว์เลี้ยง</span>
                                    @endif
                                </td>

                                <!-- ตรวจสอบสถานะห้อง -->
                                @if ($rm->Rooms_status == 1)
                                    <td><span class="badge bg-success">ว่าง</span></td>
                                @else
                                    <td><span class="badge bg-danger">ไม่ว่าง</span></td>
                                @endif
                                <td>
                                    <a id="Edit" href="{{ route('Admin.editrooms', $rm->Rooms_id) }}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </td>
                                <td>
                                    <button class="btn btn-danger btn-sm" onclick="ConfirmDelete('{{ $rm->Rooms_id }}')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                                <td>
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
    function ConfirmDelete(id){

    
    const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: "btn btn-success me-3",
                    cancelButton: "btn btn-danger"
                },
                buttonsStyling: true
                });
                swalWithBootstrapButtons.fire({
                title: `คุณแน่ใจใช่ไหมว่าจะลบ ห้องหมายเลข ${id} ?`,
                text: "แน่ใจแล้วใช่อ้ะป่าว หายไปเลยนะ!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "ใช่",
                cancelButtonText: "ยกเลิก",
                reverseButtons: true
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
