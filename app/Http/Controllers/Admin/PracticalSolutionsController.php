<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyPracticalSolutionRequest;
use App\Http\Requests\StorePracticalSolutionRequest;
use App\Http\Requests\UpdatePracticalSolutionRequest;
use App\Models\PracticalSolution;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;
Use Alert;

class PracticalSolutionsController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('practical_solution_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $practicalSolutions = PracticalSolution::with(['media'])->get();

        return view('admin.practicalSolutions.index', compact('practicalSolutions'));
    }

    public function create()
    {
        abort_if(Gate::denies('practical_solution_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.practicalSolutions.create');
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

        return redirect()->route('admin.practical-solutions.index');
    }

    public function edit(PracticalSolution $practicalSolution)
    {
        abort_if(Gate::denies('practical_solution_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.practicalSolutions.edit', compact('practicalSolution'));
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

        return redirect()->route('admin.practical-solutions.index');
    }

    public function show(PracticalSolution $practicalSolution)
    {
        abort_if(Gate::denies('practical_solution_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.practicalSolutions.show', compact('practicalSolution'));
    }

    public function destroy(PracticalSolution $practicalSolution)
    {
        abort_if(Gate::denies('practical_solution_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $practicalSolution->delete();

        Alert::success(trans('global.flash.success'), trans('global.flash.deleted'));

        return back();
    }

    public function massDestroy(MassDestroyPracticalSolutionRequest $request)
    {
        PracticalSolution::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('practical_solution_create') && Gate::denies('practical_solution_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new PracticalSolution();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
