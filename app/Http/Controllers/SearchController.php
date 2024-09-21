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


    
    public function search(Request $request){
    $p_type = pet_type::all();
    $petTypeId = $request->input('pet_type_id');
    $c_in=$request->input('check_in');
    $c_out=$request->input('check_out');
    
    $rooms = Rooms::with([
        'pet_Type_Room_Type.petType',  // ดึงข้อมูล petType
        'pet_Type_Room_Type.roomType',
        'pet_Type_Room_Type.rooms.bookings'
    ])
    ->where('Rooms_status', 1)
    ->whereHas('pet_Type_Room_Type', function ($query) use ($petTypeId) {
        $query->where('Pet_type_id', $petTypeId);
    })
    

    ->get();
    $groupedRooms = $rooms->groupBy('pet_Type_Room_Type.roomType.Rooms_type_name');
    
$count = $groupedRooms->count();


// นับห้อง
return view('main.result', compact('rooms','count','p_type','groupedRooms'));
}
}
// // $rooms = Rooms::with([
//     'pet_Type_Room_Type.petType',  // ดึงข้อมูล petType
//     'pet_Type_Room_Type.roomType',
//     'pet_Type_Room_Type.rooms.bookings'
// ])
// ->where('Rooms_status', 1)
// ->whereHas('pet_Type_Room_Type', function ($query) use ($petTypeId) {
//     $query->where('Pet_type_id', $petTypeId);
// })
// ->whereHas('bookings', function ($query) use ($c_in, $c_out) {
//     $query->whereNotBetween('Start_date', [$c_in, $c_out])
//           ->whereNotBetween('End_date', [$c_in, $c_out]);
// })
// ->get();