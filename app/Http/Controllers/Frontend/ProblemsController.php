<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProblemRequest;
use App\Models\Problem;
use Alert;

class ProblemsController extends Controller
{
    //
    public function view(){

        return view('frontend.haveProblem');
    }
    public function store(StoreProblemRequest $request)
    {
        $problem = Problem::create($request->all());

        Alert::success(trans('global.flash.success'), trans('تم تسجيل مشكلتك بنجاح وسنقوم بالتواصل معك قريبا'));


        return redirect()->route('home');
    }
}
