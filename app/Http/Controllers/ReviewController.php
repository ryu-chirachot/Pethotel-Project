<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reviews;

class ReviewController extends Controller
{
    public function index() {
        //
    }
    
    public function showReview() {
        $reviews = Reviews::with(['booking.user'])->get(); // ดึงข้อมูล user ผ่าน booking
        return view('review', compact('reviews'));
        // dd($reviews);
    }    
    
}
