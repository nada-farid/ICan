<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AboutUs;
use App\Models\PracticalSolution;
use App\Models\Slider;
use App\Models\Champion;
use App\Models\MedicalOpinion;
use App\Models\VideosParticipate;
use Spatie\MediaLibrary\Models\Media;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use Auth; 

class HomeController extends Controller
{
    public function index()
    {
        $about = AboutUs::first();
        $solutions = PracticalSolution::where('status','accepted')
            ->orderBy('updated_at', 'desc')
            ->get()
            ->take(2);
        $sliders = Slider::with(['media'])->get();
        $champions = Champion::orderBy('updated_at', 'desc')
            ->get()
            ->take(4);
        $medicalOpinions = MedicalOpinion::orderBy('updated_at', 'desc')
            ->get()
            ->take(2);

        return view(
            'frontend.home',
            compact(
                'about',
                'solutions',
                'sliders',
                'champions',
                'medicalOpinions'
            )
        );
    }
    
    public function profile(){
        $user = Auth::user();
        return view('frontend.profile',compact('user'));
    }
    public function profile_solves(){
        $user = Auth::user();
        $practical_solutions = PracticalSolution::where('user_id',$user->id)->orderBy('created_at','desc')->paginate(6);
        return view('frontend.profilesolves',compact('user','practical_solutions'));
    }
    public function profile_videos(){
        $user = Auth::user();
        $practical_solutions = PracticalSolution::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), ''); 
        $champions = Champion::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $video_participates = VideosParticipate::where('user_id',$user->id)->orderBy('created_at','desc')->paginate(6);
        return view('frontend.profilevideos',compact('user','video_participates','practical_solutions','champions'));
    }
}
