<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contactu;
use App\Models\AboutUs;
use App\Http\Requests\StoreContactuRequest;


class ContactusController extends Controller
{
    //
    public function contactus(){
 

        $about=AboutUs::first();

        return view('frontend.contactus',compact('about'));
    }

    public function store(StoreContactuRequest $request){

        Contactu::create($request->all()); 

        return redirect('/contact_us')->with('status', ' تم تسجيل أستفسارك بنجاح');
     
    }
}
