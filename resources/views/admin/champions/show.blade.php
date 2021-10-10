@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.champion.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.champions.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.champion.fields.id') }}
                        </th>
                        <td>
                            {{ $champion->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.champion.fields.name') }}
                        </th>
                        <td>
                            {{ $champion->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.champion.fields.age') }}
                        </th>
                        <td>
                            {{ $champion->age }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.champion.fields.photo') }}
                        </th>
                        <td>
                            @if($champion->photo)
                                <a href="{{ $champion->photo->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $champion->photo->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.champion.fields.brief') }}
                        </th>
                        <td>
                            {{ $champion->brief }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.champion.fields.language') }}
                        </th>
                        <td>
                            @foreach($champion->languages as $key => $language)
                                <span class="label label-info">{{ $language->language }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.champion.fields.degree') }}
                        </th>
                        <td>
                            {{ App\Models\Champion::DEGREE_SELECT[$champion->degree] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.champion.fields.other_skills') }}
                        </th>
                        <td>
                            {{ $champion->other_skills }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.champion.fields.tournament_photo') }}
                        </th>
                        <td>
                            @foreach($champion->tournament_photo as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $media->getUrl('thumb') }}">
                                </a>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.champion.fields.tournament_videos') }}
                        </th>
                        <td>
                            @foreach($champion->tournament_videos as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.champions.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection