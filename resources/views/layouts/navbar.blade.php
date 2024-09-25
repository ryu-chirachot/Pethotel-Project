<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title','')</title>
    <link rel="stylesheet" href="/css/nav.css">
</head>
<body>
<div>
    <nav>
        <div class="logo-container">
            <img src="logo.png" alt="Logo" class="logo">
            <span class="website-name">ชื่อเว็บไซต์</span>
        </div>
        <ul class="nav-links">
            <li><a href="#room">Room</a></li>
            <li><a href="#booking">Booking</a></li>
            <li><a href="#about">About</a></li>
        </ul>
    </nav>  
    </div>
    <div>
  @yield('content')
  </div>
</body>
</html>