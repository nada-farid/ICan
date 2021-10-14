<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MedicalOpinion;

class MedicalOpinionsController extends Controller
{
    //
    public function opinions(){

        $medicalOpinions = MedicalOpinion::with(['doctor', 'media'])->paginate(2);

        return view('frontend.medicalOpinions',compact('medicalOpinions'));

    }
}
