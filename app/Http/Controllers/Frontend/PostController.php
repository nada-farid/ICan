<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCommentRequest;
use App\Models\PublicSubject;
use App\Models\SubjectsCategory;
use App\Models\Comment;
use Alert;

class PostController extends Controller
{
    //
    public function index(){

      $subjects_categories = SubjectsCategory::with('subjectCategoryPublicSubjects')->paginate(6); 

      return view ('frontend.posts_subjects',compact('subjects_categories'));
    }
    public function posts($id){

      $posts = PublicSubject::where('subject_category_id',$id)->orderBy('created_at','desc')->paginate(6); 

      return view ('frontend.posts',compact('posts'));
    }
    public function show($post_id){

        $post = PublicSubject::findOrFail($post_id);

        $post->load('postComments');

        $posts=PublicSubject::all();
        return view('frontend.post_details',compact('post','posts'));
    }
    public function StoreComment(StoreCommentRequest $request)
    {
        $comment = Comment::create($request->all());

        Alert::success(trans('global.flash.success'),('تم حفظ تعليقك بنجاح'));

        return redirect()->route('frontend.post_details',$request->post_id);
    }

  }
