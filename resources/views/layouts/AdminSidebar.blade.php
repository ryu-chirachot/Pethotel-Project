<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pet Hotel Management System</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- sweetalert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/Rooms.css') }}">
    <!-- icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">


    <style>
        *{
            font-family: "Mitr", sans-serif;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="d-flex">
        <nav class="sidebar bg-light p-3" style="width: 250px;">
            <h4 class="mb-4 text-center">
                <i class="fas fa-paw"></i>&nbsp;
                Pawsome Stay
            </h4>
            <hr>
            <ul class="nav flex-column">
                <li class="nav-item mb-3">
                    <a class="nav-link {{ Request::is('Admin/Home') ? 'active' : '' }}" href="{{route('Admin.index')}}">
                        <i class="fas fa-home me-2"></i>หน้าแรก
                    </a>
                </li>
                <li class="nav-item mb-3">
                    <a class="nav-link {{ Request::is('Admin/Bookings') ? 'active' : '' }}" href="{{route('Admin.bookings')}}">
                        <i class="fas fa-book me-2"></i> การจอง
                    </a>
                </li>

                <li class="nav-item mb-3" id="Rooms">
                    <a class="nav-link" id="roomsButton">
                        <i class="fas fa-bed me-2"></i>ห้องพัก<i id="drop" class="fas fa-caret-down"></i>
                    </a>
                    <ul id="roomSubMenu" style="display: none;">
                        <li class="nav-item mb-1" style="margin-top: 5px;">
                            <a class="nav-link {{ Request::is('Admin/Rooms') ? 'active' : '' }}" href="{{route('Admin.rooms')}}">แก้ไขห้องพัก</a>
                        </li>
                        <li class="nav-item mb-1">
                            <a class="nav-link {{ Request::is('Admin/Rooms/selecttype') ? 'active' : '' }}" href="{{route('Admin.rooms.type')}}">เพิ่มห้องพัก</a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item mb-3">
                    <a class="nav-link {{ Request::is('Admin/user') ? 'active' : '' }}" href="{{route('Admin.user')}} " data-toggle="tooltip" data-placement="right" title="ดูผู้ใช้ทั้งหมด">
                    <i class="fas fa-users fa text-gray me-2"></i>ผู้ใช้ทั้งหมด
                    </a>
                </li>
                
                @auth
                <li class="nav-item mb-3">
                    <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display: none;">
                        @csrf
                    </form>
                    <a class="nav-link" href="" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt me-2"></i>ออกจากระบบ
                    </a>
                </li>
                @endauth
            </ul>
        </nav>

        <!-- Main Content -->
        <div class="content p-4" style="flex-grow: 1;">
            @yield('content')
        </div>
    </div>

    <!-- Bootstrap Bundle with Popper.js และ Jquery-->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/rooms.js') }}"></script>
</body>

</html>
