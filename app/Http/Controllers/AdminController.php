<?php

namespace App\Http\Controllers;

use App\Models\Rooms;
use App\Models\Rooms_type;
use App\Models\Images;
use App\Models\Bookings;
use App\Models\Pet_type;
use App\Models\pet_type_room_type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use Carbon\Carbon;


class AdminController extends Controller
{
    
        //หน้าหลักของแอดมิน
        public function index(){
            $Rooms = Rooms::all();
            $AvailableRooms = Rooms::where('Rooms_status', "=", "1")->get();
            $Bookings = Bookings::all();
            $Petbooking = Rooms::where('Rooms_status', "=", "0")->get();
            $TodayBookings = Bookings::whereDate('created_at', Carbon::today())->get();
            return view("Admin.AdminHome",compact("Rooms","AvailableRooms","Bookings","TodayBookings","Petbooking"));
        }


        //หน้าแสดงห้องทั้งหมด
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
        
        //หน้าแก้ไขห้อง
        public function editrooms($id) {
            try {
                $RoomID = Rooms::find($id);
                $Rooms = Rooms::all();
                return view("Admin.AdminRoomEdit", compact("RoomID",'Rooms'));
            } catch (\Exception $e) {
                return view('error')->with('message', $e->getMessage());
            }
        }

        //ฟังก์ชันเช็ครูปภาพ
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
        
        


        //ส่งค่าที่จะแก้ไขห้องไป DB
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

        //ลบห้อง
        public function delete($id){
            Rooms::destroy($id);
            return redirect()->back();
        }

        //หน้าสร้างห้อง
        public function create(){
            $Pet_types = Pet_type::all();
            $Room_types = Rooms_type::all();
            $latestRoom = Rooms::latest('Rooms_id')->first();
            return view('Admin.AdminCreateRooms',compact('Pet_types','Room_types','latestRoom'));
        }

        //ส่งค่าจากหน้าสร้างห้องไป DB
        public function store(Request $request){
            $roomType = $request->room_type;
            $petType = $request->pet_type;

            $newImg = new Images(); //สร้าง obj รูปภาพ
            if ($request->hasFile('room_image')) { //เช็คว่ามีไฟล์ส่งมาไหม
                $file = $request->file('room_image'); //ถ้ามีให้เก็บไว้ที่ตัวแปร file
                $_basename = $this->checkFile($file); //เช็คว่าไฟล์เป็นนามสกุลรูปภาพไหม ถ้าเป็นจะส่งชื่อภาพพร้อมนาสกุลไฟล์
                if (!is_string($_basename)) { //สำหรับค่าที่ส่งมาไม่ใช่ชื่อไฟล์ แต่เป็น redirect พร้อม error เพราะไม่ใช่นามสกุลรูปภาพ
                    return $_basename;
                }
                $newImg->ImagesPath = $_basename;
                $newImg->ImagesName = 'รูป'.$petType.$roomType;
                $newImg->save();
            }

            $idroomType = Rooms_type::where('Rooms_type_name','=',$roomType)->first();
            $idpetType = Pet_type::where('Pet_nametype','=',$petType)->first();
            $idImg = Images::latest('ImagesID')->first()->ImagesID;
            $newPetRoomtype = new pet_type_room_type();
            $newPetRoomtype->Rooms_type_id = $idroomType->Rooms_type_id; // ดึงค่า id
            $newPetRoomtype->Pet_type_id = $idpetType->Pet_type_id; // ดึงค่า id
            $newPetRoomtype->Rooms_type_description = $request->room_description;
            $newPetRoomtype->Room_price = $request->room_price;
            
            $newPetRoomtype->ImagesID = $idImg; // ดึงค่า id
            $newPetRoomtype->save();

            $newRoom = new Rooms();    
            $newRoom->Pet_Room_typeID = pet_type_room_type::latest('Pet_Room_typeID')->first()->Pet_Room_typeID;
            $newRoom->Rooms_status = $request->room_status;
            $newRoom->save();

            return redirect()->to(route('Admin.rooms'))->with('success','เพิ่มห้องหมายเลข'.$request->room_number);
        }
        

        public function petstatus(){
            try {
                $Rooms = Rooms::with(['bookings.user', 'bookings.pet'])->get();
                $AvailableRooms = Rooms::where('Rooms_status', "=", "1")->get();
                $UnAvailableRooms = Rooms::where('Rooms_status', "=", "0")->get();
                return view("Admin.AdminPets", compact("Rooms","AvailableRooms","UnAvailableRooms"));
            } catch (\Exception $e) {
                return view('error')->with('message', $e->getMessage());
            }
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