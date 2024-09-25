<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        // ตรวจสอบข้อมูลที่ส่งมาจากฟอร์ม
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
       
        $email = $request->input('email');
        $password = $request->input('password');
    
   
        $user = User::where('email', $email)->first();
    
        if ($user && Hash::check($password, $user->password)) {
         
            Auth::login($user);
    
            
            return redirect()->route('dashboard');
        } else {
            
            return redirect()->back()->withErrors(['email' => 'Email or password is incorrect']);
        }
    }
}    
