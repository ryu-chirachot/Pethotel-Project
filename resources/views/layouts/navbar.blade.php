<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title','')</title>
    <link rel="stylesheet" href="/css/nav.css">
   
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">

</head>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<body>

<!-- เรียกใช้ SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<nav class="navbar navbar-expand-lg sticky-top">
    <div class="container-fluid ms-2 me-2">
        <a class="navbar-brand" href="/">
            <i class="fa-solid fa-paw"> Pawsome stay Hotel</i>
        </a>
        <div class="d-flex d-lg-none ms-auto align-items-center">
            <span class="d-flex me-3">
            </span>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText"
                aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>


      <div class="collapse navbar-collapse " id="navbarText">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0 ">
          <li class="nav-item ">
            <a class="nav-link" href="{{route('home')}}">หน้าหลัก</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('bookings.index')}}">ประวัติการจอง</a>
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
            <!-- <div>
            <i class="bi bi-person-circle"></i>
            </div> -->
            <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                @csrf
              
                <div class="user-menu">
                  <i class="bi bi-person-circle"></i>
                  <div class="dropdown-content">
                    @if(auth()->user()->role == 'admin')
                    <a href="/Admin/Home">Admin Home</a>
                    <a href="/edit">แก้ไขข้อมูล</a>
                    <button type="submit" class="log-out-butt text-danger" style="text-decoration: none;">
                        ออกจากระบบ
                    </button>

                    @else
                    <a href="/edit">แก้ไขข้อมูล</a>
                    <button type="submit" class="log-out-butt text-danger" style="text-decoration: none;">
                        ออกจากระบบ
                    </button>
                    @endif
                  </div>
                </div>
                
            </form>
        
        @endauth
        </ul>
    </div>
</nav>

<script>
    document.getElementById('guest-login').addEventListener('click', function (e) {
        e.preventDefault(); // หยุดการทำงานของลิงก์เดิม
        Swal.fire({
            title: 'โปรดเข้าสู่ระบบ',
            text: "คุณจำเป็นต้องเข้าสู่ระบบก่อนทำรายการนี้",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'เข้าสู่ระบบ'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "{{ route('login') }}"; // เปลี่ยนเส้นทางไปยังหน้า login
            }
        });
    });

    document.getElementById('guest-register').addEventListener('click', function (e) {
        e.preventDefault(); // หยุดการทำงานของลิงก์เดิม
        Swal.fire({
            title: 'โปรดสมัครสมาชิก',
            text: "คุณจำเป็นต้องสมัครสมาชิกก่อนทำรายการนี้",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'สมัครสมาชิก'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "{{ route('register') }}"; // เปลี่ยนเส้นทางไปยังหน้า register
            }
        });
    });
</script>
    <div>
  @yield('content')
  </div>
</body>
</html>