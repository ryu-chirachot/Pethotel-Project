<?php

namespace App\Http\Controllers;

use App\Events\AdminNoti;
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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;



class AdminController extends Controller
{

        //หน้าหลักของแอดมิน
        public function index(){
                $Rooms = Rooms::all();
                $AvailableRooms = Rooms::where('Rooms_status', "=", "1")->get();
                $Bookings = Bookings::withTrashed()->orderBy('BookingOrderID', 'desc')->get();
                $Users = User::where('role','user')->get();
                $TodayBookings = Bookings::whereDate('created_at', Carbon::today())->get();
                return view("Admin.AdminHome",compact("Rooms","AvailableRooms","Bookings","TodayBookings","Users"));
        }

        public function updateExpiredBookings()
        {
            try {
                $today = Carbon::today();
                
                $expiredBookings = Bookings::where('End_date', '<=', $today)
                                        ->where('Booking_status', '!=', 2)
                                        ->get();
                
                $expiredBookingIds = $expiredBookings->pluck('BookingOrderID');
                $updatedBookings = Bookings::whereIn('BookingOrderID', $expiredBookingIds)->update(['Booking_status' => 2]);
                

                $roomIds = $expiredBookings->pluck('Rooms_id');
                $updatedRooms = Rooms::whereIn('Rooms_id', $roomIds)->update(['Rooms_status' => 1]);
                
                
                Log::info("Updated {$updatedBookings} bookings and {$updatedRooms} rooms.");
                
                return [
                    'success' => true,
                    'message' => "{$updatedBookings} bookings and {$updatedRooms} rooms updated.",
                ];
            } catch (\Exception $e) {
                Log::error("Error updating expired bookings: " . $e->getMessage());
                return [
                    'success' => false,
                    'message' => "Error updating expired bookings: " . $e->getMessage(),
                ];
            }
        }

        //หน้าแสดงห้องทั้งหมด
        public function rooms(){
            
                $allRooms = Rooms::all();
                $Rooms = Rooms::with(['bookings.user'])
                                    ->whereHas('bookings')
                                    ->orWhereDoesntHave('bookings') // ดึงห้องที่ไม่มีการจอง
                                    ->paginate(5);
                $AvailableRooms = Rooms::where('Rooms_status', "=", "1")->get();
                $UnAvailableRooms = Rooms::where('Rooms_status', "=", "0")->get();
                return view("Admin.AdminRoomsManage", compact("allRooms","Rooms","AvailableRooms","UnAvailableRooms"));
            
        }

        public function Available(){
                $allRooms = Rooms::all();
                $Rooms = Rooms::with(['bookings.user'])->where('Rooms_status', "=", "1")->paginate(5);
                $AvailableRooms = Rooms::where('Rooms_status', "=", "1")->get();
                $UnAvailableRooms = Rooms::where('Rooms_status', "=", "0")->get();
                return view('Admin.AvailableRoom', compact("allRooms","Rooms","AvailableRooms","UnAvailableRooms"));
        }
        
        public function Unavailable(){
                $allRooms = Rooms::all();
                $Rooms = Rooms::with(['bookings.user'])->where('Rooms_status', "=", "0")->paginate(5);
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
                
                $imgpaths = $RoomID->pet_Type_Room_Type->image->ImagesPath;
                // ใช้ explode แยก path เป็น array
                $images = explode(',', $imgpaths);
                
                return view("Admin.AdminRoomEdit", compact("RoomID",'petType','roomType','images'));
            } catch (\Exception $e) {
                return view('error')->with('message', $e->getMessage());
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
                    
                    if($request->hasFile('room_image')) {
                        foreach($request->file('room_image') as $file) {
                            $fileName = time() . '_' . $file->getClientOriginalName();
                            $file->move(public_path('images'), $fileName);
                            $imageNames[] = $fileName;
                        }
                        $pet_Type_Room_Type->image->ImagesPath = implode(',', $imageNames);
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

        //หน้าสร้างห้องที่ต้องกรอกข้อมูล
        public function createRooms(Request $request){
            $Pet_types = Pet_type::all();
            $Room_types = Rooms_type::all();
            $latestRoom = Rooms::latest('Rooms_id')->first();
            $selectedPetType = $request->query('pet_type');
            $selectedRoomType = $request->query('room_type');
            return view('Admin.AdminCreateRooms', compact('Pet_types', 'Room_types', 'latestRoom', 'selectedPetType', 'selectedRoomType'));       
        }
        
        //เลือกประเภทห้องที่จะสร้าง
        public function selectRoomType()
        {
            $Pet_types = Pet_type::all();
            $Room_types = Rooms_type::all();
            return view('Admin.AdminSelectRoomType', compact('Pet_types', 'Room_types'));
        }

        //เก็บประเภทสัตว์
        public function storePetType(Request $request)
        {
            $validated = $request->validate([
                'new_pet_type' => 'required|string|max:255|unique:pet_type,Pet_nametype',
            ]);

            Pet_type::create(['Pet_nametype' => $validated['new_pet_type']]);

            return redirect()->back()->with('success', 'เพิ่มประเภทสัตว์เลี้ยงสำเร็จ');
        }

        //เก็บประเภทห้อง
        public function storeRoomType(Request $request)
        {
            $validated = $request->validate([
                'new_room_type' => 'required|string|max:255|unique:rooms_type,Rooms_type_name',
            ]);

            Rooms_type::create(['Rooms_type_name' => $validated['new_room_type']]);

            return redirect()->back()->with('success', 'เพิ่มประเภทห้องใหม่สำเร็จ');
        }

        //ส่งค่าจากหน้าสร้างห้องไป DB
        public function store(Request $request){
            $request->validate([
                'room_image.*' => 'required|image|mimes:jpeg,png,jpg|max:2048',
                'room_status' => 'required',
                'pet_type_hidden' => 'required',
                'room_type_hidden' => 'required',
                'room_price' => 'required|numeric',
                'room_description' => 'required',
            ]);
        
            $roomType = $request->room_type_hidden;
            $petType = $request->pet_type_hidden;
            $imageNames = [];
        
            if($request->hasFile('room_image')) {
                foreach($request->file('room_image') as $file) {
                    $fileName = time() . '_' . $file->getClientOriginalName();
                    $file->move(public_path('images'), $fileName);
                    $imageNames[] = $fileName;
                }
            }
        
            $newImg = Images::create([
                'ImagesPath' => implode(',', $imageNames),
                'ImagesName' => 'รูป'.$petType.$roomType
            ]);
        
            $idroomType = Rooms_type::where('Rooms_type_name', $roomType)->firstOrFail();
            $idpetType = Pet_type::where('Pet_nametype', $petType)->firstOrFail();
        
            $newPetRoomtype = Pet_Type_Room_Type::create([
                'Rooms_type_id' => $idroomType->Rooms_type_id,
                'Pet_type_id' => $idpetType->Pet_type_id,
                'Rooms_type_description' => $request->room_description,
                'Room_price' => $request->room_price,
                'ImagesID' => $newImg->ImagesID
            ]);
        
            $newRoom = Rooms::create([
                'Pet_Room_typeID' => $newPetRoomtype->Pet_Room_typeID,
                'Rooms_status' => $request->room_status
            ]);
        
            return redirect()->route('Admin.rooms')->with('complete', 'ห้องหมายเลข #'.$newRoom->Rooms_id. ' เพิ่มเรียบร้อย!');
        }
        
        

         // ส่งค่าไปรายงาน
        public function submitReport(Request $request)
        {
             // ตรวจสอบว่า booking นี้มีอยู่จริง
            $booking = Bookings::findOrFail($request->booking_id);

            $petStatus = new PetStatus();
            $petStatus->BookingOrderID = $request->booking_id; // ใช้ค่า integer ที่ได้จาก parameter
            $petStatus->status = $request->input('status', 1); // กำหนดค่าเริ่มต้นเป็น 1 ว่ารายงานแล้ว
            $petStatus->Report = $request->input('pet_status');
            $petStatus->Admin_id = Auth::id(); // ใช้เพื่อรับ ID ของ Admin ที่กำลัง login อยู่
            
            $petStatus->save();

            return redirect()->back()->with('success', 'บันทึกสถานะสัตว์เลี้ยงเรียบร้อยแล้ว');
        }
            

        public function checkout(Request $request){
            $room = Rooms::findOrFail($request->booking_id);
            $room->Rooms_status = 1;
            Bookings::destroy($request->booking_id);
            
            PetStatus::destroy($request->status_id);
            return redirect()->route('Admin.pets')->with('checkout', "หมายเลขการจอง #".$request->input('booking_id')." เรียบร้อย!");
        }

        //จัดการ การจองห้อง

        //โชว์รายการจองและรายงานสัตว์เลี้ยง
        public function showBookings(){
            $countDates = [];
            $bookings = Bookings::withTrashed()->with(['room','pet_status'])->orderBy('BookingOrderID', 'desc')->paginate(5);
            foreach($bookings as $bk) {
                $checkinDate = Carbon::parse($bk->Start_date);
                $checkoutDate = Carbon::parse($bk->End_date);
                $countDates[$bk->BookingOrderID] = $checkinDate->diffInDays($checkoutDate);
            }
            
            return view('Admin.AdminBookings', compact('bookings','countDates'));

        }

        //โชว์รายละเอียดการจองแต่ละอัน
        public function detail($id){
            $bookings = Bookings::withTrashed()->where('BookingOrderID', $id)->first();
            if(!$bookings){
                return redirect()->route('Admin.rooms')->with('error','ขณะนี้ห้องนี้ไม่มีรายการจอง');
            }
            return view('Admin.AdminBookingDetail', compact('bookings'));
        }

        // Confirm payment
    public function confirmPayment($id)
    {
        $booking = Bookings::findOrFail($id);
        $booking->Booking_status = 1;
        $booking->PaymentDate = now(); 
        $booking->save();

        

        return redirect()->route('Admin.bookings.detail', $id)
                        ->with('success', 'ยืนยันการชำระเงินหมายเลขการจอง'.$id."สำเร็จ");
    }

    // Cancel booking
    public function cancelBooking($id)
    {
        $booking = Bookings::findOrFail($id);
        $booking->Booking_status = 3;
        $booking->save();

        return redirect()->route('Admin.bookings')
                        ->with('cancel', 'Booking cancelled successfully');
    }

    // Extend booking
    public function extendBooking(Request $request, $id)
    {
        $booking = Bookings::findOrFail($id);
        $newEndDate = $request->input('new_end_date');

        
        if ($newEndDate > $booking->End_date) {
            $booking->End_date = $newEndDate;
            $booking->save();
            return redirect()->route('Admin.bookings')
                            ->with('success', $booking->user->name);
        }

        return redirect()->back()->withErrors(['new_end_date' => 'Invalid date']);
    }

    function checkoutManual($id){
        Bookings::destroy($id);
        PetStatus::destroy($id);

        return redirect()->route('Admin.bookings')->with('checkout', "หมายเลขการจอง #".$id." เรียบร้อย!");

    }

    public function users()
    {
        $users = User::where('role', 'user')
            ->with(['pets', 'bookings' => function ($query) {
                $query->withTrashed();
            }])
            ->get();
        
        return view("Admin.AdminUsers", compact("users"));
    }
}
