@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.videosParticipate.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.videos-participates.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.videosParticipate.fields.id') }}
                        </th>
                        <td>
                            {{ $videosParticipate->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.videosParticipate.fields.title') }}
                        </th>
                        <td>
                            {{ $videosParticipate->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.videosParticipate.fields.description') }}
                        </th>
                        <td>
                            {{ $videosParticipate->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.videosParticipate.fields.type') }}
                        </th>
                        <td>
                            {{ App\Models\VideosParticipate::TYPE_SELECT[$videosParticipate->type] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.videosParticipate.fields.video') }}
                        </th>
                        <td>
                            @if($videosParticipate->video)
                                <a href="{{ $videosParticipate->video->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.videosParticipate.fields.embed_code') }}
                        </th>
                        <td>
                            {{ $videosParticipate->embed_code }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.videosParticipate.fields.practical_solution') }}
                        </th>
                        <td>
                            {{ $videosParticipate->practical_solution->title ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.videosParticipate.fields.champion') }}
                        </th>
                        <td>
                            {{ $videosParticipate->champion->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.videosParticipate.fields.status') }}
                        </th>
                        <td>
                            {{ App\Models\VideosParticipate::STATUS_SELECT[$videosParticipate->status] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.videos-participates.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection