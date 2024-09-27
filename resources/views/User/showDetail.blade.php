
<div class="container">
    <h1>รายละเอียดการจอง #{{ $booking->BookingOrderID }}</h1>

    <div class="card">
        <div class="card-header">
            <h2>ข้อมูลการจอง</h2>
        </div>
        <div class="card-body">
            <h2>
                <p><strong>ชื่อสัตว์เลี้ยง:</strong> {{ $booking->pet->Pet_name }}</p>
                <p><strong>ประเภทห้อง:</strong> {{ $booking->room->pet_Type_Room_Type->roomType->Rooms_type_name }}</p>
                <p><strong>วันที่เช็คอิน:</strong> {{ $booking->Start_date }}</p>
                <p><strong>วันที่เช็คเอาท์:</strong> {{ $booking->End_date }}</p>
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
                <a href="{{ route('Admin.bookings.detail', $booking->BookingOrderID) }}" class="btn btn-custom" disabled>ดูรายละเอียด</a>
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
        
        @endif
            </h2>
        </div>
    </div>

    <a href="{{ route('bookings.index') }}" class="btn btn-secondary mt-3">กลับไปยังรายการจอง</a>
</div>

