<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SpecialTool;

class SpecialToolsController extends Controller
{
    //
    public function tools(){


        $specialTools = SpecialTool::with(['media'])->paginate(4);

        return view('frontend.tools',compact('specialTools'));



    }


}
