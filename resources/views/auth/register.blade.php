
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pawsome Stay Hotel</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>
<style>
     body {
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
</style>
<body>
    
<div class="container">
        <div class="login-form">
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="paw">
                    <img width="30" height="30" src="https://img.icons8.com/forma-bold-filled/24/cat-footprint.png" alt="cat-footprint"/>
                    <h4>Pawsome Stay Hotel</h4>
                    
                </div>
                <div class="text">
                    <h1>สร้างบัญชีใหม่</h1>
                    <p>มีบัญชีอยู่แล้ว <a href="login"><b>เข้าสู่ระบบ</b></a></p>
                </div>

            <!-- <div class="name"> -->
            <div class="info">
                <label for="name" value="{{ __('Name') }}" />
                <input id="email" class="form-control" type="text" placeholder="ชื่อ"  name="name" :value="old('name')" required autofocus autocomplete="name" />
            </div>
            <!-- </div> -->

            <div class="info">
                <label for="email" value="{{ __('Email') }}" />
                <input id="email" class="form-control" type="email" placeholder="email" name="email" :value="old('email')" required autocomplete="username"  />
            </div>

            <div class="info">
                <label for="password" value="{{ __('Password') }}" />
                <input id="password" class="form-control" type="password" name="password" placeholder="สร้างรหัสผ่าน" required autocomplete="new-password" />
            </div>

            <div class="info">
                <label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <input id="password_confirmation" class="form-control" type="password"placeholder="ยืนยันรหัสผ่าน" name="password_confirmation" required autocomplete="new-password" />
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-label for="terms">
                        <div class="flex items-center">
                            <x-checkbox name="terms" id="terms" required />

                            <div class="ms-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Terms of Service').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Privacy Policy').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-label>
                </div>
            @endif
           

        

                <button type="submit">
                    {{ __('สร้างบัญชี') }}
                </button>
            </div>
        </form>
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

        
