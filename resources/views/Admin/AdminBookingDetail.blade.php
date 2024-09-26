@extends('layouts.AdminSidebar')

@section('content')
<h1>รายละเอียดการจอง</h1>

<div class="reservation">
    <p>ชื่อผู้จอง: {{ $bookings->user->name }}</p>
    <p>1 ผู้เข้าพัก | {{ \Carbon\Carbon::parse($bookings->Start_date)->diffInDays($bookings->End_date) }} คืน</p>
    <p>วันที่เข้าพัก: {{ $bookings->Start_date }} ถึง {{ $bookings->End_date }}</p>
    <p>ห้องพัก: {{ $bookings->room->pet_Type_Room_Type->roomType->Rooms_type_name }}</p>
    <p>หมายเลขการจอง: <span class="booking-code">{{ $bookings->BookingOrderID }}</span></p>
    <b>การชำระเงิน: {{ $bookings->PaymentDate ? 'ชำระเงินแล้ว' : 'รอยืนยันการชำระเงิน' }}</b>

    <form action="{{ route('Admin.bookings.confirmPayment', $bookings->BookingOrderID) }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-success">ยืนยันการชำระเงิน</button>
    </form>

    <form action="{{ route('Admin.bookings.cancel', $bookings->BookingOrderID) }}" method="POST" onsubmit="Confirmcancel('{$bookings->BookingOrderID}')">
        @csrf
        <button type="submit" class="btn btn-danger">ยกเลิกการจอง</button>
    </form>

    <form action="{{ route('Admin.bookings.extend', $bookings->BookingOrderID) }}" method="POST">
        @csrf
        <label for="new_end_date">ขยายวันสิ้นสุด:</label>
        <input type="date" name="new_end_date" required>
        <button type="submit" class="btn btn-primary">ขยายเวลาการจอง</button>
    </form>
</div>
<script>
    function Confirmcancel(id){
        const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: "btn btn-success me-3",
                        cancelButton: "btn btn-danger"
                    },
                    buttonsStyling: true
                    });
                    swalWithBootstrapButtons.fire({
                    title: `คุณแน่ใจใช่ไหมว่าจะลบข้อมูลหมายเลขการจอง ${id} ?`,
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
                            window.location.href = `/Admin/booking/cancel/${id}`;
                        },800)
                    } else if (
                        /* Read more about handling dismissals below */
                        result.dismiss === Swal.DismissReason.cancel
                    ) {
                        swalWithBootstrapButtons.fire({
                        title: "ยกเลิก",
                        text: "ข้อมูลของคุณยังคงอยู่ :)",
                        icon: "error"
                        });
                    }
        });
    }
</script>
@endsection
