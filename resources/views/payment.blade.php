@extends('layouts.navbar')
@section('content')
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/payment.css') }}">
</head>

<div class="container-fluid" id="section">
        <div class="room-sections-wrapper">
            <div class="room-section">
                <div class="card">ห้อง
                    <h2>{{$roomTypeName}}</h2>
                    <br>
                    เครื่องปรับอากาศ <br>
                    น้ำดื่ม <br>
                    เบาะนอน <br>
                    ลานสำหรับวิ่ง
                </div>
                <div class="card">
                    <h2>รายละเอียดการจอง</h2>
                    <div class="date-range">
                        <div class="date">
                            <div class="date-label">เช็คอิน</div>
                            <div class="date-value">{{$checkIn}}</div>
                            <div class="time">ตั้งแต่ 14:00</div>
                        </div>
                        <div class="date">
                            <div class="date-label">เช็คเอาท์</div>
                            <div class="date-value">{{$checkOut}}</div>
                            <div class="time">ก่อน 12:00</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="room-section">
                <div class="card">
                    <h2>สรุปราคา</h2>
                    <p>ราคา/ห้อง</p>
                    <div class="total-wrapper">
                        <div class="total">
                            <span>ยอดรวม</span>
                            <span>{{$price * \Carbon\Carbon::parse($checkIn)->diffInDays(\Carbon\Carbon::parse($checkOut))}} บาท</span>
                        </div>
                    </div>
                    
    
                </div>
                <form action="{{route('success')}}" method="post">
                    @csrf
                    <input type="hidden" name="room_id" value="{{ $room_id }}">
                    <input type="hidden" name="petTypeId" value="{{ $petTypeId }}">
                    <input type="hidden" name="roomTypeName" value="{{ $roomTypeName }}">
                    <input type="hidden" name="checkIn" value="{{ $checkIn }}">
                    <input type="hidden" name="checkOut" value="{{ $checkOut }}">
                    <input type="hidden" name="price" value="{{ $price }}">
                    <input type="hidden" name="pet_name" value="{{ $pet_name }}">
                    <input type="hidden" name="pet_breed" value="{{ $pet_breed }}">
                    <input type="hidden" name="pet_age" value="{{ $pet_age }}">
                    <input type="hidden" name="pet_weight" value="{{ $pet_weight }}">
                    <input type="hidden" name="pet_gender" value="{{ $pet_gender }}">
                    <input type="hidden" name="additional_info" value="{{ $additional_info }}">
                    <input type="hidden" name="price" value="{{$price * \Carbon\Carbon::parse($checkIn)->diffInDays(\Carbon\Carbon::parse($checkOut))}}">
                    <input type="hidden" name="pet_id" value="{{$pet_id}}">
                    <h2>ช่องทางการชำระเงิน</h2>
                    @foreach($payment as $pay)
                    @if($pay->PaymentMethodID == 1)
                        <p>
                        <input type="radio" class="btn-check" name="payment" id="success-outlined" value="{{$pay->PaymentMethodID}}" autocomplete="off" checked>
                        <label class="btn btn-outline-success" for="success-outlined">{{$pay->MethodName}}</label>
                        </p>
                    @else
                        <p>
                        <input type="radio" class="btn-check" name="payment" id="danger-outlined" value="{{$pay->PaymentMethodID}}" autocomplete="off">
                        <label class="btn btn-outline-success" for="danger-outlined">{{$pay->MethodName}}</label>
                        </p>
                    @endif
                    @endforeach
                <button type="submit" ><b>ยืนยัน</b></button>
                </form>
            </div>

        </div>
    </div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous">
</script>
@endsection