<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EditUserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use Symfony\Component\CssSelector\XPath\Extension\FunctionExtension;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ReviewController;



// โซน user
Route::get('/', function () {
    return redirect()->route('mains', ['viewname' => 'homepage']);
})->name('home');

Route::middleware(['auth:sanctum'])->group(function () {
Route::post('/update-pet', [BookingController::class, 'petUpdate'])->name('pet.update');
Route::get('/home/mypets',[BookingController::class, 'mypets'])->name('mypets');
Route::get('/home/mypets/{id}',[BookingController::class, 'deletePet'])->name('deletepet');
});

Route::middleware('checkLogin')->group(function(){
    Route::get('/edit', [UserController::class, 'edit']);
    Route::post("/edit/update",[UserController::class,'EditUpdate'])->name("user.edit_update");
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/info', [BookingController::class, 'send'])->name('info');
    Route::post('/overview',[BookingController::class,'petInfo'])->name('overview');
    Route::post('/payment',[BookingController::class,'book'])->name('payment');
});

Route::get('/home/{viewname}',[SearchController::class,'showpet'])->name('main'); 
Route::get('/home/{viewname}',[SearchController::class,'show'])->name('mains'); 
Route::get('/room/search',[SearchController::class,'search'])->name('search.result');

//รีวิว
Route::post('/success',[BookingController::class,'booked'])->name('success');
Route::get('/review/{id}',[ReviewController::class, 'index'])->name('review');
Route::post('/submit/review', [ReviewController::class, 'submitReview'])->name('submit.review');


//รายละเอียดการจอง user 
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index');
    Route::get('/bookings/{id}', [BookingController::class, 'show'])->name('bookings.show');
    Route::get('/pets/status/{id}', [BookingController::class, 'petStatus'])->name('pets.status');
});


//โซน Route Admin

Route::middleware(['admin'])->group(function () {
    //หน้าHome
    Route::get('/Admin/Home', [AdminController::class, 'index'])->name('Admin.index');

    //ห้อง
    Route::get('/Admin/Rooms',[AdminController::class,'rooms'])->name('Admin.rooms'); //route สำหรับเรียกดูห้องทั้งหมด
    Route::get('/Admin/Rooms/ว่าง',[AdminController::class,'Available'])->name('Admin.available');
    Route::get('/Admin/Rooms/ห้องที่ไม่ว่าง',[AdminController::class,'Unavailable'])->name('Admin.unavailable'); //route สำหรับเรียกดูห้องทั้งหมด
    Route::post('Admin/Rooms/Edit/Update',[AdminController::class,'updateRoom'])->name('rooms.update'); //route สำหรับ ไปหน้าแก้ไขห้อง
    Route::get('/Admin/Rooms/Edit/{id}',[AdminController::class,'editrooms'])->name('Admin.editrooms'); //route สำหรับส่งค่าไปแก้ไขห้องใน DB

    Route::get('/Admin/Rooms/selecttype',[AdminController::class,'selectRoomType'])->name('Admin.rooms.type'); //route สำหรับไปที่หน้าสร้างห้อง
    Route::post('/Admin/Pet-types', [AdminController::class,'storePetType'])->name('Admin.petTypes.store');
    Route::post('/Admin/Room-types', [AdminController::class,'storeRoomType'])->name('Admin.roomTypes.store');
    Route::get('/Admin/Rooms/create',[AdminController::class,'createRooms'])->name('Admin.rooms.create'); //route สำหรับไปที่หน้าสร้างห้อง
    Route::post('/Admin/Rooms/create/success',[AdminController::class,'store'])->name('Admin.rooms.store');
    Route::get('/Admin/Rooms/delete/{id}',[AdminController::class,'delete'])->name('Admin.rooms.delete'); //route สำหรับลบข้อมูลห้องใน Admin 

    //รายงานสถานะสัตว์เลี้ยง
    Route::get('/Admin/user',[AdminController::class,'users'])->name('Admin.user');
    Route::get('/Admin/user/{id}',[AdminController::class,'userdetail'])->name('Admin.user.detail');
    Route::post('/Admin/Pets/report/',[AdminController::class,'submitReport'])->name('Admin.report');
});

//การจอง
Route::prefix('/Admin/Bookings')->name('Admin.')->middleware('admin')->group(function () {
    
    Route::get('/', [AdminController::class, 'showBookings'])->name('bookings');
    Route::get('/TodayBook', [AdminController::class, 'Todaybooking'])->name('bookings.today');
    Route::get('/Expiredbooking', [AdminController::class, 'expiredbooking'])->name('bookings.expired');
    Route::get('/detail/{id}', [AdminController::class, 'detail'])->name('bookings.detail');
    Route::post('detail/confirm-payment/{id}', [AdminController::class, 'confirmPayment'])->name('bookings.confirmPayment');
    Route::post('detail/extend/{id}', [AdminController::class, 'extendBooking'])->name('bookings.extend');
    Route::post('detail/cancel/{id}', [AdminController::class, 'cancelBooking'])->name('bookings.cancel');
    Route::get('detail/checkout/{id}', [AdminController::class,'checkout'])->name('bookings.checkout');
    Route::post('/การจองวันนี้', [AdminController::class,''])->name('bookings.today');
    Route::post('/การจองที่เลยกำหนด', [AdminController::class,''])->name('booking.deadline');
});






// Route::middleware([
//     'auth:admin',
//     config('jetstream.auth_session'),
//     'verified',
// ])->group(function () {
//     Route::get('/Admin', function () {
//         return view('dashboard');
//     })->name('dashboard');
// });