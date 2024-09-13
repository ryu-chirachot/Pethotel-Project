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
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/Rooms.css') }}">
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
                <img src="https://img.icons8.com/ios-filled/100/cat-footprint.png" alt="cat-footprint" style="width: 30px; height: 30px; margin-right: 10px;" >
                Pawsome Stay
            </h4>
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
                <li class="nav-item mb-3">
                    <a class="nav-link {{ Request::is('Admin/Rooms') ? 'active' : '' }}" href="{{route('Admin.rooms')}}">
                        <i class="fas fa-bed me-2"></i>ห้องพัก
                    </a>
                </li>
                <li class="nav-item mb-3">
                    <a class="nav-link {{ Request::is('Admin/Pets') ? 'active' : '' }}" href="{{route('Admin.pets')}}">
                        <i class="fas fa-paw me-2"></i>สัตว์เลี้ยง
                    </a>
                </li>
                <li class="nav-item mb-3">
                    <a class="nav-link {{ Request::is('Admin/Payments') ? 'active' : '' }}" href="{{route('Admin.payments')}}">
                        <i class="fas fa-wallet me-2"></i>การชำระเงิน
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('Admin/Settings') ? 'active' : '' }}" href="{{route('Admin.setting')}}">
                        <i class="fas fa-cog me-2"></i>การตั้งค่า
                    </a>
                </li>
            </ul>
        </nav>

        <!-- Main Content -->
        <div class="content p-4" style="flex-grow: 1;">
            @yield('content')
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
