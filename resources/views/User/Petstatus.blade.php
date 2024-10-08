@extends('layouts.navbar')

@section('content')
<link rel="stylesheet" href="{{asset("/css/petstatus.css")}}">
<div id="container">
    <div class="card">
        <div class="card-header">
            <h4>สถานะสัตว์เลี้ยง </h4>
            <h4>หมายเลขการจอง #{{$booking->BookingOrderID}}</h4>
        </div>
        <div class="card-body">
            @if($booking)
                @if($booking->pet)
                    
                    <h5>ชื่อสัตว์เลี้ยง : {{$booking->pet->Pet_name}}</h5>
                    
                @else
                    <div class="alert alert-warning" role="alert">
                        ไม่มีสัตว์เลี้ยงสำหรับการจองนี้
                    </div>
                @endif
            @else
                <div class="alert alert-danger" role="alert">
                    ไม่พบข้อมูลการจอง
                </div>
            @endif
            <hr>
            
            @if(isset($status) && $status->isNotEmpty())
                @foreach ($status as $st)
                    <div>รายงานโดย: {{$st->user->name}} <br> วันที่: {{ $st->updated_at }} น.</div>
                    <div class="status-item mb-3">
                        <div>การรายงาน :{{ $st->Report }}</div>
                        
                    </div>
                @endforeach
            @else
                <div class="alert alert-info" role="alert">
                    ไม่พบการรายงาน
                </div>
            @endif
        </div>
        <div class="card-footer text-center">
            <a href="{{ route('bookings.index') }}" class="btn btn-primary">กลับไปยังรายการจอง</a>
        </div>
    </div>
</div>
@endsection
