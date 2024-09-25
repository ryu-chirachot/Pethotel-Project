<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReviewController extends Controller
{
    // ฟังก์ชันสำหรับจัดการการส่งรีวิว
    public function submitReview(Request $request)
    {
        Reviews::create([
            // 'BookingOrderID' => $request->BookingOrderID,
            'Rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        // Redirect 
        return redirect()->back()->with('เสร็จสิ้น', 'ขอบคุณสำหรับการรีวิวของคุณ');
    }
}


