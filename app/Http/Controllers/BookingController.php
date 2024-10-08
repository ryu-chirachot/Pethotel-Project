<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pets;
use App\Models\pet_type;
use App\Models\Rooms;
use App\Models\bookings;
use App\Models\PaymentMethod;
use Illuminate\Support\Facades\Auth;
use App\Models\PetStatus; 
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    function send(Request $request)
    {
        $room_id = $request->room_id;
        $petTypeId = $request->pet_type_id;
        $checkIn = $request->check_in;
        $checkOut = $request->check_out;
        $roomTypeId = $request->room_type_id;
        $roomTypeName = $request->room_type_name;
        $p = Pets::where('user_id', auth()->id())->get();
        
        $pets=$p->where('Pet_type_id',$petTypeId);
        
        
        return view('main.petinfo', compact('pets','room_id','roomTypeName','petTypeId', 'checkIn', 'checkOut', 'roomTypeId',));
    }
    function petInfo(Request $request){
        $p=rooms::all();
        $pet_id = $request->pet_id;
        $room_id = $request->room_id;
        $p_name=$request->name;
        $petTypeId = $request->petTypeId;
        $petTypeName = pet_type::where('Pet_type_id',$petTypeId)->select('Pet_nametype')->first();
        $checkIn = $request->checkIn;
        $checkOut = $request->checkOut;
        $roomTypeId = $request->roomTypeId;
        $roomTypename=$request->roomTypename;
        $p_breed=$request->breed;
        $p_age=$request->age;
        $p_weight=$request->weight;
        $p_gender=$request->gender;
        $p_description=$request->comment;
        
        
        return view(('main.overview'),compact('room_id','roomTypename','roomTypeId','checkIn','checkOut','p_name','p_breed','p_age','p_weight','p_gender','p_description','petTypeId','petTypeName','pet_id'));
}
    function book(Request $request){
    $pettype ='';
    
    $payment = PaymentMethod::all();
    $room_id = $request->room_id;
    $roomTypeId = $request->room_type;
    $roomTypeName = $request->roomTypename;
    $petTypeId = $request->petTypeId;
    $checkIn = $request->checkin;
    $checkOut = $request->checkout;
    $pet_id = 0;
    $pet_name = $request->pet_name;
    $pet_breed = $request->pet_breed;
    $pet_age = $request->pet_age;
    $pet_weight = $request->pet_weight;
    $pet_gender = $request->pet_gender;
    $additional_info = $request->additional_info;
    $price = Rooms::where('Rooms_id',$room_id)->value('Room_price');
    
    if($request->pet_id){
        $pet_id += $request->pet_id;
    }else{
        //เพิ่มข้อมูลสัตว์
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
        $pet_id += Pets::orderBy('Pet_id', 'desc')->first()->Pet_id;
    }
    


    // ส่งค่าทไป view
    return view('payment', compact(
        'room_id','roomTypeId', 'petTypeId','roomTypeName', 'checkIn', 'checkOut', 
        'pet_name', 'pet_breed', 'pet_age', 'pet_weight', 'pet_gender',
        'additional_info','price','payment','pet_id'));
    }

    public function booked(Request $request) {
        
        DB::transaction(function () use ($request) {
            $room_id = $request->room_id;
            
            $checkIn = $request->checkIn;
            $checkOut = $request->checkOut;
            
            $price = $request->price;
            $PaymentMethodID = $request->payment;
            
            $pet_id = $request->pet_id;
            // ทำให้ห้องเป็นไม่ว่าง
            $room = Rooms::findOrFail($room_id);
            $room->Rooms_status = 0;
            $room->save();
    
            // เพิ่มข้อมูลการจอง
            $book = new bookings();
            $book->User_id = Auth::user()->id;
            $book->Pet_id = $pet_id;
            $book->Rooms_id = $room_id;
            $book->Start_date = $checkIn;
            $book->End_date = $checkOut;
            $book->Original_end_date = $checkOut;
            $book->Booking_status = 0;
            $book->price = $price;
            $book->PaymentMethodID = $PaymentMethodID;
            $book->save();
        });
    
        return redirect()->route('home')->with('success', "ห้องหมายเลข ".$request->room_id."\nสามารถดูรายละเอียดได้ที่ประวัติการจอง");
    }




    public function index()
    {
        // ดึงรายการจองทั้งหมดสำหรับผู้ใช้ปัจจุบัน
        $bookings = bookings::withTrashed()
        ->with(['pet', 'room.roomType']) // ใช้ Eager Loading
        ->where('User_id', Auth::user()->id)
        ->orderBy('BookingOrderID', 'desc')
        ->get();

        return view('User.DetailBookings', compact('bookings'));
    }


    // ฟังก์ชันแสดงรายละเอียดของการจองเฉพาะรายการนั้น
    public function show($id)
    {
        // ดึงข้อมูลการจองที่เลือก
        $usID = Auth::user()->id;
        $booking = bookings::withTrashed()->where('BookingOrderID', $id)
                        ->where('User_id', $usID)
                        ->with('pet')
                        ->firstOrFail();
        
        return view('User.showDetail', compact('booking'));
    }

    // ฟังก์ชันแสดงสถานะสัตว์เลี้ยง
    public function petStatus($id)
    {
        // ดึงข้อมูลสัตว์เลี้ยงที่เกี่ยวข้องกับการจอง
        $usID = Auth::user()->id;
        $booking = bookings::withTrashed()->find($id);
        $status = PetStatus::withTrashed()->where('BookingOrderID', $id)->get();

        
        return view('User.Petstatus', compact('booking', 'status'));
    }


    //รูป
    public function showRoomsPets()
    {
        $Pets_rooms = Rooms::with(['roomType', 'image'])->get();
        
        return view('bookings', compact('Pets_rooms'));
    }

    public function mypets(){
    
        $pets = Pets::where('user_id', auth()->id())->get();
        

        return view('main.mypet',compact('pets'));
    }
    // แก้ไข
    public function petUpdate(Request $request)
    {
        
        // ค้นหาสัตว์เลี้ยงตาม id
        $pet = Pets::where('Pet_id',$request->petid)->first();
        
        // อัปเดตข้อมูลสัตว์เลี้ยง
        $pet->Pet_name = $request->input('pet_name');
        $pet->Pet_breed = $request->input('pet_breed');
        $pet->Pet_gender = $request->input('pet_gender');
        $pet->Pet_age = $request->input('pet_age');
        $pet->Pet_weight = $request->input('pet_weight');
        $pet->additional_info = $request->input('comment');
        $pet->save();
    
        // ส่งกลับไปยังหน้าเดิมพร้อมข้อความยืนยัน
        return redirect()->back()->with('success', 'ข้อมูลสัตว์เลี้ยงถูกอัปเดตแล้ว');
    }

    public function deletePet($id){
        //ลบการจองที่เกี่ยวข้อง
        Bookings::where('Pet_id', $id)->delete();
        //ลบสัตว์เลี้ยง
        Pets::destroy($id);
        
        return redirect()->back()->with('success','ลบสัตว์เลี้ยงเรียบร้อย');
    }
}