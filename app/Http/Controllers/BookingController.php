<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pets;
use App\Models\pet_type;
use App\Models\Rooms;

class BookingController extends Controller
{
    function send(Request $request)
{
    $petTypeId = $request->input('pet_type_id');
    $checkIn = $request->input('check_in');
    $checkOut = $request->input('check_out');
    $roomTypeId = $request->input('room_type');
    $roomTypeName = $request->input('room_type_name');
    return view('main.petinfo', compact('roomTypeName','petTypeId', 'checkIn', 'checkOut', 'roomTypeId'));
}
    function petInfo(Request $request){
        $p=rooms::all();
        $p_name=$request->input('name');
        $petTypeId = $request->input('petTypeId');
        $checkIn = $request->input('checkIn');
        $checkOut = $request->input('checkOut');
        $roomTypeId = $request->input('roomTypeId');
        $roomTypename=$request->input('roomTypename');
        $p_breed=$request->input('breed');
        $p_age=$request->input('age');
        $p_weight=$request->input('weight');
        $p_gender=$request->gender;
        $p_description=$request->comment;
        
        return view(('main.overview'),compact('roomTypename','roomTypeId','checkIn','checkOut','p_name','p_breed','p_age','p_weight','p_gender','p_description','petTypeId'));
}
    function book(Request $request){
        $roomTypeId = $request->input('room_type');
    $roomTypeName = $request->input('roomTypename');
    $checkIn = $request->input('checkin');
    $checkOut = $request->input('checkout');
    $petName = $request->input('pet_name');
    $petBreed = $request->input('pet_breed');
    $petAge = $request->input('pet_age');
    $petWeight = $request->input('pet_weight');
    $petGender = $request->input('pet_gender');
    $vaccineHistory = $request->input('vaccine_history');
    $additionalInfo = $request->input('additional_info');

    // ส่งค่าทั้งหมดไปยัง view 'payment'
    return view('payment', compact(
        'roomTypeId', 'roomTypeName', 'checkIn', 'checkOut', 
        'petName', 'petBreed', 'petAge', 'petWeight', 'petGender',
        'vaccineHistory', 'additionalInfo'));
    }
}