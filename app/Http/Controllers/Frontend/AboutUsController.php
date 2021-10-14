<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AboutUs;
use App\Models\Staff;
use App\Models\PracticalSolution;

class AboutUsController extends Controller
{
    //
    public function about(){

          
        $about=AboutUs::first();
        $staffs = Staff::with(['media'])->get();
        return view('frontend.about',compact('about','staffs'));

    }
}
