<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class EditUserController extends Controller
{
    function edit()
    {
        return view(view: "Edituser");
        
    }};

