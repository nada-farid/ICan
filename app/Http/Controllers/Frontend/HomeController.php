<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AboutUs;
use App\Models\PracticalSolution;
use App\Models\Slider;
use App\Models\Champion;
use App\Models\MedicalOpinion;
use Spatie\MediaLibrary\Models\Media;
use App\Http\Controllers\Traits\MediaUploadingTrait;
class HomeController extends Controller
{
       
    public function index(){
          
        $about=AboutUs::first();
        $solutions =PracticalSolution::orderBy('updated_at','desc')->get()->take(2);
        $sliders = Slider::with(['media'])->get();
        $champions = Champion::orderBy('updated_at','desc')->get()->take(4);
        $medicalOpinions = MedicalOpinion::orderBy('updated_at','desc')->get()->take(2);

        return view('frontend.home',compact('about','solutions','sliders','champions','medicalOpinions'));
        }
}
