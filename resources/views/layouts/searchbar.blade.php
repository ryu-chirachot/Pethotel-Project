@include('layouts.navbar')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ค้นหาที่พัก</title>
    <link rel="stylesheet" href="/css/search.css">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Thai:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">
  
</head>
<body>
    
        
    <div id="cen" class="container">
        <form class="booking-form" action="/room/search" method="post">
            <div>
        <p>
        <select name="pettype">
        <option>ประเภทสัตว์เลี้ยง</option>
            @foreach($p_type as $p_type)
            
                <option value="{{$p_type->pet_type_id}}">{{$p_type->Pet_nametype}}</option>
            @endforeach
        </select>
            <label>วันเข้าพัก</label>
            <input type="date" name="check_in">
            <label>สิ้นสุด</label>
            <input type="date" name="check_out">
        </p>
            <div><button type="submit" >ค้นหาห้องพัก</div>
        </form>
        
    </div>
    <div>
    </div>
</body>
</html>
</html>