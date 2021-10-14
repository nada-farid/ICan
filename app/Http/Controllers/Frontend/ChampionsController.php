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

    public function champion_single($Id){
        
        $champion = Champion::findOrFail($Id);
        $champion->load(['languages','media']);
  

        return view('frontend.champion_single',compact('champion'));

    }
}
