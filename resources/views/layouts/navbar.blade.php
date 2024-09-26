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
<!-- เรียกใช้ SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<nav class="navbar navbar-expand-lg bg-warning">
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
                    <a class="nav-link" href="{{route('home')}}">หน้าหลัก</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="About.html">ประวัติการจอง</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="Contack.html">ติดต่อเรา</a>
                </li>
            </ul>

            <div class="ml-auto">
                <ul class="navbar-nav p-auto">
                    @auth
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-toggle="dropdown" aria-expanded="false">
                                {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="#">แก้ไขข้อมูล</a></li>
                                <li><a class="dropdown-item" href="#">ศูนย์ช่วยเหลือ</a></li>
                                <li>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                    <a class="dropdown-item" href="#"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">ออกจากระบบ</a>
                                </li>
                            </ul>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
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