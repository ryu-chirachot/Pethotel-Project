<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pawsome Stay Hotel</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset("css/edit.css")}}">
    <script src="
        https://cdn.jsdelivr.net/npm/sweetalert2@11.14.1/dist/sweetalert2.all.min.js
    "></script>
    

</head>
<style>
    
</style>
<body>
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script> --}}
    
@if (session('success'))
    <script>
        Swal.fire({
        position: "center",
        icon: "success",
        title: "แก้ไขเสร้จสิ้น",
        showConfirmButton: false,
        timer: 1500
    });
</script>
@endif

<div class="container">
        <div class="login-form">
        <form id="userForm" method="POST" action="{{ route('user.edit_update') }}">
    @csrf
    <div class="paw">
                    <img width="30" height="30" src="https://img.icons8.com/forma-bold-filled/24/cat-footprint.png" alt="cat-footprint"/>
                    <h4>Pawsome Stay Hotel</h4>
                    
                </div>
                <div class="text">
                    <h1>แก้ไขบัญชีผู้ใช้</h1>
                </div>
    <div class="name">
        <div class="info">
        <label for="email" value="{{ __('Name') }}" />
        <input id="name" class="form-control" type="text" placeholder="ชื่อ"  name="name" :value="old('name')" value="{{auth()->user()->name}}" required autofocus autocomplete="name" />
        </div>
    </div>

    <div class="info">
        <label for="email" value="{{ __('Email') }}" />
        <input id="email" class="form-control" type="email" placeholder="email" name="email" :value="old('email')" value="{{auth()->user()->email}}" required autocomplete="username"  />
    </div>

    <div class="info">
        <label for="password" value="{{ __('Password') }}" />
        <input id="password" class="form-control" type="password" name="password" placeholder="รหัสผ่าน"  required autocomplete="new-password" />
    </div>


    @if ($errors->has("msg"))
                <p class="text-danger">{{ $errors->first("msg") }}</p>
     @endif



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

    <button type="submit" id="editButton" class="btn">แก้ไขข้อมูล</button>
    <button type="submit" id="saveButton" class="btn btn-success" style="display: none;">บันทึก</button>
    <button type="button" id="cancelButton" class="btn btn-secondary" style="display: none;">ยกเลิก</button>
    </div>
</form>





        <!-- <form id="edit-form" method="POST" action="{{ route('user.edit_update') }}">
            @csrf
            <div class="paw">
                    <img width="30" height="30" src="https://img.icons8.com/forma-bold-filled/24/cat-footprint.png" alt="cat-footprint"/>
                    <h4>Pawsome Stay Hotel</h4>
                    
                </div>
                <div class="text">
                    <h1>แก้ไขบัญชีผู้ใช้</h1>
                </div>

            <div class="name">
            <div class="info">
                <label for="email" value="{{ __('Name') }}" />
                <input id="email" class="form-control" type="text" placeholder="ชื่อ"  name="name" :value="old('name')" value="{{auth()->user()->name}}" required autofocus autocomplete="name" />
            </div>
            </div>

            <div class="info">
                <label for="email" value="{{ __('Email') }}" />
                <input id="email" class="form-control" type="email" placeholder="email" name="email" :value="old('email')" value="{{auth()->user()->email}}" required autocomplete="username"  />
            </div>

            <div class="info">
                <label for="password" value="{{ __('Password') }}" />
                <input id="password" class="form-control" type="password" name="password" placeholder="รหัสผ่าน"  required autocomplete="new-password" />
            </div>

            @if ($errors->has("msg"))
                <p class="text-danger">{{ $errors->first("msg") }}</p>
            @endif



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
                    {{ __('บันทึกข้อมูล') }}
                </button>
            </div>

         
    
        </form> -->
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
</div>
</div>



{{-- 
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('userForm');
    const editButton = document.getElementById('editButton');
    const saveButton = document.getElementById('saveButton');
    const cancelButton = document.getElementById('cancelButton');
    const inputs = form.querySelectorAll('input');
    let originalValues = {};

    // Initially disable all inputs
    inputs.forEach(input => {
        input.disabled = true;
        originalValues[input.id] = input.value;
    });

    function enableEditing() {
        inputs.forEach(input => input.disabled = false);
        editButton.style.display = 'none';
        saveButton.style.display = 'inline-block';
        cancelButton.style.display = 'inline-block';
    }

    function disableEditing() {
        inputs.forEach(input => input.disabled = true);
        saveButton.style.display = 'none';
        cancelButton.style.display = 'none';
        editButton.style.display = 'inline-block';
    }

    editButton.addEventListener('click', enableEditing);

    cancelButton.addEventListener('click', function() {
        inputs.forEach(input => {
            input.value = originalValues[input.id];
        });
        disableEditing();
    });
    
    
});



</script> --}}


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>