<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pets;
use App\Models\pet_type;
use App\Models\Rooms;

class BookingController extends Controller
{
    function petInfo(Request $request){
        $p=rooms::all();
        $p_name=$request->input('name');
        // $p_type=$request->input('type');
        $p_breed=$request->input('breed');
        $p_age=$request->input('age');
        $p_weight=$request->input('weight');
        $p_gender=$request->gender;
        $p_description=$request->comment;
        // dd($request->all());
        return view(('main.overview'),compact('p_name','p_breed','p_age','p_weight','p_gender','p_description'));
}
    function book(Request $request){
        $roomType = $request->input('room_type');
        $checkin = $request->input('checkin');
        $checkout = $request->input('checkout');
        $petName = $request->input('pet_name');
        $petBreed = $request->input('pet_breed');
        $petAge = $request->input('pet_age');
        $petWeight = $request->input('pet_weight');
        $petGender = $request->input('pet_gender');
        $vaccineHistory = $request->input('vaccine_history');
        $additionalInfo = $request->input('additional_info'); 
        dd($request);
    }
}