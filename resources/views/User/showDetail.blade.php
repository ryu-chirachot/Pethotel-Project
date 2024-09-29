@extends ('layouts.navbar')
@section('content')
<link rel="stylesheet" href="{{asset("/css/showdetail.css")}}">
<div class="container">
    <h1>รายละเอียดการจอง #{{ $booking->BookingOrderID }}</h1>

    <div class="card">
        <div class="card-header">
            <h2>ข้อมูลการจอง</h2>
        </div>
        <div class="card-body">
            <h2>
                <p class="underline"><strong>ชื่อสัตว์เลี้ยง:</strong> 
                    @foreach($booking->user->pets as $pet)
                    {{ $pet->Pet_name}} 
                    @endforeach
                </p>
                <p class="underline"><strong>ประเภทห้อง:</strong> {{ $booking->room->pet_Type_Room_Type->roomType->Rooms_type_name }}</p>


              <div class="check-in">
                <div><p  class="underline"><strong>วันที่เช็คอิน:</strong> <br><br> {{ $booking->Start_date }}</p></div>
                <div><p  class="underline"><strong>วันที่เช็คเอาท์:</strong> <br><br>{{ $booking->End_date }}</p></div>
              </div>
                @if($booking->deleted_at)
                <p><strong>สถานะ:</strong></p>
                <span class="status-checkout">
                    เช็คเอาท์
                </span>
                <hr>
                <p><strong>สถานะการชำระเงิน:</strong>
                    <span class="{{ $booking->PaymentDate ? 'text-success' : 'payment-pending' }}">
                    {{$booking->PaymentDate ? 'ชำระเงินแล้ว' : 'รอยืนยันการชำระเงิน'}}
                    </span>
                </p><hr>
            </div>
            <div class="card-footer text-right">
                <a href="{{ route('bookings.index') }}" class="btn btn-secondary mt-3">กลับไปยังรายการจอง</a>
            </div>
            @else
                <p><strong>สถานะ:</strong>
                <span class="{{ $booking->Booking_status == 0 ? '' : 'status-check' }}">
                    {{ $booking->Booking_status == 0 ? 'รอการยืนยัน' : 'เช็คอินแล้ว' }}
                </span>
            </p><hr>
            
            <p><strong>สถานะการชำระเงิน:</strong>
                <span class="{{ $booking->PaymentDate ? 'text-success' : 'payment-pending' }}">
                    {{$booking->PaymentDate ? 'ชำระเงินแล้ว' : 'รอยืนยันการชำระเงิน'}}
                </span>
            </p><hr>
        </div>
            <div class="card-footer text-right">
                <a href="{{ route('bookings.index') }}" class="btn btn-secondary mt-3">กลับไปยังรายการจอง</a>
                <a href="{{ route('pets.status',$booking->BookingOrderID) }}" class="btn btn-info mt-3">ติดตามสถานะสัตว์เลี้ยง</a>
            </div>

            
        @endif
            </h2>
        </div>
    </div>


    
</div>
@endsection
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

