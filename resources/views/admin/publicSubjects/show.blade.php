@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.publicSubject.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.public-subjects.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.publicSubject.fields.id') }}
                        </th>
                        <td>
                            {{ $publicSubject->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.publicSubject.fields.subject_category') }}
                        </th>
                        <td>
                            {{ $publicSubject->subject_category->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.publicSubject.fields.title') }}
                        </th>
                        <td>
                            {{ $publicSubject->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.publicSubject.fields.writer_name') }}
                        </th>
                        <td>
                            {{ $publicSubject->writer_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.publicSubject.fields.description') }}
                        </th>
                        <td>
                            {{ $publicSubject->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.publicSubject.fields.photo') }}
                        </th>
                        <td>
                            @if($publicSubject->photo)
                                <a href="{{ $publicSubject->photo->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $publicSubject->photo->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.publicSubject.fields.views') }}
                        </th>
                        <td>
                            {{ $publicSubject->views }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.public-subjects.index') }}">
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
            <a class="nav-link" href="#post_comments" role="tab" data-toggle="tab">
                {{ trans('cruds.comment.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="post_comments">
            @includeIf('admin.publicSubjects.relationships.postComments', ['comments' => $publicSubject->postComments])
        </div>
    </div>
</div>

@endsection