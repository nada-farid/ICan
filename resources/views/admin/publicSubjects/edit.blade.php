@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.publicSubject.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.public-subjects.update", [$publicSubject->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="subject_category_id">{{ trans('cruds.publicSubject.fields.subject_category') }}</label>
                <select class="form-control select2 {{ $errors->has('subject_category') ? 'is-invalid' : '' }}" name="subject_category_id" id="subject_category_id" required>
                    @foreach($subject_categories as $id => $entry)
                        <option value="{{ $id }}" {{ (old('subject_category_id') ? old('subject_category_id') : $publicSubject->subject_category->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('subject_category'))
                    <div class="invalid-feedback">
                        {{ $errors->first('subject_category') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.publicSubject.fields.subject_category_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="title">{{ trans('cruds.publicSubject.fields.title') }}</label>
                <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', $publicSubject->title) }}" required>
                @if($errors->has('title'))
                    <div class="invalid-feedback">
                        {{ $errors->first('title') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.publicSubject.fields.title_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="writer_name">{{ trans('cruds.publicSubject.fields.writer_name') }}</label>
                <input class="form-control {{ $errors->has('writer_name') ? 'is-invalid' : '' }}" type="text" name="writer_name" id="writer_name" value="{{ old('writer_name', $publicSubject->writer_name) }}" required>
                @if($errors->has('writer_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('writer_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.publicSubject.fields.writer_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="description">{{ trans('cruds.publicSubject.fields.description') }}</label>
                <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description" required>{{ old('description', $publicSubject->description) }}</textarea>
                @if($errors->has('description'))
                    <div class="invalid-feedback">
                        {{ $errors->first('description') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.publicSubject.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="photo">{{ trans('cruds.publicSubject.fields.photo') }}</label>
                <div class="needsclick dropzone {{ $errors->has('photo') ? 'is-invalid' : '' }}" id="photo-dropzone">
                </div>
                @if($errors->has('photo'))
                    <div class="invalid-feedback">
                        {{ $errors->first('photo') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.publicSubject.fields.photo_helper') }}</span>
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
    Dropzone.options.photoDropzone = {
    url: '{{ route('admin.public-subjects.storeMedia') }}',
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').find('input[name="photo"]').remove()
      $('form').append('<input type="hidden" name="photo" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="photo"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($publicSubject) && $publicSubject->photo)
      var file = {!! json_encode($publicSubject->photo) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="photo" value="' + file.file_name + '">')
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