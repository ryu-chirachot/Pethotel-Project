@extends('layouts.AdminSidebar')
@section('content')

<div class="container-fluid py-4">
    @if($users->isEmpty())
        <div class="alert alert-warning" role="alert">
            ยังไม่พบผู้ใช้
        </div>
    @else
        @foreach($users as $user)
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="mb-0">รายละเอียดผู้ใช้: {{ $user->name }}</h5>
                </div>
                <div class="card-body">
                    <h6 class="font-weight-bold">ข้อมูลสัตว์เลี้ยง</h6>
                    <ul class="list-group mb-3">
                        @if($user->pets->isNotEmpty())
                            @foreach($user->pets as $pet)
                                <li class="list-group-item">
                                    <strong>ชื่อ:</strong> {{ $pet->Pet_name }} 
                                    <strong>ประเภท:</strong> {{ $pet->petType->Pet_nametype }} 
                                    <strong>สายพันธุ์:</strong> {{ $pet->Pet_breed }}
                                </li>
                            @endforeach
                        @else
                            <li class="list-group-item">ไม่มีข้อมูลสัตว์เลี้ยง</li>
                        @endif
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
            </div>
        @endforeach
    @endif
</div>

@endsection
