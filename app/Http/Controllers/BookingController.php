<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pets;
use App\Models\pet_type;
use App\Models\Rooms;
use App\Models\pet_type_room_type;
use App\Models\bookings;
use App\Models\PaymentMethod;
use Illuminate\Support\Facades\Auth;
use App\Models\PetStatus; 

class BookingController extends Controller
{
    function send(Request $request)
{
    $room_id = $request->room_id;
    $petTypeId = $request->pet_type_id;
    $checkIn = $request->check_in;
    $checkOut = $request->check_out;
    $roomTypeId = $request->room_type;
    $roomTypeName = $request->room_type_name;
    return view('main.petinfo', compact('room_id','roomTypeName','petTypeId', 'checkIn', 'checkOut', 'roomTypeId'));
}
    function petInfo(Request $request){
        $p=rooms::all();
        $room_id = $request->room_id;
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
        
        return view(('main.overview'),compact('room_id','roomTypename','roomTypeId','checkIn','checkOut','p_name','p_breed','p_age','p_weight','p_gender','p_description','petTypeId'));
}
    function book(Request $request){
    $payment = PaymentMethod::all();
    $room_id = $request->room_id;
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
        'room_id','roomTypeId', 'petTypeId','roomTypeName', 'checkIn', 'checkOut', 
        'pet_name', 'pet_breed', 'pet_age', 'pet_weight', 'pet_gender',
        'additional_info','price','payment'));
    }

    function booked(Request $request){
        $room_id = $request->room_id;
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
        $pet = new Pets();
        $pet->User_id = Auth::user()->id;
        $pet->Pet_name = $pet_name;
        $pet->Pet_type_id = $petTypeId;
        $pet->Pet_age = $pet_age;
        $pet->Pet_breed = $pet_breed;
        $pet->Pet_weight = $pet_weight;
        $pet->Pet_Gender = $pet_gender;
        $pet->additional_info = $additional_info;
        $pet->save();

        $room = Rooms::findOrFail($room_id);
        $room->Rooms_status = 0;
        $room->save();

        $book= new bookings();
        $book->User_id = Auth::user()->id;
        $book->Pet_id = Pets::latest('Pet_id')->first()->Pet_id;
        $book->Rooms_id = $room_id;
        $book->Start_date=$checkIn;
        $book->End_date=$checkOut;
        $book->Booking_date=Now();
        $book->Booking_status=0;
        $book->price=$price;
        $book->PaymentMethodID=$PaymentMethodID;
        $book->PaymentDate=NULL;
        $book->save();

        $petstatus = new PetStatus();
        $petstatus->BookingOrderID = bookings::latest('BookingOrderID')->first()->BookingOrderID;
        $petstatus->Report = NULL;
        $petstatus->status = 0;
        $petstatus->Admin_id = NULL;
        $petstatus->save();

        // dd($pet);
        return redirect()->route('home');
    }




    public function index()
    {
        // ดึงรายการจองทั้งหมดสำหรับผู้ใช้ปัจจุบัน
        $usID = Auth::user()->id;
        $bookings = bookings::withTrashed()->where('User_id', $usID)
        ->orderBy('BookingOrderID', 'desc')
        ->get();
        return view('User.DetailBookings', compact('bookings'));
    }

    // ฟังก์ชันแสดงรายละเอียดของการจองเฉพาะรายการ
    public function show($id)
    {
        // ดึงข้อมูลการจองที่เลือก
        $usID = Auth::user()->id;
        $booking = bookings::withTrashed()->where('BookingOrderID', $id)
                        ->where('User_id', $usID)
                        ->firstOrFail();
        return view('User.showDetail', compact('booking'));
    }

    // ฟังก์ชันแสดงสถานะสัตว์เลี้ยง
    public function petStatus($id)
    {
        // ดึงข้อมูลสัตว์เลี้ยงที่เกี่ยวข้องกับการจอง
        $usID = Auth::user()->id;
        $pet = Pets::where('BookingOrderID', $id)
                ->where('User_id', $usID)
                ->firstOrFail();
                
        return view('User.Petstatus', compact('pet'));
    }

    //show picture
    public function showRoomsPets()
    {
        $Pets_rooms = pet_type_room_type::with(['roomType', 'image'])->get();
        
        return view('bookings', compact('Pets_rooms'));
    }
}