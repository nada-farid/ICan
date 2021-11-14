<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterUserRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Alert;

class AuthController extends Controller
{
    //
    public function register(){

        return view('frontend.register');
    }
    
    public function store(RegisterUserRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => bcrypt($request->password),
            'user_type' => 'user',

        ]);

        Alert::success(trans('global.flash.success'), trans('global.flash.created'));
        return redirect()->route('frontend.posts');
        

        
    }
}
