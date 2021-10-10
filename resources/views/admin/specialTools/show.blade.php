@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.specialTool.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.special-tools.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.specialTool.fields.id') }}
                        </th>
                        <td>
                            {{ $specialTool->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.specialTool.fields.name') }}
                        </th>
                        <td>
                            {{ $specialTool->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.specialTool.fields.photo') }}
                        </th>
                        <td>
                            @if($specialTool->photo)
                                <a href="{{ $specialTool->photo->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $specialTool->photo->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.specialTool.fields.description') }}
                        </th>
                        <td>
                            {{ $specialTool->description }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.special-tools.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection