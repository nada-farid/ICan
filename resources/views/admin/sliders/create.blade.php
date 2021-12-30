@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.videosParticipate.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.videos-participates.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="title">{{ trans('cruds.videosParticipate.fields.title') }}</label>
                <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', '') }}" required>
                @if($errors->has('title'))
                    <div class="invalid-feedback">
                        {{ $errors->first('title') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.videosParticipate.fields.title_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.videosParticipate.fields.description') }}</label>
                <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description">{{ old('description') }}</textarea>
                @if($errors->has('description'))
                    <div class="invalid-feedback">
                        {{ $errors->first('description') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.videosParticipate.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.videosParticipate.fields.type') }}</label>
                <select class="form-control {{ $errors->has('type') ? 'is-invalid' : '' }}" name="type" id="type" required>
                    <option value disabled {{ old('type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\VideosParticipate::TYPE_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('type', 'upload_video') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('type'))
                    <div class="invalid-feedback">
                        {{ $errors->first('type') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.videosParticipate.fields.type_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="video">{{ trans('cruds.videosParticipate.fields.video') }}</label>
                <div class="needsclick dropzone {{ $errors->has('video') ? 'is-invalid' : '' }}" id="video-dropzone">
                </div>
                @if($errors->has('video'))
                    <div class="invalid-feedback">
                        {{ $errors->first('video') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.videosParticipate.fields.video_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="embed_code">{{ trans('cruds.videosParticipate.fields.embed_code') }}</label>
                <textarea class="form-control {{ $errors->has('embed_code') ? 'is-invalid' : '' }}" name="embed_code" id="embed_code">{{ old('embed_code') }}</textarea>
                @if($errors->has('embed_code'))
                    <div class="invalid-feedback">
                        {{ $errors->first('embed_code') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.videosParticipate.fields.embed_code_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="practical_solution_id">{{ trans('cruds.videosParticipate.fields.practical_solution') }}</label>
                <select class="form-control select2 {{ $errors->has('practical_solution') ? 'is-invalid' : '' }}" name="practical_solution_id" id="practical_solution_id">
                    @foreach($practical_solutions as $id => $entry)
                        <option value="{{ $id }}" {{ old('practical_solution_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('practical_solution'))
                    <div class="invalid-feedback">
                        {{ $errors->first('practical_solution') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.videosParticipate.fields.practical_solution_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="champion_id">{{ trans('cruds.videosParticipate.fields.champion') }}</label>
                <select class="form-control select2 {{ $errors->has('champion') ? 'is-invalid' : '' }}" name="champion_id" id="champion_id">
                    @foreach($champions as $id => $entry)
                        <option value="{{ $id }}" {{ old('champion_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('champion'))
                    <div class="invalid-feedback">
                        {{ $errors->first('champion') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.videosParticipate.fields.champion_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection

@section('scripts')
<script>
    Dropzone.options.videoDropzone = {
    url: '{{ route('admin.videos-participates.storeMedia') }}',
    maxFilesize: 15, // MB
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 15
    },
    success: function (file, response) {
      $('form').find('input[name="video"]').remove()
      $('form').append('<input type="hidden" name="video" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="video"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($videosParticipate) && $videosParticipate->video)
      var file = {!! json_encode($videosParticipate->video) !!}
          this.options.addedfile.call(this, file)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="video" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
     error: function (file, response) {
         if ($.type(response) === 'string') {
             var message = response //dropzone sends it's own error messages in string
         } else {
             var message = response.errors.file
         }
         file.previewElement.classList.add('dz-error')
         _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
         _results = []
         for (_i = 0, _len = _ref.length; _i < _len; _i++) {
             node = _ref[_i]
             _results.push(node.textContent = message)
         }

         return _results
     }
}
</script>
@endsection