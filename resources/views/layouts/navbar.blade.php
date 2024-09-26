<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title','')</title>
    <link rel="stylesheet" href="/css/nav.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- ลิงก์ไปยัง Bootstrap JS และ jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</head>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<body>
<div>
<nav class="navbar navbar-expand-lg  bg-warning sticky-top">
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
            <a class="nav-link" href="{{route('bookings.index')}}">ประวัติการจอง</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="Contack.html">ติดต่อเรา</a>
          </li>
        </ul>
        <!-- ถ้ายังไม่ login  -->
        @guest
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a href="{{ route('login') }}" class="btn btn-outline-primary ms-2">เข้าสู่ระบบ</a>
          </li>
          <li class="nav-item">
            <a href="{{ route('register') }}" class="btn btn-outline-primary ms-2">สมัครสมาชิก</a>
          </li>
          
        @endguest
        <!-- ถ้า login มาแล้ว -->
        @auth
        <li class="nav-item">
            <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                @csrf
                <button type="submit" class="btn btn-outline-primary ms-2" style="text-decoration: none;">
                    ออกจากระบบ
                </button>
            </form>
        </li>
        @endauth
        </ul>
        
      </div>
    </div>
  </nav>

  
    <div>
  @yield('content')
  </div>
</body>
</html>