<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/',[SearchController::class,'showpet']); 

Route::post('/room/search',[SearchController::class,'search']
); 
Route::get('/b', function () {
    return view('booking');
});
Route::post('/home/search',[SearchController::class,'search']
); 

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
Route::get('/Admin/Home',[AdminController::class,'index'])->name('Admin.index');

Route::get('/Admin/Bookings', function () {
    return view('Admin.AdminBookings');
})->name('Admin.bookings');

Route::get('/Admin/Rooms',[AdminController::class,'rooms'])->name('Admin.rooms');

Route::get('/Admin/Pets', function () {
    return view('Admin.AdminPets');
})->name('Admin.pets');

Route::get('/Admin/Payments', function () {
    return view('Admin.AdminPayments');
})->name('Admin.payments');

Route::get('/Admin/Rooms/Edit/{id}',[AdminController::class,'editrooms'])->name('Admin.editrooms');

Route::get('/Admin/Setting', function () {
    return view('Admin.AdminSetting');
})->name('Admin.setting');

Route::get('/Admin/Rooms/search',[AdminController::class,'searchRoom'])->name('Admin.search');

Route::post('Admin/Rooms/Edit/Update',[AdminController::class,'updateRoom'])->name('rooms.update');

