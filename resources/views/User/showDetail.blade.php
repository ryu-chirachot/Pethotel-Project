
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
                <p><strong>สถานะ:</strong> {{ $booking->Booking_status }}</p>
            </h2>
        </div>
    </div>

    <a href="{{ route('bookings.index') }}" class="btn btn-secondary mt-3">กลับไปยังรายการจอง</a>
</div>

