@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.medicalOpinion.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.medical-opinions.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.medicalOpinion.fields.id') }}
                        </th>
                        <td>
                            {{ $medicalOpinion->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.medicalOpinion.fields.doctor') }}
                        </th>
                        <td>
                            {{ $medicalOpinion->doctor->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.medicalOpinion.fields.photo') }}
                        </th>
                        <td>
                            @if($medicalOpinion->photo)
                                <a href="{{ $medicalOpinion->photo->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $medicalOpinion->photo->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.medicalOpinion.fields.opinion') }}
                        </th>
                        <td>
                            {{ $medicalOpinion->opinion }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.medical-opinions.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection