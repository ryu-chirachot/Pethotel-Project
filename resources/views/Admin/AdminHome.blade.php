@extends('layouts.AdminSidebar')

@section('content')
<div class="container-fluid py-4">
    <h2 class="mb-4 text-center">แดชบอร์ดผู้ดูแลระบบ</h2>

    <!-- Dashboard Cards Overview -->
    <div class="row mb-4">
        <!-- Bookings Card -->
        <div class="col-lg-4 col-md-6 mb-3">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">การจอง</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">วันนี้: {{count($TodayBookings)}}</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">ทั้งหมด: {{count($Bookings)}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-transparent">
                    <a href="{{ route('Admin.bookings') }}" class="btn btn-primary btn-sm">ดูรายละเอียด</a>
                </div>
            </div>
        </div>

        <!-- Available Rooms Card -->
        <div class="col-lg-4 col-md-6 mb-3">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">ห้องที่ว่าง</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{count($AvailableRooms)}} / {{count($Rooms)}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-door-open fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-transparent">
                    <a href="{{ route('Admin.rooms') }}" class="btn btn-success btn-sm">ดูรายละเอียด</a>
                </div>
            </div>
        </div>

        <!-- ผู้ใช้ทั้งหมด -->
        <div class="col-lg-4 col-md-6 mb-3">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">ผู้ใช้ทั้งหมด</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">ทั้งหมด: {{count($Users)}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-transparent">
                    <a href="{{ route('Admin.user') }}" class="btn btn-warning btn-sm">ดูรายละเอียด</a>
                </div>
            </div>
        </div>
    </div>

    <!--รายการจองล่าสุด -->
    <div class="row">
        <div class="col-lg-12 mb-4">
            <div class="card shadow">
                <div class="card-header bg-primary text-white py-3">
                    <h6 class="m-0 font-weight-bold">การจองล่าสุด</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="thead-light">
                                <tr>
                                    <th>หมายเลขการจอง</th>
                                    <th>ชื่อผู้จอง</th>
                                    <th>วันที่จอง</th>
                                    <th>สถานะ</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($Bookings->take(5) as $booking)
                                <tr>
                                    <td><strong>#{{$booking->BookingOrderID}}</strong></td>
                                    <td>{{$booking->user->name}}</td>

                                    <td>
                                        @if($booking->Booking_status == 3)
                                            <span class="badge bg-danger">คืนเงินแล้ว</span>
                                        @else
                                            {{$booking->PaymentDate == NULL ? 'ยังไม่จ่ายเงิน':'จ่ายเงินแล้ว'}}
                                        @endif
                                    </td>

                                    <td>
                                        @if($booking->deleted_at != NULL)
                                            <span class="badge bg-danger">เช็คเอาท์</span>
                                        @elseif($booking->Booking_status == 3)
                                            <span class="badge bg-danger">ยกเลิกการจอง</span>
                                        @else
                                            <span class="{{ $booking->Booking_status == 1 ? 'badge bg-success' : 'badge bg-secondary' }}">
                                                {{ $booking->Booking_status == 1 ? 'เช็คอินแล้ว' : 'รอการยืนยัน' }}
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer bg-white border-top">
                    <a href="{{ route('Admin.bookings') }}" class="btn btn-primary btn-sm float-right">ดูการจองทั้งหมด</a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .border-left-primary { border-left: .25rem solid #4e73df; }
    .border-left-success { border-left: .25rem solid #1cc88a; }
    .border-left-warning { border-left: .25rem solid #f6c23e; }
    
    .badge-success {
        background-color: #1cc88a;
        color: #000 !important;
    }
</style>
@endsection