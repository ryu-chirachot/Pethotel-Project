<?php

namespace App\Http\Controllers;
use App\Models\Bookings;
use App\Models\Images;
use App\Models\Rooms_type;
use App\Models\pet_type_room_type;
use Illuminate\Support\Facades\DB;


use Illuminate\Http\Request;

class BooksController extends Controller
{
    public function index()
    {
        //
    }
    public function showRoomsPets()
    {
        $Pets_rooms = pet_type_room_type::with(['roomType', 'image'])->get();
        
        return view('bookings', compact('Pets_rooms'));
    }

}
