<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title','')</title>
    <link rel="stylesheet" href="/css/search.css">
    <link rel="stylesheet" href="/css/nav.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Thai:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  
</head>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<body>
<nav class="navbar navbar-expand-lg  bg-warning">
    <div class="container-fluid ms-2 me-2">
      <a class="navbar-brand" href="#">
      <i class="fa-solid fa-paw"> Paw some Hotel</i>
      </a>
      <div class="d-flex d-lg-none ms-auto align-items-center">
        <span class="d-flex me-3 iconphone">
          <a class="nav-link me-2" href="shopping.html"><i class="bi bi-cart3"></i></a>
          <a class="nav-link" href="#">เข้าสู่ระบบ</a>
        </span>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText"
          aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      </div>

      <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      
          <li class="nav-item">
            <a class="nav-link" href="{{route('home')}}">
            หน้าหลัก</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="About.html">ประวัติการจอง</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="Contack.html">ติดต่อเรา</a>
          </li>
        </ul>


        <ul class="navbar-nav ms-auto">
         
          <li class="nav-item">
            <a href="login.html" class="btn btn-outline-primary ms-2">เข้าสู่ระบบ</a>
          </li>
          <li class="nav-item">
            <a href="register.html" class="btn btn-outline-primary ms-2">สมัครสมาชิก</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>



    <div id="cen" class="container">
    <form class="booking-form" action="/room/search" method="post">
        @csrf
        <div>
            <label for="petSelect">เลือกประเภทสัตว์เลี้ยง</label>
            <select name="pet_type_id" id="petSelect" required>
                <option value="">เลือกประเภทสัตว์เลี้ยง</option>
                @foreach($p_type as $type)
                <option value="{{ $type->Pet_type_id }}" {{ session('pet_type_id') == $type->Pet_type_id ? 'selected' : '' }}>
                    {{ $type->Pet_nametype }}
                </option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="check_in">วันเข้าพัก</label>
            <input type="date" id="check_in" name="check_in" value="{{ session('check_in') }}" placeholder="วัน-เดือน-ปี" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
        </div>

        <div>
            <label for="check_out">สิ้นสุด</label>
            <input type="date" id="check_out" name="check_out" value="{{ session('check_out') }}" placeholder="วัน-เดือน-ปี" min="{{ \Carbon\Carbon::now()->addDay(1)->format('Y-m-d')}}">
        </div>

        <button type="submit">ค้นหาห้องพัก</button>
    </form>
</div>

    <div >
        @yield('content')
        @yield('review')
        </div>
</body>
</html>