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
                <input type="text" class="form-control" style="width: 250px;" right="0px" id="search" placeholder="พิมพ์เพื่อค้นหา..." onkeyup="searchTable()">
            </div>

            <!-- Room Filters -->
            <div class="d-flex justify-content-between mb-3">
                <div>
                    <a class="btn btn-outline-secondary me-2" href="{{route('Admin.rooms')}}">ห้องทั้งหมด ({{count($allRooms)}})</a>
                    <a class="btn btn-outline-success me-2" href="{{route('Admin.available')}}">ห้องที่ว่างอยู่ ({{count($AvailableRooms)}})</a>
                    <a class="btn btn-outline-danger me-2" href="{{route('Admin.unavailable')}}">ห้องที่ไม่ว่าง ({{count($UnAvailableRooms)}})</a>
                    <a class="btn btn-outline-primary me-2" href="{{route('Admin.clean')}}">ห้องที่รอทำความสะอาด ({{count($cleaning)}})</a>
                </div>
            </div>
            @if($Rooms->isEmpty())
                <div class="alert alert-warning" role="alert">
                    ยังไม่มีการจองในเข้ามาในขณะนี้
                </div>
            @else
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
                                    <th>วันที่เข้าพัก</th>
                                    <th>สถานะการจอง</th>
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
                                        <td>{{ $rm->roomType->Rooms_type_name }}</td>
                                        <td>{{ $rm->petType->Pet_nametype }}</td>

                                        @php
                                        $activeBooking = $rm->bookings->where('Booking_status', '!=', 3)->first();
                                        @endphp

                                        @if($activeBooking)
                                            <td>{{ $activeBooking->user->name }}</td>
                                            <td>
                                                @if($activeBooking->Start_date)
                                                    {{ $activeBooking->Start_date}}
                                                @else
                                                    <span>ไม่มีข้อมูลสัตว์เลี้ยง</span>
                                                @endif
                                            </td>
                                        @else
                                            <td><span>ไม่มีผู้จอง</span></td>
                                            <td><span>ไม่มีผู้จอง</span></td>
                                        @endif

                                        <td>
                                        @if($activeBooking)
                                            @if($activeBooking->Booking_status == 0)
                                                    <span class="badge bg-warning">รอการยืนยัน</span>
                                                @elseif($activeBooking->Booking_status == 1)
                                                    <span class="badge bg-primary">เช็คอินแล้ว</span>
                                                @elseif($activeBooking->Booking_status == 2)
                                                    <span class="badge bg-danger">เลยกำหนด</span>
                                                @endif  
                                        @else
                                            <span class="badge bg-danger">ไม่มีการจอง</span>  
                                        @endif
                                        </td>

                                        <td>
                                            @if ($rm->Rooms_status == 1)
                                                <span class="badge bg-success">ว่าง</span>
                                            @elseif ($rm->Rooms_status == 2)
                                                <span class="badge bg-warning">ซ่อมบำรุง</span>
                                            @elseif ($rm->Rooms_status == 3)
                                                <span class="badge bg-primary">ทำความสะอาด</span>
                                            @else 
                                                <span class="badge bg-danger">ไม่ว่าง</span>
                                            @endif
                                        </td>

                                        <td>
                                            <a id="Edit" href="{{ route('Admin.editrooms', $rm->Rooms_id) }}" class="btn btn-warning btn-sm">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        </td>
                                        @if($activeBooking)
                                            <td><span class="badge bg-danger">มีการจอง</span></td>
                                        @else
                                            <td>
                                                <button class="btn btn-danger btn-sm" onclick="ConfirmDelete('{{ $rm->Rooms_id }}')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </td>
                                        @endif
                                        <td>
                                            <div class="btn-group">
                                                <button class="btn btn-secondary btn-sm dropdown-toggle no-caret" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-h"></i>
                                                </button>                      
                                                <ul class="dropdown-menu">
                                                    @if($activeBooking)
                                                        <li><a class="dropdown-item" href="{{ route('Admin.bookings.detail', $activeBooking->BookingOrderID) }}">ดูรายละเอียดการจอง</a></li>
                                                    @else
                                                        <li><a class="dropdown-item disabled">ไม่มีข้อมูลการจอง</a></li>                                                
                                                    @endif
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    {{$Rooms->links('pagination::bootstrap-5')}}
                </div>
                @endif
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
            } else if (result.dismiss === Swal.DismissReason.cancel) {
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