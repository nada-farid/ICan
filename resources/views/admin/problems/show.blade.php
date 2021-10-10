@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.problem.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.problems.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.problem.fields.id') }}
                        </th>
                        <td>
                            {{ $problem->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.problem.fields.title') }}
                        </th>
                        <td>
                            {{ $problem->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.problem.fields.email') }}
                        </th>
                        <td>
                            {{ $problem->email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.problem.fields.phone') }}
                        </th>
                        <td>
                            {{ $problem->phone }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.problem.fields.description') }}
                        </th>
                        <td>
                            {{ $problem->description }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.problems.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection