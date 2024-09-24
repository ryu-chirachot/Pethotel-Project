<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title','')</title>
    <link rel="stylesheet" href="/css/nav.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<body>
<div>
<nav class="navbar navbar-expand-lg  bg-warning">
    <div class="container-fluid ms-2 me-2">
      <a class="navbar-brand" href="#">
        <img class="logo" src="img/logo2.png" alt="รูปภาพโลโก้เว็บไซต์ Tail and Paw" height="50">
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
            <a class="nav-link" href="{{route('home')}}">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="About.html">test</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="Contack.html">Contact</a>
          </li>
        </ul>


      <!-- ปุ่ม Login/Register -->
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        @if (Route::has('login'))
          @auth
            <!-- ถ้าผู้ใช้ล็อกอินแล้ว แสดงลิงก์ Dashboard -->
            <li class="nav-item">
              <a class="nav-link" href="{{ url('/dashboard') }}">Dashboard</a>
            </li>
          @else
            <!-- ถ้ายังไม่ได้ล็อกอิน แสดงลิงก์ Login -->
            <li class="nav-item">
              <a class="nav-link" href="{{ route('login') }}">Login</a>
            </li>

            @if (Route::has('register'))
              <!-- ลิงก์ Register -->
              <li class="nav-item">
                <a class="nav-link" href="{{ route('register') }}">Register</a>
              </li>
            @endif
          @endauth
        @endif
      </ul>
    </div>
  </div>
</nav>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


  
    <div>
  @yield('content')
  </div>
</body>
</html>