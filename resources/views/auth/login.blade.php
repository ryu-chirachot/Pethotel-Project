<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pawsome Stay Hotel</title>
   
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
     <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<style>
   /* body {
            background-color: #E7F2F4;
            font-family: Kanit;
        }
        .container {
            display: flex;
            justify-content: space-between;
            max-width: 1200px;
            margin: 100px auto 0;
            padding: 10px 50px 50px;
            background-color: #FEFCF4;
            border-radius: 10px;
        }
      
        
        .paw {
            display: flex;
            align-items: center;
            gap: 20px;
            padding:20px 0;
        }
        .paw h4 {
            margin-right: 10px;
            font-weight: 400;
        
        }
        .info {
            margin-bottom: 15px;
        }
      
        button {
            margin: 10px 0px 0px 125px;
            padding: 10px 40px;
            border: none;
            background-color: #FFD700;
            color: #6C620F;
            font-size: 20px;
            font-weight: bold;
            border-radius: 10px;
            cursor: pointer;
            margin-left: auto;
            margin-right: auto;
        }
        h1{
            font-weight: bold;
        }
        a {
            text-decoration: none;
            color: black;
        }
        i {
            color: rgba(0, 0, 0, 0.5);
        }
        .grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
        }
        .grid-item {
            background-color: #f0f0f0;
            padding: 20px;
            text-align: center;
        }
        .login-form{
            flex: 4;
        }

    */
    .grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
        }
        .grid-item {
            background-color: #f0f0f0;
            padding: 20px;
            text-align: center;
        }
        .login-form{
            flex: 4;
        }
    

</style>
<body>
  
<div class="container">
        <div class="login-form">
            @session('status')
                <div class="mb-4 font-medium text-sm text-green-600">
                    {{ $value }}
                </div>
            @endsession
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="paw">
                    <img width="30" height="30" src="https://img.icons8.com/forma-bold-filled/24/cat-footprint.png" alt="cat-footprint"/>
                    <h4>Pawsome Stay Hotel</h4>
                    
                </div>
                <div class="text">
                    <h1>เข้าสู่ระบบ</h1>
                    <p>ยังไม่มีบัญชี? <a href="register"><b>สร้างบัญชี</b></a></p>
                </div>
                <!-- <form method="POST" action="{{ route('login') }}">
                    @csrf -->
                    <div class="info">
                        <label for="email">{{ __('Email') }}</label>
                        <input id="email" name="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" aria-label="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="info">
                        <label for="password">{{ __('Password') }}</label>
                        <input id="password" name="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" aria-label="password" required autocomplete="current-password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                

                @if ($errors->has('msg'))
                    <p class="text-danger">{{ $errors->first('msg') }}</p>
                @endif

                
                
                <div>
                    @if (Route::has('password.request'))
                        <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                            <i>{{ __('ลืมรหัสผ่าน ?') }}</i>
                        </a>
                    @endif
                    <br><br>
       
                    <button  type="submit">
                        {{ __('เข้าสู่ระบบ') }}
                    </button>
                </div>
            </form>
        </div>
        <div class="col-7">
        <div class="grid">
            <div class="grid-item">
                <img class="img-dog" src="{{ asset('images/dog.png') }}" alt="Dog">
            </div>
            <div class="grid-item">
                <img class="img-cat" src="{{ asset('images/cat.png') }}" alt="Cat">
            </div>
            <div class="grid-item">
                <img class="img-bird" src="{{ asset('images/birdd.png') }}" alt="Bird">
            </div>
            <div class="grid-item">
                <img class="img-rabbit" src="{{ asset('images/rabbitt.png') }}" alt="Rabbit">
            </div>
        </div>
    </div>
    
    
   
    
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>

    