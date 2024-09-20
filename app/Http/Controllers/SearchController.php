<?php


namespace App\Http\Controllers;
use App\Models\Pet_type;
use Illuminate\Http\Request;
use App\Models\Rooms;
use App\Models\Pet_Type_Room_Type;


class SearchController extends Controller
{       
    public function showpet($viewname)
    {
        $p_type = pet_type::all();
        return view(('main/').$viewname,compact('p_type'));
    }


    
    public function search(Request $request)
{
    $p_type = pet_type::all();
    $petTypeId = $request->input('pet_type_id');
    $c_in=$request->input('check_in');
    $c_out=$request->input('check_out');
    $rooms = Rooms::with('pet_Type_Room_Type.petType')
    ->where('Rooms_status', 1)
    ->whereHas('pet_Type_Room_Type', function($query) use ($petTypeId) {
        $query->where('Pet_type_id', $petTypeId);
    })
    //เช็คประเภทสัตว์เลี้ยง
    ->whereDoesntHave('bookings', function($query) use ($c_in, $c_out) {
        $query->where(function($q) use ($c_in, $c_out) {
            $q->whereBetween('Start_date', [$c_in, $c_out])
              ->orWhereBetween('End_date', [$c_in, $c_out])
              ->orWhere(function($q) use ($c_in, $c_out) {
                  $q->where('Start_date', '<=', $c_in)
                    ->where('End_date', '>=', $c_out);
                    // เช็ควัน
              });
        });
    })
    ->get();

$count = $rooms->count();
// นับห้อง

return view('main.result', compact('rooms', 'count', 'p_type'));
}
}