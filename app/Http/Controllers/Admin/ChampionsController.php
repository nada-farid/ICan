<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyChampionRequest;
use App\Http\Requests\StoreChampionRequest;
use App\Http\Requests\UpdateChampionRequest;
use App\Models\Champion;
use App\Models\Language;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class ChampionsController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('champion_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $champions = Champion::with(['languages', 'media'])->get();

        return view('admin.champions.index', compact('champions'));
    }

    public function create()
    {
        abort_if(Gate::denies('champion_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $languages = Language::all();

        return view('admin.champions.create', compact('languages'));
    }

    public function store(StoreChampionRequest $request)
    {
        $champion = Champion::create($request->all());
        $champion->languages()->sync($this->mapallang($request['languages']));
        if ($request->input('photo', false)) {
            $champion->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
        }

        foreach ($request->input('tournament_photo', []) as $file) {
            $champion->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('tournament_photo');
        }

        foreach ($request->input('tournament_videos', []) as $file) {
            $champion->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('tournament_videos');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $champion->id]);
        }

        return redirect()->route('admin.champions.index');
    } 

    public function edit(Champion $champion)
    {
        abort_if(Gate::denies('champion_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden'); 

        $languages = Language::get()->map(function($language) use ($champion) {
            $language->value = data_get($champion->languages->firstWhere('id', $language->id), 'pivot.rate') ?? null;
            return $language;
        });

        $champion->load('languages');

        return view('admin.champions.edit', compact('languages', 'champion'));
    }

    public function update(UpdateChampionRequest $request, Champion $champion)
    {
        $champion->update($request->all());
        $champion->languages()->sync($this->mapallang($request['languages']));
        if ($request->input('photo', false)) {
            if (!$champion->photo || $request->input('photo') !== $champion->photo->file_name) {
                if ($champion->photo) {
                    $champion->photo->delete();
                }
                $champion->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
            }
        } elseif ($champion->photo) {
            $champion->photo->delete();
        }

        if (count($champion->tournament_photo) > 0) {
            foreach ($champion->tournament_photo as $media) {
                if (!in_array($media->file_name, $request->input('tournament_photo', []))) {
                    $media->delete();
                }
            }
        }
        $media = $champion->tournament_photo->pluck('file_name')->toArray();
        foreach ($request->input('tournament_photo', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $champion->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('tournament_photo');
            }
        }

        if (count($champion->tournament_videos) > 0) {
            foreach ($champion->tournament_videos as $media) {
                if (!in_array($media->file_name, $request->input('tournament_videos', []))) {
                    $media->delete();
                }
            }
        }
        $media = $champion->tournament_videos->pluck('file_name')->toArray();
        foreach ($request->input('tournament_videos', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $champion->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('tournament_videos');
            }
        }

        return redirect()->route('admin.champions.index');
    }

    public function show(Champion $champion)
    {
        abort_if(Gate::denies('champion_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $champion->load('languages');

        return view('admin.champions.show', compact('champion'));
    }

    public function destroy(Champion $champion)
    {
        abort_if(Gate::denies('champion_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $champion->delete();

        return back();
    }

    public function massDestroy(MassDestroyChampionRequest $request)
    {
        Champion::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('champion_create') && Gate::denies('champion_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Champion();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }

    private function mapallang($languages)
    {
        return collect($languages)->map(function ($i) {
            return ['rate' => $i];
        });
    }
}
