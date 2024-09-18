<?php

namespace App\Http\Controllers;
use App\Models\Pet_type;
use Illuminate\Http\Request;

class SearchController extends Controller
{       
    function showpet(){
        $p_type=pet_type::all();
        return view("layouts.searchbar",compact('p_type'));
    }
    function search(Request $request){
        {
            $room=Rooms::where("Rooms_status",1)->get();
            $p_type=pet_type::where("pet_type_id",$request->input('pet_type'));
        }
    }
    // function search($request){

    //     $search= Rooms::all();
    //     if($request->$p_type->ptype_name ="กระต่าย")
    //     $roomcount = count($search->room=="1");
    //     $type1count=count();
    //     $type2count=count();
    //     $type3count=count();
    // }
    // function searchResult(){
    //     $result=Rooms::all();
    //     $roomtype1=//ข้อมูลต่างๆที่จะแสดง;
    //     $roomtype2=//ข้อมูลต่างๆที่จะแสดง;
    //     $roomtype3=//ข้อมูลต่างๆที่จะแสดง;
    // }
    
}
