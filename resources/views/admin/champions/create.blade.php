@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.champion.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.champions.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.champion.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.champion.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="age">{{ trans('cruds.champion.fields.age') }}</label>
                <input class="form-control {{ $errors->has('age') ? 'is-invalid' : '' }}" type="number" name="age" id="age" value="{{ old('age', '') }}" step="1" required>
                @if($errors->has('age'))
                    <div class="invalid-feedback">
                        {{ $errors->first('age') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.champion.fields.age_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="photo">{{ trans('cruds.champion.fields.photo') }}</label>
                <div class="needsclick dropzone {{ $errors->has('photo') ? 'is-invalid' : '' }}" id="photo-dropzone">
                </div>
                @if($errors->has('photo'))
                    <div class="invalid-feedback">
                        {{ $errors->first('photo') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.champion.fields.photo_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="brief">{{ trans('cruds.champion.fields.brief') }}</label>
                <textarea class="form-control {{ $errors->has('brief') ? 'is-invalid' : '' }}" name="brief" id="brief" required>{{ old('brief') }}</textarea>
                @if($errors->has('brief'))
                    <div class="invalid-feedback">
                        {{ $errors->first('brief') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.champion.fields.brief_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="languages">{{ trans('cruds.champion.fields.language') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('languages') ? 'is-invalid' : '' }}" name="languages[]" id="languages" multiple>
                    @foreach($languages as $id => $language)
                        <option value="{{ $id }}" {{ in_array($id, old('languages', [])) ? 'selected' : '' }}>{{ $language }}</option>
                    @endforeach
                </select>
                @if($errors->has('languages'))
                    <div class="invalid-feedback">
                        {{ $errors->first('languages') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.champion.fields.language_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.champion.fields.degree') }}</label>
                <select class="form-control {{ $errors->has('degree') ? 'is-invalid' : '' }}" name="degree" id="degree" required>
                    <option value disabled {{ old('degree', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Champion::DEGREE_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('degree', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('degree'))
                    <div class="invalid-feedback">
                        {{ $errors->first('degree') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.champion.fields.degree_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="other_skills">{{ trans('cruds.champion.fields.other_skills') }}</label>
                <input class="form-control {{ $errors->has('other_skills') ? 'is-invalid' : '' }}" type="text" name="other_skills" id="other_skills" value="{{ old('other_skills', '') }}">
                @if($errors->has('other_skills'))
                    <div class="invalid-feedback">
                        {{ $errors->first('other_skills') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.champion.fields.other_skills_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="tournament_photo">{{ trans('cruds.champion.fields.tournament_photo') }}</label>
                <div class="needsclick dropzone {{ $errors->has('tournament_photo') ? 'is-invalid' : '' }}" id="tournament_photo-dropzone">
                </div>
                @if($errors->has('tournament_photo'))
                    <div class="invalid-feedback">
                        {{ $errors->first('tournament_photo') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.champion.fields.tournament_photo_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="tournament_videos">{{ trans('cruds.champion.fields.tournament_videos') }}</label>
                <div class="needsclick dropzone {{ $errors->has('tournament_videos') ? 'is-invalid' : '' }}" id="tournament_videos-dropzone">
                </div>
                @if($errors->has('tournament_videos'))
                    <div class="invalid-feedback">
                        {{ $errors->first('tournament_videos') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.champion.fields.tournament_videos_helper') }}</span>
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
    url: '{{ route('admin.champions.storeMedia') }}',
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
@if(isset($champion) && $champion->photo)
      var file = {!! json_encode($champion->photo) !!}
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
<script>
    var uploadedTournamentPhotoMap = {}
Dropzone.options.tournamentPhotoDropzone = {
    url: '{{ route('admin.champions.storeMedia') }}',
    maxFilesize: 4, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 4,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="tournament_photo[]" value="' + response.name + '">')
      uploadedTournamentPhotoMap[file.name] = response.name
    },
    removedfile: function (file) {
      console.log(file)
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedTournamentPhotoMap[file.name]
      }
      $('form').find('input[name="tournament_photo[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($champion) && $champion->tournament_photo)
      var files = {!! json_encode($champion->tournament_photo) !!}
          for (var i in files) {
          var file = files[i]
          this.options.addedfile.call(this, file)
          this.options.thumbnail.call(this, file, file.preview)
          file.previewElement.classList.add('dz-complete')
          $('form').append('<input type="hidden" name="tournament_photo[]" value="' + file.file_name + '">')
        }
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
<script>
    var uploadedTournamentVideosMap = {}
Dropzone.options.tournamentVideosDropzone = {
    url: '{{ route('admin.champions.storeMedia') }}',
    maxFilesize: 50, // MB
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 50
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="tournament_videos[]" value="' + response.name + '">')
      uploadedTournamentVideosMap[file.name] = response.name
    },
    removedfile: function (file) {
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedTournamentVideosMap[file.name]
      }
      $('form').find('input[name="tournament_videos[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($champion) && $champion->tournament_videos)
          var files =
            {!! json_encode($champion->tournament_videos) !!}
              for (var i in files) {
              var file = files[i]
              this.options.addedfile.call(this, file)
              file.previewElement.classList.add('dz-complete')
              $('form').append('<input type="hidden" name="tournament_videos[]" value="' + file.file_name + '">')
            }
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