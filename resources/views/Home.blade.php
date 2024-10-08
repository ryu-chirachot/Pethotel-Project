<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pawsome Hotel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container-fluid bg-primary text-white border-primary">  
<h1 align=center>Pawsome Hotel</h1>
<h2 align=center>รายละเอียด</h2>
</div>
ืื<nav>
    <ul>
        <li>Room</li>
        <li>Booking</li>
        <li>About</li>

<!-- </div> -->
<form action="/students/insert" method="post">
        @csrf
        <p>Add student</p>
        <p>ชื่อ-นามสกุล : <input type="text" name="name"></p>
        <p>อายุ <input type="number" name="age"></p>
        <p>เกรด <select name="grade">
        <option value="A">A</option>
        <option value="B">B</option>
        <option value="C">C</option>
        <option value="D">D</option>
        <option value="F">F</option>    
    </select>
        </p>
        <button type="submit" name="submit">Add student</button>
    </form>
</body>
</html>