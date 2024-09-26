
<div class="container">
    <h1>สถานะของ {{ $pet->name }}</h1>

    <div class="card">
        <div class="card-header">
            สถานะสุขภาพ
        </div>
        <div class="card-body">
            <p><strong>อุณหภูมิร่างกาย:</strong> {{ $pet->temperature }} °C</p>
            <p><strong>สุขภาพทั่วไป:</strong> {{ $pet->health_status }}</p>
            <p><strong>อาหาร:</strong> {{ $pet->meal }}</p>
            <p><strong>กิจกรรม:</strong> {{ $pet->activities }}</p>
        </div>
    </div>

    <a href="{{ route('bookings.index') }}" class="btn btn-secondary mt-3">กลับไปยังรายการจอง</a>
</div>

