@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.aboutUs.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.aboutuses.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="phote">{{ trans('cruds.aboutUs.fields.phote') }}</label>
                <div class="needsclick dropzone {{ $errors->has('phote') ? 'is-invalid' : '' }}" id="phote-dropzone">
                </div>
                @if($errors->has('phote'))
                    <div class="invalid-feedback">
                        {{ $errors->first('phote') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.aboutUs.fields.phote_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="description">{{ trans('cruds.aboutUs.fields.description') }}</label>
                <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description" required>{{ old('description') }}</textarea>
                @if($errors->has('description'))
                    <div class="invalid-feedback">
                        {{ $errors->first('description') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.aboutUs.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="vision">{{ trans('cruds.aboutUs.fields.vision') }}</label>
                <textarea class="form-control {{ $errors->has('vision') ? 'is-invalid' : '' }}" name="vision" id="vision" required>{{ old('vision') }}</textarea>
                @if($errors->has('vision'))
                    <div class="invalid-feedback">
                        {{ $errors->first('vision') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.aboutUs.fields.vision_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="message">{{ trans('cruds.aboutUs.fields.message') }}</label>
                <textarea class="form-control {{ $errors->has('message') ? 'is-invalid' : '' }}" name="message" id="message" required>{{ old('message') }}</textarea>
                @if($errors->has('message'))
                    <div class="invalid-feedback">
                        {{ $errors->first('message') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.aboutUs.fields.message_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="goals">{{ trans('cruds.aboutUs.fields.goals') }}</label>
                <textarea class="form-control {{ $errors->has('goals') ? 'is-invalid' : '' }}" name="goals" id="goals" required>{{ old('goals') }}</textarea>
                @if($errors->has('goals'))
                    <div class="invalid-feedback">
                        {{ $errors->first('goals') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.aboutUs.fields.goals_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="email">{{ trans('cruds.aboutUs.fields.email') }}</label>
                <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="text" name="email" id="email" value="{{ old('email', '') }}" required>
                @if($errors->has('email'))
                    <div class="invalid-feedback">
                        {{ $errors->first('email') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.aboutUs.fields.email_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="phone_1">{{ trans('cruds.aboutUs.fields.phone_1') }}</label>
                <input class="form-control {{ $errors->has('phone_1') ? 'is-invalid' : '' }}" type="text" name="phone_1" id="phone_1" value="{{ old('phone_1', '') }}" required>
                @if($errors->has('phone_1'))
                    <div class="invalid-feedback">
                        {{ $errors->first('phone_1') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.aboutUs.fields.phone_1_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="phone_2">{{ trans('cruds.aboutUs.fields.phone_2') }}</label>
                <input class="form-control {{ $errors->has('phone_2') ? 'is-invalid' : '' }}" type="text" name="phone_2" id="phone_2" value="{{ old('phone_2', '') }}">
                @if($errors->has('phone_2'))
                    <div class="invalid-feedback">
                        {{ $errors->first('phone_2') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.aboutUs.fields.phone_2_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="address">{{ trans('cruds.aboutUs.fields.address') }}</label>
                <input class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" type="text" name="address" id="address" value="{{ old('address', '') }}" required>
                @if($errors->has('address'))
                    <div class="invalid-feedback">
                        {{ $errors->first('address') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.aboutUs.fields.address_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="time">{{ trans('cruds.aboutUs.fields.time') }}</label>
                <input class="form-control {{ $errors->has('time') ? 'is-invalid' : '' }}" type="text" name="time" id="time" value="{{ old('time', '') }}" required>
                @if($errors->has('time'))
                    <div class="invalid-feedback">
                        {{ $errors->first('time') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.aboutUs.fields.time_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="facebook">{{ trans('cruds.aboutUs.fields.facebook') }}</label>
                <input class="form-control {{ $errors->has('facebook') ? 'is-invalid' : '' }}" type="text" name="facebook" id="facebook" value="{{ old('facebook', '') }}">
                @if($errors->has('facebook'))
                    <div class="invalid-feedback">
                        {{ $errors->first('facebook') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.aboutUs.fields.facebook_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="twitter">{{ trans('cruds.aboutUs.fields.twitter') }}</label>
                <input class="form-control {{ $errors->has('twitter') ? 'is-invalid' : '' }}" type="text" name="twitter" id="twitter" value="{{ old('twitter', '') }}">
                @if($errors->has('twitter'))
                    <div class="invalid-feedback">
                        {{ $errors->first('twitter') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.aboutUs.fields.twitter_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="instegram">{{ trans('cruds.aboutUs.fields.instegram') }}</label>
                <input class="form-control {{ $errors->has('instegram') ? 'is-invalid' : '' }}" type="text" name="instegram" id="instegram" value="{{ old('instegram', '') }}">
                @if($errors->has('instegram'))
                    <div class="invalid-feedback">
                        {{ $errors->first('instegram') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.aboutUs.fields.instegram_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="youtube">{{ trans('cruds.aboutUs.fields.youtube') }}</label>
                <input class="form-control {{ $errors->has('youtube') ? 'is-invalid' : '' }}" type="text" name="youtube" id="youtube" value="{{ old('youtube', '') }}">
                @if($errors->has('youtube'))
                    <div class="invalid-feedback">
                        {{ $errors->first('youtube') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.aboutUs.fields.youtube_helper') }}</span>
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
    Dropzone.options.photeDropzone = {
    url: '{{ route('admin.aboutuses.storeMedia') }}',
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
      $('form').find('input[name="phote"]').remove()
      $('form').append('<input type="hidden" name="phote" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="phote"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($aboutUs) && $aboutUs->phote)
      var file = {!! json_encode($aboutUs->phote) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="phote" value="' + file.file_name + '">')
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