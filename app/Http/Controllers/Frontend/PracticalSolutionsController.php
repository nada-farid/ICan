<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PracticalSolution;
use Spatie\MediaLibrary\Models\Media;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StorePracticalSolutionRequest;
use App\Http\Requests\UpdatePracticalSolutionRequest;
use Alert;

class PracticalSolutionsController extends Controller
{
    use MediaUploadingTrait;
    
    public function all(){
         
        $practicalSolutions = PracticalSolution::where('status','accepted')->with(['media'])->paginate(4);

        return view('frontend.practicalSolutions.index', compact('practicalSolutions'));

    }

    public function show($id){
         
        $practicalSolution = PracticalSolution::findOrFail($id)->with(['media'])->first();

        return view('frontend.practicalSolutions.show', compact('practicalSolution'));

    }

    public function store(StorePracticalSolutionRequest $request)
    {
        $practicalSolution = PracticalSolution::create($request->all());

        if ($request->input('photo', false)) {
            $practicalSolution->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
        }

        if ($request->input('video', false)) {
            $practicalSolution->addMedia(storage_path('tmp/uploads/' . basename($request->input('video'))))->toMediaCollection('video');
        }

        foreach ($request->input('photos', []) as $file) {
            $practicalSolution->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('photos');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $practicalSolution->id]);
        }

        Alert::success(trans('global.flash.success'), trans('global.flash.created'));

        return redirect()->route('frontend.profile_solves');
    }


    public function edit(Request $request)
    { 
        $practicalSolution = PracticalSolution::findOrFail($request->id);

        return view('frontend.edit_practical_solution',compact('practicalSolution'));
    }

    public function update(UpdatePracticalSolutionRequest $request, PracticalSolution $practicalSolution)
    {
        $practicalSolution->update($request->all());

        if ($request->input('photo', false)) {
            if (!$practicalSolution->photo || $request->input('photo') !== $practicalSolution->photo->file_name) {
                if ($practicalSolution->photo) {
                    $practicalSolution->photo->delete();
                }
                $practicalSolution->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
            }
        } elseif ($practicalSolution->photo) {
            $practicalSolution->photo->delete();
        }

        if ($request->input('video', false)) {
            if (!$practicalSolution->video || $request->input('video') !== $practicalSolution->video->file_name) {
                if ($practicalSolution->video) {
                    $practicalSolution->video->delete();
                }
                $practicalSolution->addMedia(storage_path('tmp/uploads/' . basename($request->input('video'))))->toMediaCollection('video');
            }
        } elseif ($practicalSolution->video) {
            $practicalSolution->video->delete();
        }

        if (count($practicalSolution->photos) > 0) {
            foreach ($practicalSolution->photos as $media) {
                if (!in_array($media->file_name, $request->input('photos', []))) {
                    $media->delete();
                }
            }
        }
        $media = $practicalSolution->photos->pluck('file_name')->toArray();
        foreach ($request->input('photos', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $practicalSolution->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('photos');
            }
        }
        Alert::success(trans('global.flash.success'), trans('global.flash.updated'));

        return redirect()->route('frontend.profile_solves');
    }
    
    public function destroy(PracticalSolution $practicalSolution)
    { 

        $practicalSolution->delete();

        Alert::success(trans('global.flash.success'), trans('global.flash.deleted'));

        return back();
    }

    public function storeCKEditorImages(Request $request)
    { 

        $model         = new PracticalSolution();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
