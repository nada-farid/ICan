<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PracticalSolution;

class PracticalSolutionsController extends Controller
{
    //
    public function all(){
         
        $practicalSolutions = PracticalSolution::with(['media'])->paginate(4);

        return view('frontend.practicalSolutions.index', compact('practicalSolutions'));

    }

    public function show($id){
         
        $practicalSolution = PracticalSolution::findOrFail($id)->with(['media'])->first();

        return view('frontend.practicalSolutions.show', compact('practicalSolution'));

    }
}
