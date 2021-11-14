<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyPublicSubjectRequest;
use App\Http\Requests\StorePublicSubjectRequest;
use App\Http\Requests\UpdatePublicSubjectRequest;
use App\Models\PublicSubject;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Alert;

class PublicSubjectsController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('public_subject_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $publicSubjects = PublicSubject::with(['media'])->get();

        return view('admin.publicSubjects.index', compact('publicSubjects'));
    }

    public function create()
    {
        abort_if(Gate::denies('public_subject_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.publicSubjects.create');
    }

    public function store(StorePublicSubjectRequest $request)
    {
        $publicSubject = PublicSubject::create($request->all());

        if ($request->input('photo', false)) {
            $publicSubject->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $publicSubject->id]);
        }

        Alert::success(trans('global.flash.success'), trans('global.flash.created'));

        return redirect()->route('admin.public-subjects.index');
    }

    public function edit(PublicSubject $publicSubject)
    {
        abort_if(Gate::denies('public_subject_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.publicSubjects.edit', compact('publicSubject'));
    }

    public function update(UpdatePublicSubjectRequest $request, PublicSubject $publicSubject)
    {
        $publicSubject->update($request->all());

        if ($request->input('photo', false)) {
            if (!$publicSubject->photo || $request->input('photo') !== $publicSubject->photo->file_name) {
                if ($publicSubject->photo) {
                    $publicSubject->photo->delete();
                }
                $publicSubject->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
            }
        } elseif ($publicSubject->photo) {
            $publicSubject->photo->delete();
        }

        Alert::success(trans('global.flash.success'), trans('global.flash.updated'));

        return redirect()->route('admin.public-subjects.index');
    }

    public function show(PublicSubject $publicSubject)
    {
        abort_if(Gate::denies('public_subject_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $publicSubject->load('postComments');

        return view('admin.publicSubjects.show', compact('publicSubject'));
    }

    public function destroy(PublicSubject $publicSubject)
    {
        abort_if(Gate::denies('public_subject_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $publicSubject->delete();

        Alert::success(trans('global.flash.success'), trans('global.flash.deleted'));

        return back();
    }

    public function massDestroy(MassDestroyPublicSubjectRequest $request)
    {
        PublicSubject::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('public_subject_create') && Gate::denies('public_subject_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new PublicSubject();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
