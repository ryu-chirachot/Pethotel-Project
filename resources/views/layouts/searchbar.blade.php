<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title','')</title>
    <link rel="stylesheet" href="/css/search.css">
    <link rel="stylesheet" href="/css/nav.css">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Thai:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">
  
</head>
<body id="mg">
   <div >
    <nav >
        <div  class="logo-container">
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


    <div id="cen" class="container">
        <form class="booking-form" action="/room/search" method="post">
            @csrf
            <div>
        <p>
        <select  name="pet_type_id" id="petSelect">
            
            @foreach($p_type as $type)
                <option  value="{{ $type->Pet_type_id }}">{{ $type->Pet_nametype }}</option>
            @endforeach
        </select>
            <label>วันเข้าพัก</label>
            <input type="date" name="check_in">
            <label>สิ้นสุด</label>
            <input type="date" name="check_out">
        </p>
            <button type="submit">ค้นหาห้องพัก</button>
        </form>
    </div>
    <div id="cen" class="container">
        @yield('content')
        </div>
</body>
</html>