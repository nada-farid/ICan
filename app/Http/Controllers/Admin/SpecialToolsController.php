<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroySpecialToolRequest;
use App\Http\Requests\StoreSpecialToolRequest;
use App\Http\Requests\UpdateSpecialToolRequest;
use App\Models\SpecialTool;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;
Use Alert;

class SpecialToolsController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('special_tool_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $specialTools = SpecialTool::with(['media'])->get();

        return view('admin.specialTools.index', compact('specialTools'));
    }

    public function create()
    {
        abort_if(Gate::denies('special_tool_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.specialTools.create');
    }

    public function store(StoreSpecialToolRequest $request)
    {
        $specialTool = SpecialTool::create($request->all());

        if ($request->input('photo', false)) {
            $specialTool->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $specialTool->id]);
        }

        Alert::success(trans('global.flash.success'), trans('global.flash.created'));

        return redirect()->route('admin.special-tools.index');
    }

    public function edit(SpecialTool $specialTool)
    {
        abort_if(Gate::denies('special_tool_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.specialTools.edit', compact('specialTool'));
    }

    public function update(UpdateSpecialToolRequest $request, SpecialTool $specialTool)
    {
        $specialTool->update($request->all());

        if ($request->input('photo', false)) {
            if (!$specialTool->photo || $request->input('photo') !== $specialTool->photo->file_name) {
                if ($specialTool->photo) {
                    $specialTool->photo->delete();
                }
                $specialTool->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
            }
        } elseif ($specialTool->photo) {
            $specialTool->photo->delete();
        }
        Alert::success(trans('global.flash.success'), trans('global.flash.updated'));

        return redirect()->route('admin.special-tools.index');
    }

    public function show(SpecialTool $specialTool)
    {
        abort_if(Gate::denies('special_tool_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.specialTools.show', compact('specialTool'));
    }

    public function destroy(SpecialTool $specialTool)
    {
        abort_if(Gate::denies('special_tool_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $specialTool->delete();

        Alert::success(trans('global.flash.success'), trans('global.flash.deleted'));

        return back();
    }

    public function massDestroy(MassDestroySpecialToolRequest $request)
    {
        SpecialTool::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('special_tool_create') && Gate::denies('special_tool_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new SpecialTool();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
