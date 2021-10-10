@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.practicalSolution.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.practical-solutions.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.practicalSolution.fields.id') }}
                        </th>
                        <td>
                            {{ $practicalSolution->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.practicalSolution.fields.title') }}
                        </th>
                        <td>
                            {{ $practicalSolution->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.practicalSolution.fields.description') }}
                        </th>
                        <td>
                            {{ $practicalSolution->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.practicalSolution.fields.photo') }}
                        </th>
                        <td>
                            @if($practicalSolution->photo)
                                <a href="{{ $practicalSolution->photo->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $practicalSolution->photo->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.practicalSolution.fields.video') }}
                        </th>
                        <td>
                            @if($practicalSolution->video)
                                <a href="{{ $practicalSolution->video->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.practicalSolution.fields.photos') }}
                        </th>
                        <td>
                            @foreach($practicalSolution->photos as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $media->getUrl('thumb') }}">
                                </a>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.practical-solutions.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection