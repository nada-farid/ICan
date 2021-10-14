<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Champion;

class ChampionsController extends Controller
{
    //
    public function champions(){

        $champions = Champion::with(['languages', 'media'])->paginate(8);

        return view('frontend.champions',compact('champions'));
    }

    public function champion_single($id){
        
        $champion = Champion::findOrFail($id)->with(['languages','media'])->first();
 

        return view('frontend.champion_single',compact('champion'));

    }
}
