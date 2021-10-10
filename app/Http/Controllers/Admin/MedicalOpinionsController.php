<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyMedicalOpinionRequest;
use App\Http\Requests\StoreMedicalOpinionRequest;
use App\Http\Requests\UpdateMedicalOpinionRequest;
use App\Models\MedicalOpinion;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class MedicalOpinionsController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('medical_opinion_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $medicalOpinions = MedicalOpinion::with(['doctor', 'media'])->get();

        return view('admin.medicalOpinions.index', compact('medicalOpinions'));
    }

    public function create()
    {
        abort_if(Gate::denies('medical_opinion_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $doctors = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.medicalOpinions.create', compact('doctors'));
    }

    public function store(StoreMedicalOpinionRequest $request)
    {
        $medicalOpinion = MedicalOpinion::create($request->all());

        if ($request->input('photo', false)) {
            $medicalOpinion->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $medicalOpinion->id]);
        }

        return redirect()->route('admin.medical-opinions.index');
    }

    public function edit(MedicalOpinion $medicalOpinion)
    {
        abort_if(Gate::denies('medical_opinion_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $doctors = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $medicalOpinion->load('doctor');

        return view('admin.medicalOpinions.edit', compact('doctors', 'medicalOpinion'));
    }

    public function update(UpdateMedicalOpinionRequest $request, MedicalOpinion $medicalOpinion)
    {
        $medicalOpinion->update($request->all());

        if ($request->input('photo', false)) {
            if (!$medicalOpinion->photo || $request->input('photo') !== $medicalOpinion->photo->file_name) {
                if ($medicalOpinion->photo) {
                    $medicalOpinion->photo->delete();
                }
                $medicalOpinion->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
            }
        } elseif ($medicalOpinion->photo) {
            $medicalOpinion->photo->delete();
        }

        return redirect()->route('admin.medical-opinions.index');
    }

    public function show(MedicalOpinion $medicalOpinion)
    {
        abort_if(Gate::denies('medical_opinion_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $medicalOpinion->load('doctor');

        return view('admin.medicalOpinions.show', compact('medicalOpinion'));
    }

    public function destroy(MedicalOpinion $medicalOpinion)
    {
        abort_if(Gate::denies('medical_opinion_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $medicalOpinion->delete();

        return back();
    }

    public function massDestroy(MassDestroyMedicalOpinionRequest $request)
    {
        MedicalOpinion::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('medical_opinion_create') && Gate::denies('medical_opinion_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new MedicalOpinion();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
