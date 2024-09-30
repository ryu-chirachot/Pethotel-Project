<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    function edit()
    {
        return view(view: "Edituser");
        
    }

    function EditUpdate(Request $request){
        $user = auth()->user();
        if (!Hash::check($request->password, $user->password)) {
            return redirect("/edit")->withErrors(["msg" => "Invalid password."]);
        }
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route("mains",["viewname"=>"homepage"])->with('success','แก้ไขสำเร็จ');
    }

}