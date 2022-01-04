<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\RegisterUserRequest;
use App\Http\Requests\Update_profileRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Alert;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Auth;

class AuthController extends Controller
{
    //
    use MediaUploadingTrait; 
    public function register(){

        return view('frontend.register');
    }
    
    public function store(RegisterUserRequest $request)
    {

      $user = User::create([
           'name'=>$request->name,
           'email'=>$request->email,
           'password'=>bcrypt($request->password),
           'phone'=>$request->phone,
           'user_type'=>'user',
          
          
          ]);
          if ($request->input('photo', false)) {
            $user->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $user->id]);
        }
        
        Alert::success(trans('global.flash.success'), trans('global.flash.created'));
        return redirect()->route('frontend.posts_categories');
        

        
    }
    public function UpdateProfile(Update_profileRequest $request){
        $user=Auth::user();
        $user->update($request->all());
        if ($request->input('photo', false)) {
            if (!$user->photo || $request->input('photo') !== $user->photo->file_name) {
                if ($user->photo) {
                    $user->photo->delete();
                }
                $user->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
            }
        } elseif ($user->photo) {
            $user->photo->delete();
        }
        Alert::success(trans('global.flash.success'), trans('global.flash.updated'));
        return redirect()->route('frontend.profile');
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('user_create') && Gate::denies('user_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new User();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}

