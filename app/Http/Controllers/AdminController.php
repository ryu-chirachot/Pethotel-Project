<?php

namespace App\Http\Controllers;

use App\Models\Bookings;
use App\Models\Pet_type;
use Illuminate\Http\Request;
use App\Models\Rooms;
use App\Models\Rooms_type;
use Hamcrest\Type\IsString;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    //
    public function index(){
        $Rooms = Rooms::all();
        $AvailableRooms = Rooms::where('Rooms_status', "=", "1")->get();
        return view("Admin.AdminHome",compact("Rooms","AvailableRooms"));
    }

    public function rooms(){
        try {
            
            $Rooms = Rooms::with(['bookings.user', 'bookings.pet'])->get();
            $AvailableRooms = Rooms::where('Rooms_status', "=", "1")->get();
            $UnAvailableRooms = Rooms::where('Rooms_status', "=", "0")->get();
            return view("Admin.AdminRoomsManage", compact("Rooms","AvailableRooms","UnAvailableRooms"));
        } catch (\Exception $e) {
            return view('error')->with('message', $e->getMessage());
        }
    }
    
    public function editrooms($id) {
        try {
            $RoomID = Rooms::find($id);
            $Rooms = Rooms::all();
            return view("Admin.AdminRoomEdit", compact("RoomID",'Rooms'));
        } catch (\Exception $e) {
            return view('error')->with('message', $e->getMessage());
        }
}
    public function checkFile($img){
                $imageFileType = strtolower($img->getClientOriginalExtension());
                
                if (!in_array($imageFileType, ['jpg', 'jpeg', 'png'])) {
                    return redirect()->back()->with('error', 'รองรับเฉพาะไฟล์นามสกุล jpg, jpeg และ png เท่านั้น!');
                } else {
                    $path = $img->getClientOriginalName();
                    $_basename = basename($path);
                    return $_basename;
                }
        }

    public function updateRoom(Request $request){

        try {
            if (empty($request->room_number)) {
                return redirect()->back()->with('error', 'ไม่พบข้อมูลห้องที่ต้องการแก้ไข');
            }

            $room = Rooms::findOrFail($request->room_number);
            
            // อัปเดตสถานะห้อง
            $room->Rooms_status = $request->room_status;
            $room->save();

            if ($room->petTypeRoomType) {
                $petTypeRoomType = $room->petTypeRoomType;

                if ($petTypeRoomType->Pet_type) {
                    $petTypeRoomType->Pet_type->Pet_nameType = $request->pet_type;
                    $petTypeRoomType->Pet_type->save();
                }

                if ($petTypeRoomType->roomType) {
                    $petTypeRoomType->roomType->Rooms_type_name = $request->room_type;
                    $petTypeRoomType->roomType->save();
                }
                
                $petTypeRoomType->Room_price = $request->room_price;
                $petTypeRoomType->Rooms_type_description = $request->room_description;
                $petTypeRoomType->save();
                
                if ($request->hasFile('imgchange')) {
                    $file = $request->file('imgchange');
                    $_basename = $this->checkFile($file);
                    if (!is_string($_basename)) {
                        return $_basename;
                    }
                    $petTypeRoomType->image->ImagesPath = $_basename;
                    $petTypeRoomType->image->save();
                }
            } else {
                    return redirect()->back()->with('error', 'ไม่พบข้อมูลประเภทห้องและสัตว์เลี้ยงที่เกี่ยวข้อง');
                }
                return redirect()->to(route('Admin.rooms'))->with('success', 'เปลี่ยนแปลงข้อมูลห้อง ' . $request->room_number . ' เรียบร้อย!');
        
        } catch (ModelNotFoundException $e) {
            return redirect()->back()->with('error', 'ไม่พบข้อมูลห้องที่ต้องการแก้ไข');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'เกิดข้อผิดพลาดอะไรบางอย่าง : ' . $e->getMessage());
            }
        }

        public function delete($id){
            Rooms::destroy($id);
            return redirect()->back();
        }

        public function create(){
            $Pet_types = Pet_type::all();
            $Room_types = Rooms_type::all();
            return view('Admin.AdminCreateRooms',compact('Pet_types','Room_types'));
        }

        public function store(Request $request){
            
        }
        
}
// public function searchRoom(Request $request)
    // {
    // $query = $request->get('query');
    // // ค้นหาห้องที่มีหมายเลขตาม input
    // $rooms = Rooms::where('number', 'LIKE', "%{$query}%")->get();
    // // ส่งผลลัพธ์กลับไปยัง view
    // return redirect()->back()->with("query", $query);
    // }