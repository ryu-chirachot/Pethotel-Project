<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pets;
use App\Models\pet_type;
use App\Models\Rooms;
use App\Models\pet_type_room_type;
use App\Models\bookings;

class BookingController extends Controller
{
    function send(Request $request)
{
    $petTypeId = $request->pet_type_id;
    $checkIn = $request->check_in;
    $checkOut = $request->check_out;
    $roomTypeId = $request->room_type;
    $roomTypeName = $request->room_type_name;
    return view('main.petinfo', compact('roomTypeName','petTypeId', 'checkIn', 'checkOut', 'roomTypeId'));
}
    function petInfo(Request $request){
        $p=rooms::all();
        $p_name=$request->name;
        $petTypeId = $request->petTypeId;
        $checkIn = $request->checkIn;
        $checkOut = $request->checkOut;
        $roomTypeId = $request->roomTypeId;
        $roomTypename=$request->roomTypename;
        $p_breed=$request->breed;
        $p_age=$request->age;
        $p_weight=$request->weight;
        $p_gender=$request->gender;
        $p_description=$request->comment;
        
        return view(('main.overview'),compact('roomTypename','roomTypeId','checkIn','checkOut','p_name','p_breed','p_age','p_weight','p_gender','p_description','petTypeId'));
}
    function book(Request $request){
    $roomTypeId = $request->room_type;
    $roomTypeName = $request->roomTypename;
    $petTypeId = $request->petTypeId;
    $checkIn = $request->checkin;
    $checkOut = $request->checkout;
    $pet_name = $request->pet_name;
    $pet_breed = $request->pet_breed;
    $pet_age = $request->pet_age;
    $pet_weight = $request->pet_weight;
    $pet_gender = $request->pet_gender;
    $additional_info = $request->additional_info;
    $price = pet_type_room_type::where('Rooms_type_id', $roomTypeId)
    ->where('Pet_type_id', $petTypeId)
    ->value('Room_price');

    // ส่งค่าทั้งหมดไป view 'payment'
    return view('payment', compact(
        'roomTypeId', 'roomTypeName', 'checkIn', 'checkOut', 
        'pet_name', 'pet_breed', 'pet_age', 'pet_weight', 'pet_gender',
        'additional_info','price'));
    }

    function booked(Request $request){
        $roomTypeId = $request->room_type;
    $roomTypeName = $request->roomTypename;
    $petTypeId = $request->petTypeId;
    $checkIn = $request->checkIn;
    $checkOut = $request->checkOut;
    $pet_name = $request->pet_name;
    $pet_breed = $request->pet_breed;
    $pet_age = $request->pet_age;
    $pet_weight = $request->pet_weight;
    $pet_gender = $request->pet_gender;
    $price=$request->price;
    $PaymentMethodID=$request->payment;
    $additional_info = $request->additional_info;
    // insert
    // $book=new bookings;
    // $book->User_id=3;
    // $book->Pet_id=5;
    // $book->Rooms_id=5;
    // $book->Start_date=$checkIn;
    // $book->End_date=$checkOut;
    // $book->Booking_date=Now();
    // $book->Booking_status=0;
    // $book->price=$price;
    // $book->PaymentMethodID=$PaymentMethodID;
    // $book->PaymentDate=$checkIn;
    //     $book->save();
        return redirect()->route('home');
    }
}