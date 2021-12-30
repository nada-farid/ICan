<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyVideosParticipateRequest;
use App\Http\Requests\StoreVideosParticipateRequest;
use App\Http\Requests\UpdateVideosParticipateRequest;
use App\Models\Champion;
use App\Models\PracticalSolution;
use App\Models\VideosParticipate;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Alert;

class VideosParticipateController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('videos_participate_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $videosParticipates = VideosParticipate::with(['practical_solution', 'champion', 'media'])->get();

        return view('admin.videosParticipates.index', compact('videosParticipates'));
    }

    public function create()
    {
        abort_if(Gate::denies('videos_participate_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $practical_solutions = PracticalSolution::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $champions = Champion::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.videosParticipates.create', compact('champions', 'practical_solutions'));
    }

    public function store(StoreVideosParticipateRequest $request)
    {
        $videosParticipate = VideosParticipate::create($request->all());

        if ($request->input('video', false)) {
            $videosParticipate->addMedia(storage_path('tmp/uploads/' . basename($request->input('video'))))->toMediaCollection('video');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $videosParticipate->id]);
        }

        Alert::success(trans('global.flash.success'), trans('global.flash.created'));
        return redirect()->route('admin.videos-participates.index');
    }

    public function edit(VideosParticipate $videosParticipate)
    {
        abort_if(Gate::denies('videos_participate_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $practical_solutions = PracticalSolution::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $champions = Champion::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $videosParticipate->load('practical_solution', 'champion');

        return view('admin.videosParticipates.edit', compact('champions', 'practical_solutions', 'videosParticipate'));
    }

    public function update(UpdateVideosParticipateRequest $request, VideosParticipate $videosParticipate)
    {
        $videosParticipate->update($request->all());

        if ($request->input('video', false)) {
            if (!$videosParticipate->video || $request->input('video') !== $videosParticipate->video->file_name) {
                if ($videosParticipate->video) {
                    $videosParticipate->video->delete();
                }
                $videosParticipate->addMedia(storage_path('tmp/uploads/' . basename($request->input('video'))))->toMediaCollection('video');
            }
        } elseif ($videosParticipate->video) {
            $videosParticipate->video->delete();
        }

        Alert::success(trans('global.flash.success'), trans('global.flash.updated'));
        return redirect()->route('admin.videos-participates.index');
    }

    public function show(VideosParticipate $videosParticipate)
    {
        abort_if(Gate::denies('videos_participate_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $videosParticipate->load('practical_solution', 'champion');

        return view('admin.videosParticipates.show', compact('videosParticipate'));
    }

    public function destroy(VideosParticipate $videosParticipate)
    {
        abort_if(Gate::denies('videos_participate_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $videosParticipate->delete();

        return back();
    }

    public function massDestroy(MassDestroyVideosParticipateRequest $request)
    {
        VideosParticipate::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('videos_participate_create') && Gate::denies('videos_participate_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new VideosParticipate();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}