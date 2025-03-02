<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Reviews;

class ReviewController extends Controller
{

    function index($id){
        return view('reviews',compact('id'));
    }

    public function submitReview(Request $request)
    {
        Reviews::create([
            'BookingOrderID' => $request->booking_id,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);
        
        // Redirect 
        return redirect()->route('bookings.index')->with('เสร็จสิ้น', 'ขอบคุณสำหรับการรีวิวของคุณ');
    }

    public function history($id){
        $review = Reviews::where('BookingOrderID',$id)->get();
        return view('User.Historyreview',compact('review'));
    }
}

