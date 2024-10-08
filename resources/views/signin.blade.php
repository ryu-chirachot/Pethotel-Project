<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=\, initial-scale=1.0">
    <title>login</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<style>
        
        @import url('https://fonts.googleapis.com/css2?family=Mitr:wght@200;300;400;500;600;700&display=swap');
        *{
            font-family: "Mitr", sans-serif;
        }
    body{
        background-color: #E7F2F4;
    }
    h1,a{
        font-weight:600;
        text-decoration: none;
    }
    a:link{
        color: black;
    }
    a:visited{
        color: #636262;
    }
    h1,p{
        margin: 0px 20px;
     }
     .content-form{
        border-radius: 10px;
        margin-top: 100px;
        width: 70%;
        height: 500px;
        background-color: #FEFCF4;
        margin-left:auto ;
        margin-right: auto;
        padding: 30px;
     }
     .login-info{
        width: 400px;
        background-color: #f6d10f4d;
        margin: 30px 20px;
        padding: 15px;
        color: #636262;
        border-radius: 10px;
     }
     #button{
        font-weight: 500;
        margin-top: 30px;
        margin-left: 10pc ;
        font-size: 20px;
        padding: 5px 30px;
        border-radius: 5px;
        border: none;
        color: #6C620F;
        background-color: #FFD700;
     }
     .logo h3{
        gap: 10px;
        display: flex;
        font-weight: 400;
        margin-top: -5px;
        
     }
     .logo img{
        height: 28px;
        width: 30px;
     }
    
     
     
   
    
</style>
<body>
    <form action="">
        <div class="content-form">
            <div>
                <div class="logo">
                <h3><img  src="https://img.icons8.com/ios-filled/100/cat-footprint.png" alt="cat-footprint"/>Pawsome Stay Hotel</h3>
                </div>
                <h1 style="font-size: 50px;">เข้าสู่ระบบ</h1>
                <p>มีบัญชีอยู่แล้ว<a href="login"> เข้าสู่ระบบ</a></p>
                <div class="login-info">เบอร์โทรศัพท์</div>
                <div class="login-info">Email</div>
                <div class="login-info" >รหัสผ่าน</div>
                <input type="button" value="เข้าสู่ระบบ" id="button">
            </div>
        
        </div>
    </form>
   
    
</body>
</html>