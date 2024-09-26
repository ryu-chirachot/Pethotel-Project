<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Reviews;

class ReviewController extends Controller
{
    public function submitReview(Request $request)
    {
        Reviews::create([
            'BookingOrderID' => 1,
            'Rating' => $request->rating,
            'content' => $request->comment,
        ]);

        // Redirect 
        return redirect()->back()->with('เสร็จสิ้น', 'ขอบคุณสำหรับการรีวิวของคุณ');
    }
}


