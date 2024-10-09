@extends('layouts.AdminSidebar')
@section('content')
<style>
    *{
    font-family: "kanit";
}
.card{
    width: 500px;
}
</style>
    <div class="container">
    <h2>ประวัติรายงานสถานะ</h2>
    @if($booking->pet_status->isNotEmpty())
        @foreach($booking->pet_status as $status)
            <div class="card mb-3">
                <div class="card-body">
                    <p><strong>การรายงาน:</strong> {{ $status->Report }}</p>
                    @if($status->imgreport)
                        <img src="{{ asset('images/'.$status->imgreport) }}" alt="Report Image" class="img-fluid mb-2" />
                    @endif
                    <p><strong>วันที่:</strong> {{ $status->created_at->format('d M Y H:i') }}</p>
                </div>
            </div>
        @endforeach
    @else
        <p>ไม่มีรายงานสถานะสำหรับการจองนี้</p>
    @endif
</div>
@endsection
