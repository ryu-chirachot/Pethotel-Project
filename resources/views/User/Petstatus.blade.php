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
                    <h5>รายงานโดย {{$st->user->name}} สถานะ ณ เวลา {{ $st->updated_at }} น.</h5>
                    
                        @php
                            // แยกชื่อไฟล์รูปภาพที่คั่นด้วย comma
                            $images = explode(',', $st->imgreport);
                        @endphp

                        @foreach ($images as $image)
                            <div class="col-md-4">
                                <img src="{{ asset('/images/' . trim($image)) }}" class="img-fluid mt-4"  alt="รูปภาพการรายงาน">
                            </div>
                        @endforeach
                   
                    <div class="status-item mb-3 mt-4">
                        <h6><b>รายงาน :</b>{{ $st->Report }}</h6>
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