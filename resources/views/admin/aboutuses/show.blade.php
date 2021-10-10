@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.aboutUs.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.aboutuses.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.aboutUs.fields.id') }}
                        </th>
                        <td>
                            {{ $aboutUs->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.aboutUs.fields.phote') }}
                        </th>
                        <td>
                            @if($aboutUs->phote)
                                <a href="{{ $aboutUs->phote->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $aboutUs->phote->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.aboutUs.fields.description') }}
                        </th>
                        <td>
                            {{ $aboutUs->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.aboutUs.fields.vision') }}
                        </th>
                        <td>
                            {{ $aboutUs->vision }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.aboutUs.fields.message') }}
                        </th>
                        <td>
                            {{ $aboutUs->message }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.aboutUs.fields.goals') }}
                        </th>
                        <td>
                            {{ $aboutUs->goals }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.aboutUs.fields.email') }}
                        </th>
                        <td>
                            {{ $aboutUs->email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.aboutUs.fields.phone_1') }}
                        </th>
                        <td>
                            {{ $aboutUs->phone_1 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.aboutUs.fields.phone_2') }}
                        </th>
                        <td>
                            {{ $aboutUs->phone_2 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.aboutUs.fields.address') }}
                        </th>
                        <td>
                            {{ $aboutUs->address }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.aboutUs.fields.time') }}
                        </th>
                        <td>
                            {{ $aboutUs->time }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.aboutUs.fields.facebook') }}
                        </th>
                        <td>
                            {{ $aboutUs->facebook }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.aboutUs.fields.twitter') }}
                        </th>
                        <td>
                            {{ $aboutUs->twitter }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.aboutUs.fields.instegram') }}
                        </th>
                        <td>
                            {{ $aboutUs->instegram }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.aboutUs.fields.youtube') }}
                        </th>
                        <td>
                            {{ $aboutUs->youtube }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.aboutuses.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection