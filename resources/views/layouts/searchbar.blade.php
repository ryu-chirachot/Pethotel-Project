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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<body>
<nav class="navbar navbar-expand-lg sticky-top">
    <div class="container-fluid ms-2 me-2">
        <a class="navbar-brand" href="/">
            <i class="fa-solid fa-paw"> Pawsome Stay Hotel</i>
        </a>
        <div class="d-flex d-lg-none ms-auto align-items-center">
            <span class="d-flex me-3 iconphone">
                
                
            </span>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText"
                aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>

        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('/') ? 'active' : '' }}" href="{{ route('home') }}">หน้าหลัก</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('bookings*') ? 'active' : '' }}" href="{{ route('bookings.index') }}">ประวัติการจอง</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('mypets*') ? 'active' : '' }}" href="{{ route('mypets') }}">สัตว์เลี้ยงของฉัน</a>
                </li>
                
            </ul>

            <!-- ถ้ายังไม่ login -->
            @guest
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a href="{{ route('login') }}" class="btn btn-danger">เข้าสู่ระบบ</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('register') }}" class="btn btn-danger">สมัครสมาชิก</a>
                </li>
            @endguest
            <!-- ถ้า login มาแล้ว -->
            @auth
            <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                @csrf
                <div class="user-menu">
                    <i class="bi bi-person-circle"></i>
                    <div class="dropdown-content">
                        @if(auth()->user()->role == 'admin')
                        <a href="/Admin/Home">หน้าผู้ดูแลระบบ</a>
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
    </div>
</nav>


<div class="banner">
        <div class="d-none d-md-block">
            <div class="circle-bg"></div>
            <div class="content">
                <h5 class="welcome">Welcome To</h5>
                <h1 class="title">Pawsome<br>Stay</h1>
            </div>
        </div>
        
    
        <div class="d-none d-md-block">
            <div class="pet-image"> <img class="img-banner1" src="{{asset("images/cat.png")}}" alt=""></div>
                <div class=""></div>
            
        </div>

        <div class="d-none d-md-block">
            <div class="pet-image"> <img class="img-banner2" src="{{asset("images/dog.png")}}" alt=""></div>
                <div class=""></div>
            
        </div>
    </div>
    


    <div id="cen" class="container sticky-top">
    <form id="searchForm" class="form" action="/room/search" method="get">
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
            <input type="date" id="check_in" name="check_in" value="{{ session('check_in') }}" placeholder="วัน-เดือน-ปี" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" required>
        </div>

        <div>
            <label for="check_out">สิ้นสุด</label>
            <input type="date" id="check_out" name="check_out" value="{{ session('check_out') }}" placeholder="วัน-เดือน-ปี" min="{{ \Carbon\Carbon::now()->addDay(1)->format('Y-m-d')}}" required>
        </div>

        <button type="submit" class="btn btn-warning">ค้นหาห้องพัก</button>
        
    </form>
</div>

    <div >
        @yield('content')
        @yield('review')
        </div>
        
</body>
</html>