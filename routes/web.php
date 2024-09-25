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




Route::get('/', function () {
    return redirect()->route('main', ['viewname' => 'homepage']);
})->name('home');

Route::middleware('checkLogin')->group(function(){
    Route::get('/edit', [UserController::class, 'edit']);
    Route::post("/edit/update",[UserController::class,'EditUpdate'])->name("user.edit_update");
});
Route::post('/overview',[BookingController::class,'petInfo'])->name('overview');
Route::post('/info', [BookingController::class, 'send'])->name('info');

Route::post('/payment',[BookingController::class,'book'])->name('payment');

Route::get('/home/{viewname}',[SearchController::class,'showpet'])->name('main'); 
Route::post('/room/search',[SearchController::class,'search']
)->name('search.result');



Route::post('/success',[BookingController::class,'booked'])->name('success');
Route::get('/test', function () {
    return view('reviews');});
    Route::post('/submit/review', [ReviewController::class, 'submitReview'])->name('submit.review');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

//โซน Route Admin


Route::get('/Admin/Home', [AdminController::class, 'index'])->middleware('admin')->name('Admin.index');
Route::get('/Admin/Bookings', function () {
    return view('Admin.AdminBookings');
})->middleware('admin')->name('Admin.bookings');

Route::get('/Admin/Rooms',[AdminController::class,'rooms'])->middleware('admin')->name('Admin.rooms'); //route สำหรับเรียกดูห้องทั้งหมด
Route::get('/Admin/Rooms/ห้องที่ว่าง',[AdminController::class,'rooms'])->middleware('admin')->name('Admin.available'); //route สำหรับเรียกดูห้องทั้งหมด
Route::get('/Admin/Rooms/ห้องที่ไม่ว่าง',[AdminController::class,'rooms'])->middleware('admin')->name('Admin.unavailable'); //route สำหรับเรียกดูห้องทั้งหมด
Route::post('Admin/Rooms/Edit/Update',[AdminController::class,'updateRoom'])->middleware('admin')->name('rooms.update'); //route สำหรับ ไปหน้าแก้ไขห้อง

Route::get('/Admin/Rooms/Edit/{id}',[AdminController::class,'editrooms'])->middleware('admin')->name('Admin.editrooms'); //route สำหรับส่งค่าไปแก้ไขห้องใน DB

Route::get('/Admin/Rooms/create',[AdminController::class,'create'])->middleware('admin')->name('Admin.rooms.create'); //route สำหรับไปที่หน้าสร้างห้อง

Route::post('/Admin/Rooms/create/success',[AdminController::class,'store'])->middleware('admin')->name('Admin.rooms.store');

Route::get('/Admin/Rooms/delete/{id}',[AdminController::class,'delete'])->middleware('admin')->name('Admin.rooms.delete'); //route สำหรับลบข้อมูลห้องใน Admin 

Route::get('/Admin/Pets',[AdminController::class,'petstatus'])->middleware('admin')->name('Admin.pets');

Route::get('/Admin/Setting', function () {
    return view('Admin.AdminSetting');
})->name('Admin.setting');








