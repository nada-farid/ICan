<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyStaffRequest;
use App\Http\Requests\StoreStaffRequest;
use App\Http\Requests\UpdateStaffRequest;
use App\Models\Staff;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;
Use Alert;

class StaffController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('staff_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $staff = Staff::with(['media'])->get();

        return view('admin.staff.index', compact('staff'));
    }

    public function create()
    {
        abort_if(Gate::denies('staff_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.staff.create');
    }

    public function store(StoreStaffRequest $request)
    {
        $staff = Staff::create($request->all());

        if ($request->input('photo', false)) {
            $staff->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $staff->id]);
        }

        Alert::success(trans('global.flash.success'), trans('global.flash.created'));

        return redirect()->route('admin.staff.index');
    }

    public function edit(Staff $staff)
    {
        abort_if(Gate::denies('staff_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.staff.edit', compact('staff'));
    }

    public function update(UpdateStaffRequest $request, Staff $staff)
    {
        $staff->update($request->all());

        if ($request->input('photo', false)) {
            if (!$staff->photo || $request->input('photo') !== $staff->photo->file_name) {
                if ($staff->photo) {
                    $staff->photo->delete();
                }
                $staff->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
            }
        } elseif ($staff->photo) {
            $staff->photo->delete();
        }
        Alert::success(trans('global.flash.success'), trans('global.flash.updated'));

        return redirect()->route('admin.staff.index');
    }

    public function show(Staff $staff)
    {
        abort_if(Gate::denies('staff_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.staff.show', compact('staff'));
    }

    public function destroy(Staff $staff)
    {
        abort_if(Gate::denies('staff_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $staff->delete();

        Alert::success(trans('global.flash.success'), trans('global.flash.deleted'));

        return back();
    }

    public function massDestroy(MassDestroyStaffRequest $request)
    {
        Staff::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('staff_create') && Gate::denies('staff_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Staff();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
