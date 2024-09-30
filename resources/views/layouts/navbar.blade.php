<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title','')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
        * {
            font-family: "Kanit", sans-serif;
        }
        body {
            font-family: Kanit;
        }
        .navbar {
            background-color: #ffce72;
            z-index: 1000;
            padding: 10px 0;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .navbar-brand {
            font-weight: 600;
            color: #7f0e0e;
            transition: color 0.3s ease;
        }
        .navbar-brand:hover {
            color: #ff6b6b;
        }
        .navbar-brand i {
            margin-right: 5px;
        }
        .nav-link {
            color: #7f0e0e;
            font-weight: 500;
            transition: all 0.3s ease;
            position: relative;
            padding: 8px 15px;
        }
        .nav-link:hover, .nav-link:focus, .nav-link.active {
            color: #ff6b6b;
        }
        .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            width: 0;
            height: 2px;
            background-color: #ff6b6b;
            transition: all 0.3s ease;
        }
        .nav-link:hover::after, .nav-link:focus::after, .nav-link.active::after {
            width: 100%;
            left: 0;
        }
        .bi-person-circle {
            font-size: 30px;
            margin: 0px 20px 0 0;
            color: #7f0e0e;
            transition: color 0.3s ease;
        }
        .bi-person-circle:hover {
            color: #ff6b6b;
        }
        .user-menu {
            position: relative;
            display: inline-block;
        }
        .dropdown-content {
            display: none;
            position: absolute;
            right: 0;
            background-color: #fff;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
            border-radius: 5px;
            overflow: hidden;
        }
        .user-menu:hover .dropdown-content {
            display: block;
        }
        .dropdown-content a, .log-out-butt {
            color: #7f0e0e;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            transition: all 0.3s ease;
        }
        .dropdown-content a:hover, .log-out-butt:hover {
            background-color: #ffce72;
            color: #ff6b6b;
        }
        .log-out-butt {
            background: none;
            border: none;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
            text-align: left;
        }
        .fa-paw {
            letter-spacing: 2.2px;
        }
        .btn-outline-primary {
            color: #7f0e0e;
            border-color: #7f0e0e;
            transition: all 0.3s ease;
        }
        .btn-outline-primary:hover, .btn-outline-primary:focus {
            color: #fff;
            background-color: #7f0e0e;
            border-color: #7f0e0e;
        }
        @media (max-width: 991px) {
            .navbar-nav {
                background-color: #fff;
                padding: 10px;
                border-radius: 5px;
                box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.1);
            }
            .nav-link::after {
                display: none;
            }
            .nav-link:hover, .nav-link:focus, .nav-link.active {
                background-color: #ffce72;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container">
            <a class="navbar-brand" href="/">
                <i class="fa-solid fa-paw"></i> Pawsome stay Hotel
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText"
                aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{route('home')}}">หน้าหลัก</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('bookings.index') ? 'active' : '' }}" href="{{route('bookings.index')}}">ประวัติการจอง</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('mypets') ? 'active' : '' }}" href="{{route('mypets')}}">สัตว์เลี้ยงของฉัน</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('Contack.html') ? 'active' : '' }}" href="Contack.html">ติดต่อเรา</a>
                    </li>
                </ul>
                @guest
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a href="{{ route('login') }}" class="btn btn-outline-primary ms-2">เข้าสู่ระบบ</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('register') }}" class="btn btn-outline-primary ms-2">สมัครสมาชิก</a>
                    </li>
                </ul>
                @endguest
                @auth
                <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                    @csrf
                    <div class="user-menu">
                        <i class="bi bi-person-circle"></i>
                        <div class="dropdown-content">
                            @if(auth()->user()->role == 'admin')
                            <a href="/Admin/Home">Admin Home</a>
                            @endif
                            <a href="/edit">แก้ไขข้อมูล</a>
                            <button type="submit" class="log-out-butt text-danger">
                                ออกจากระบบ
                            </button>
                        </div>
                    </div>
                </form>
                @endauth
            </div>
        </div>
    </nav>

    <div>
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>