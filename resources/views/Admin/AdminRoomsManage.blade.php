@extends('layouts.AdminSidebar')

@section('content')
@if (session('success'))
    <script>
        Swal.fire({
  title: "เปลี่ยนแปลงข้อมูล",
  text: "{{ session('success') }}",
  icon: "success"
});
    </script>
@endif
@if (session('complete'))
    <script>
        Swal.fire({
  title: "เพิ่มข้อมูลห้องพัก",
  text: "{{ session('complete') }}",
  icon: "success"
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
                    <a class="btn btn-outline-secondary me-2" href="{{route('Admin.rooms')}}">ห้องทั้งหมด ({{count($allRooms)}})</a>
                    <a class="btn btn-outline-success me-2" href="{{route('Admin.available')}}">ห้องที่ว่างอยู่ ({{count($AvailableRooms)}})</a>
                    <a class="btn btn-outline-danger" href="{{route('Admin.unavailable')}}">ห้องที่ไม่ว่าง ({{count($UnAvailableRooms)}})</a>
                </div>
            </div>
                <!-- Room table -->
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
                                    <th>สถานะห้อง</th>
                                    <th>แก้ไข</th>
                                    <th>ลบ</th>
                                    <th>อื่นๆ</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($Rooms as $rm)
                                <tr>
                                    <td>{{ $rm->Rooms_id }}</td>
                                    <td>{{ $rm->pet_Type_Room_Type->roomType->Rooms_type_name }}</td>

                                    <!-- แสดงประเภทสัตว์เลี้ยง -->
                                    <td>{{ $rm->pet_Type_Room_Type->petType->Pet_nametype }}</td>

                                    <!-- แสดงชื่อผู้จอง (ถ้ามีการจอง) -->
                                    <!-- แสดงชื่อสัตว์เลี้ยง (ถ้ามีการจอง) -->
                                    @if($rm->bookings->isNotEmpty())
                                        @foreach($rm->bookings as $bk)
                                            @if ($bk->Booking_status != 2)
                                                <td>{{ $bk->user->name }}</td>
                                                <td>{{ $bk->pet->Pet_name }}</td>  
                                            @else
                                                <td>
                                                    <span>ไม่มีผู้จอง</span>
                                                </td>
                                                <td>
                                                    <span>ไม่มีสัตว์เลี้ยง</span>
                                                </td>                      
                                            @endif
                                        @endforeach
                                    @else
                                        <td>
                                            <span>ไม่มีผู้จอง</span>
                                        </td>
                                        <td>
                                            <span>ไม่มีสัตว์เลี้ยง</span>
                                        </td> 
                                    @endif   
                                    
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
                                        <div class="btn-group">
                                        <button class="btn btn-secondary btn-sm dropdown-toggle no-caret" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fas fa-ellipsis-h"></i>
                                        </button>                      
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="{{ route('Admin.bookings.detail', $rm->Rooms_id) }}">ดูรายละเอียดการจอง</a></li>
                                                <li><a class="dropdown-item" href="{{ route('Admin.pets.detail', $rm->Rooms_id) }}">ดูรายงานสถานะสัตว์เลี้ยง</a></li>
                                                
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{$Rooms->links('pagination::bootstrap-5')}}
                    </div>
                </div>

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
                    title: `คุณแน่ใจใช่ไหมว่าจะลบข้อมูลห้องหมายเลข ${id} ?`,
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
