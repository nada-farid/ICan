@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.subjectsCategory.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.subjects-categories.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.subjectsCategory.fields.id') }}
                        </th>
                        <td>
                            {{ $subjectsCategory->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.subjectsCategory.fields.name') }}
                        </th>
                        <td>
                            {{ $subjectsCategory->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.subjectsCategory.fields.description') }}
                        </th>
                        <td>
                            {{ $subjectsCategory->description }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.subjects-categories.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#subject_category_public_subjects" role="tab" data-toggle="tab">
                {{ trans('cruds.publicSubject.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="subject_category_public_subjects">
            @includeIf('admin.subjectsCategories.relationships.subjectCategoryPublicSubjects', ['publicSubjects' => $subjectsCategory->subjectCategoryPublicSubjects])
        </div>
    </div>
</div>

@endsection