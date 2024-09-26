<?php


namespace App\Http\Controllers;
use App\Models\Pet_type;
use Illuminate\Http\Request;
use App\Models\Rooms;
use App\Models\Pet_Type_Room_Type;
use App\Models\Bookings;
use App\Models\Rooms_type;


class SearchController extends Controller
{
    public function showpet($viewname)
    {
        $p_type = pet_type::all();
        return view(('main/').$viewname,compact('p_type'));
    }



    public function search(Request $request)
{
    // ดึงข้อมูลประเภทสัตว์เลี้ยงทั้งหมด
    $p_type = Pet_type::all();
   

    // รับข้อมูลจากฟอร์ม
    $petTypeId = $request->input('pet_type_id');
    $checkIn = $request->input('check_in');
    $checkOut = $request->input('check_out');
    
    $img = Pet_Type_Room_Type::with(['roomType', 'image'])->where('pet_type_id', $petTypeId)->get();

    // เก็บค่าใน session
    session()->put('pet_type_id', $petTypeId);
    session()->put('check_in', $checkIn);
    session()->put('check_out', $checkOut);

    // ดึงข้อมูลห้องที่ว่างตามเงื่อนไขโดยกรองตามประเภทสัตว์เลี้ยงและวันที่จอง
    $rooms = Rooms::whereDoesntHave('bookings', function ($query) use ($checkIn, $checkOut) {
            $query->where('Start_date', '<=', $checkOut)
                ->where('End_date', '>=', $checkIn);
        })
        ->whereHas('pet_Type_Room_Type', function ($query) use ($petTypeId) {
            $query->where('pet_type_id', $petTypeId);
        })
        ->with(['pet_Type_Room_Type.roomType'])
        ->get();

    // จัดกลุ่มห้องตาม Rooms_type_id
    $groupedRooms = $rooms->groupBy('pet_Type_Room_Type.roomType.Rooms_type_id');

    // นับจำนวนห้องในแต่ละประเภท
    $roomCounts = $groupedRooms->map(function ($group) {
        return $group->count();
    });

    // ส่งข้อมูลไปยัง view
    return view('main.result', compact('img','rooms', 'p_type', 'groupedRooms', 'roomCounts'));
}

    public function refresh()
{
    // ลบค่าทั้งหมดใน Session
    session()->flush();

    // แสดงหน้า Homepage
    return redirect()->back();
}

}

