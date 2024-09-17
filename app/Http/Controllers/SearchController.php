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
        $rooms = Rooms::with('pet_Type_Room_Type.petType')
        ->where('Rooms_status', 1)
        ->whereHas('pet_Type_Room_Type', function($query) use ($petTypeId) {
            $query->where('Pet_type_id', $petTypeId);
        })
        ->get();
        $count = Rooms::with('pet_Type_Room_Type.petType')
        ->where('Rooms_status', 1)
        ->whereHas('pet_Type_Room_Type', function($query) use ($petTypeId) {
            $query->where('Pet_type_id', $petTypeId);
        })
        ->count();

    return view('main.result', compact('rooms','count','p_type'));
}
//         @foreach ($page->related_posts()->where('title', 'like', '%awesome%')->get() as $post)
//   {{ $post->title }}
// @endforeach
    // }
    // {
        
    //         $petTypeId = $request->input('petSelect');
    //         $checkInDate = $request->input('check_in');
    //         $checkOutDate = $request->input('check_out');
    //         // วันที่ที่กรอกเข้ามาไปเทียบกับวันที่ที่อยู่ในdatabase แล้วให้เอาเฉพาะRooms_statusที่ว่างตรงกับวันที่นั้น
    //         $p_type = pet_type::all();
    //         $room=rooms::where("Rooms_status",1)->get();
       
    //         // สร้าง query สำหรับค้นหาห้องพัก
    //         $query = Rooms::where('Rooms_status', 1);

    //         // กรองห้องพักตามประเภทสัตว์เลี้ยง
    //         if ($petTypeId) {
    //             // สมมุติว่ามีความสัมพันธ์ในโมเดล Rooms เพื่อเชื่อมกับ PetType
    //             $query->whereHas('petTypes', function($q) use ($petTypeId) {
    //                 $q->where('pet_type_id', $petTypeId);
    //             });
    //         }

    //         // กรองห้องพักตามวันที่เช็คอินและเช็คเอาท์
    //         if ($checkInDate && $checkOutDate) {
    //             // แปลงวันที่เป็น Carbon instance
    //             $checkInDate = Carbon::parse($checkInDate)->startOfDay();
    //             $checkOutDate = Carbon::parse($checkOutDate)->endOfDay();

               
    //         $query->where(function($q) use ($checkInDate, $checkOutDate) {
    //             $q->where('createdAt', '<=', $checkInDate)
    //               ->where('updateAt', '>=', $checkOutDate);
    //               return view('welcome');
    //         });
    //     }

    //     // ดึงข้อมูลห้องพัก
    //     $rooms = $query->get();

    //     // ส่งข้อมูลไปยัง view
    //     return view('result', compact('rooms', 'p_type'));
    // }

}