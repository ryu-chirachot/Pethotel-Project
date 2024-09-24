<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Rooms;
use App\Models\Rooms_type;
use App\Models\Images;
use App\Models\Bookings;
use App\Models\Pet_type;
use App\Models\pet_type_room_type;
use App\Models\PetStatus;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Carbon\Carbon;
<<<<<<< HEAD
use Illuminate\Support\Facades\Auth;
=======
>>>>>>> boss



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

        public function updateExpiredBookings()
        {
                $today = Carbon::today();
                
                $expiredBookings = Bookings::where('End_date', '<', $today)
                                        ->where('Booking_status', '!=', 2)
                                        ->get();
                
                foreach ($expiredBookings as $booking) {
                    $booking->update(['Booking_status' => 2]);
                }
                
                return "อัปเดตการจองที่หมดอายุแล้ว " . $expiredBookings->count() . " รายการ";
        }

        //หน้าแสดงห้องทั้งหมด
        public function rooms(){
            try {
                $allRooms = Rooms::all();
                $Rooms = Rooms::with(['bookings.user', 'bookings.pet'])
                                    ->whereHas('bookings', function ($query) {
                                        $query->where('End_date', '>', Carbon::today());
                                    })->get();
                $AvailableRooms = Rooms::where('Rooms_status', "=", "1")->get();
                $UnAvailableRooms = Rooms::where('Rooms_status', "=", "0")->get();
                return view("Admin.AdminRoomsManage", compact("allRooms","Rooms","AvailableRooms","UnAvailableRooms"));
            } catch (\Exception $e) {
                return view('error')->with('message', $e->getMessage());
            }
        }

        public function Available(){
                $allRooms = Rooms::all();
                $Rooms = Rooms::with(['bookings.user', 'bookings.pet'])->where('Rooms_status', "=", "1")->get();
                $AvailableRooms = Rooms::where('Rooms_status', "=", "1")->get();
                $UnAvailableRooms = Rooms::where('Rooms_status', "=", "0")->get();
                return view('Admin.AvailableRoom', compact("allRooms","Rooms","AvailableRooms","UnAvailableRooms"));
        }
        
        public function Unavailable(){
                $allRooms = Rooms::all();
                $Rooms = Rooms::with(['bookings.user', 'bookings.pet'])->where('Rooms_status', "=", "0")->get();
                $AvailableRooms = Rooms::where('Rooms_status', "=", "1")->get();
                $UnAvailableRooms = Rooms::where('Rooms_status', "=", "0")->get();
                return view('Admin.UnavailableRoom', compact("allRooms","Rooms","AvailableRooms","UnAvailableRooms"));
        }
        //หน้าแก้ไขห้อง
        public function editrooms($id) {
            try {
                $RoomID = Rooms::find($id);
                $petType = Pet_type::select('Pet_nametype')->distinct()->get();
                $roomType = Rooms_type::select('Rooms_type_name')->distinct()->get();
                return view("Admin.AdminRoomEdit", compact("RoomID",'petType','roomType'));
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

                if ($room->pet_Type_Room_Type) {
                    $pet_Type_Room_Type = $room->pet_Type_Room_Type;

                    if ($pet_Type_Room_Type->Pet_type) {
                        $pet_Type_Room_Type->Pet_type->Pet_nameType = $request->pet_type;
                        $pet_Type_Room_Type->Pet_type->save();
                    }

                    if ($pet_Type_Room_Type->roomType) {
                        $pet_Type_Room_Type->roomType->Rooms_type_name = $request->room_type;
                        $pet_Type_Room_Type->roomType->save();
                    }
                    
                    $pet_Type_Room_Type->Room_price = $request->room_price;
                    $pet_Type_Room_Type->Rooms_type_description = $request->room_description;
                    $pet_Type_Room_Type->save();
                    
                    if ($request->hasFile('imgchange')) {
                        $file = $request->file('imgchange');
                        $_basename = $this->checkFile($file);
                        if (!is_string($_basename)) {
                            return $_basename;
                        }
                        $pet_Type_Room_Type->image->ImagesPath = $_basename;
                        $pet_Type_Room_Type->image->save();
                    }
                } else {
                        return redirect()->back()->with('error', 'ไม่พบข้อมูลประเภทห้องและสัตว์เลี้ยงที่เกี่ยวข้อง');
                    }
                    return redirect()->to(route('Admin.rooms'))->with('success', 'ห้องหมายเลข #' . $request->room_number . ' เรียบร้อย!');
            
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
        public function createRooms(){
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
            $newPetRoomtype = new Pet_Type_Room_Type();
            $newPetRoomtype->Rooms_type_id = $idroomType->Rooms_type_id; // ดึงค่า id
            $newPetRoomtype->Pet_type_id = $idpetType->Pet_type_id; // ดึงค่า id
            $newPetRoomtype->Rooms_type_description = $request->room_description;
            $newPetRoomtype->Room_price = $request->room_price;
            
            $newPetRoomtype->ImagesID = $idImg; // ดึงค่า id
            $newPetRoomtype->save();

            $newRoom = new Rooms();    
            $newRoom->Pet_Room_typeID = Pet_Type_Room_Type::latest('Pet_Room_typeID')->first()->Pet_Room_typeID;
            $newRoom->Rooms_status = $request->room_status;
            $newRoom->save();

            $roomID = Rooms::latest('Rooms_id')->first()->Rooms_id;

            return redirect()->to(route('Admin.rooms'))->with('complete','ห้องหมายเลข #'.$roomID. ' เรียบร้อย!');
        }
        
        //โชว์สถานะสัตว์เลี้ยง
        public function petstatus(){
            try {
<<<<<<< HEAD
                $BooksRooms = Bookings::with('pet_status')->get();
                $admin = Auth::user()->name;
                return view("Admin.AdminPets", compact("BooksRooms","admin"));
=======
                $Rooms = Rooms::with(['bookings.user', 'bookings.pet'])->get();
                return view("Admin.AdminPets", compact("Rooms"));
>>>>>>> boss
            } catch (\Exception $e) {
                return view('error')->with('message', $e->getMessage());
            }

        }

<<<<<<< HEAD
        public function petdetail($id){
            $booking = Bookings::findOrFail($id);
            $petstatus = PetStatus::where('BookingOrderID','=', $id)->get();
            return view('Admin.AdminReport', compact('booking','petstatus'));
        }

         // ส่งค่าไปรายงาน
        public function submitReport(Request $request)
        {
            // Store the report
            $idReport = PetStatus::findOrFail($request->status_id);
            $idReport->status = 1;
            $idReport->Report = $request->report;
            $idReport->Admin_id = Auth::user()->id;
            $idReport->save();

            return redirect()->route('Admin.pets')->with('success', "หมายเลขการจอง #".$request->input('booking_id')." เรียบร้อย!");
        }
            

        public function checkout(Request $request){
            $idCheckout = Bookings::findOrFail($request->booking_id);
            $idCheckout->Booking_status = 2;
            $idCheckout->save();

            return redirect()->route('Admin.pets')->with('checkout', "หมายเลขการจอง #".$request->input('booking_id')." เรียบร้อย!");
        }
        //จัดการ การจองห้อง

        //โชว์รายการจอง
        public function showBookings(){
            $countDates = [];
            $bookings = Bookings::with(['room']);
            foreach($bookings as $bk) {
                $checkinDate = Carbon::parse($bk->Start_date);
                $checkoutDate = Carbon::parse($bk->End_date);
                $countDates[$bk->BookingOrderID] = $checkinDate->diffInDays($checkoutDate);
            }
            dd($bookings);
            // return view('Admin.AdminBookings', compact('bookings','countDates'));

        }

        //โชว์รายละเอียดการจองแต่ละอัน
        public function detail($id){
            $bookings = Bookings::findOrFail($id);
        }
}
=======
         // Submit the report
    public function submitReport(Request $request)
    {
        $request->validate([
            'booking_id' => 'required|exists:bookings,id',
            'report' => 'required|string',
        ]);

        // Store the report
        PetStatus::create([
            'booking_id' => $request->input('booking_id'),
            'report' => $request->input('report'),
            'admin_id' => auth()->user()->id(),
        ]);

        return redirect()->route('admin.report', $request->input('booking_id'))
                        ->with('success', 'Report submitted successfully.');
    }
        
    }
>>>>>>> boss
