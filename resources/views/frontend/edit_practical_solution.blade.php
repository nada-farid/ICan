
    <div class="card">
        <div class="card-header">
            {{ trans('global.edit') }} {{ trans('cruds.practicalSolution.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('practical-solutions.update', [$practicalSolution->id]) }}"
                enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="row">
                    <div class="form-group col-md-4">
                        <label class="required" for="title">{{ trans('cruds.practicalSolution.fields.title') }}</label>
                        <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title"
                            id="title" value="{{ old('title', $practicalSolution->title) }}" required>
                        @if ($errors->has('title'))
                            <div class="invalid-feedback">
                                {{ $errors->first('title') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.practicalSolution.fields.title_helper') }}</span>
                    </div>
                    <div class="form-group col-md-8">
                        <label class="required"
                            for="description">{{ trans('cruds.practicalSolution.fields.description') }}</label>
                        <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}"
                            name="description" id="description"
                            required>{{ old('description', $practicalSolution->description) }}</textarea>
                        @if ($errors->has('description'))
                            <div class="invalid-feedback">
                                {{ $errors->first('description') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.practicalSolution.fields.description_helper') }}</span>
                    </div> 
                    <div class="form-group col-md-4">
                        <label class="required" for="photo">{{ trans('cruds.practicalSolution.fields.photo') }}</label>
                        <div class="needsclick dropzone {{ $errors->has('photo') ? 'is-invalid' : '' }}" id="edit-photo-dropzone">
                        </div>
                        @if ($errors->has('photo'))
                            <div class="invalid-feedback">
                                {{ $errors->first('photo') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.practicalSolution.fields.photo_helper') }}</span>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="video">{{ trans('cruds.practicalSolution.fields.video') }}</label>
                        <div class="needsclick dropzone {{ $errors->has('video') ? 'is-invalid' : '' }}" id="edit-video-dropzone">
                        </div>
                        @if ($errors->has('video'))
                            <div class="invalid-feedback">
                                {{ $errors->first('video') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.practicalSolution.fields.video_helper') }}</span>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="photos">{{ trans('cruds.practicalSolution.fields.photos') }}</label>
                        <div class="needsclick dropzone {{ $errors->has('photos') ? 'is-invalid' : '' }}"
                            id="edit-photos-dropzone">
                        </div>
                        @if ($errors->has('photos'))
                            <div class="invalid-feedback">
                                {{ $errors->first('photos') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.practicalSolution.fields.photos_helper') }}</span>
                    </div> 
                </div>
                <div class="form-group">
                    <button class="btn btn-danger" type="submit">
                        {{ trans('global.save') }}
                    </button>
                </div>
            </form>
        </div>
    </div>


    <script>
        $("#edit-photo-dropzone").dropzone({
            url: '{{ route('frontend.practical-solutions.storeMedia') }}',
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
            success: function(file, response) {
                $('form').find('input[name="photo"]').remove()
                $('form').append('<input type="hidden" name="photo" value="' + response.name + '">')
            },
            removedfile: function(file) {
                file.previewElement.remove()
                if (file.status !== 'error') {
                    $('form').find('input[name="photo"]').remove()
                    this.options.maxFiles = this.options.maxFiles + 1
                }
            },
            init: function() {
                @if (isset($practicalSolution) && $practicalSolution->photo)
                    var file = {!! json_encode($practicalSolution->photo) !!}
                    this.options.addedfile.call(this, file)
                    this.options.thumbnail.call(this, file, file.preview)
                    file.previewElement.classList.add('dz-complete')
                    $('form').append('<input type="hidden" name="photo" value="' + file.file_name + '">')
                    this.options.maxFiles = this.options.maxFiles - 1
                @endif
            },
            error: function(file, response) {
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
        })
    </script>
    <script>
        $("#edit-video-dropzone").dropzone({
            url: '{{ route('frontend.practical-solutions.storeMedia') }}',
            maxFilesize: 40, // MB
            maxFiles: 1,
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            params: {
                size: 40
            },
            success: function(file, response) {
                $('form').find('input[name="video"]').remove()
                $('form').append('<input type="hidden" name="video" value="' + response.name + '">')
            },
            removedfile: function(file) {
                file.previewElement.remove()
                if (file.status !== 'error') {
                    $('form').find('input[name="video"]').remove()
                    this.options.maxFiles = this.options.maxFiles + 1
                }
            },
            init: function() {
                @if (isset($practicalSolution) && $practicalSolution->video)
                    var file = {!! json_encode($practicalSolution->video) !!}
                    this.options.addedfile.call(this, file)
                    file.previewElement.classList.add('dz-complete')
                    $('form').append('<input type="hidden" name="video" value="' + file.file_name + '">')
                    this.options.maxFiles = this.options.maxFiles - 1
                @endif
            },
            error: function(file, response) {
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
        })
    </script>
    <script>
        var uploadedPhotosMap = {}
        $("#edit-photos-dropzone").dropzone({
            url: '{{ route('frontend.practical-solutions.storeMedia') }}',
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
            success: function(file, response) {
                $('form').append('<input type="hidden" name="photos[]" value="' + response.name + '">')
                uploadedPhotosMap[file.name] = response.name
            },
            removedfile: function(file) {
                console.log(file)
                file.previewElement.remove()
                var name = ''
                if (typeof file.file_name !== 'undefined') {
                    name = file.file_name
                } else {
                    name = uploadedPhotosMap[file.name]
                }
                $('form').find('input[name="photos[]"][value="' + name + '"]').remove()
            },
            init: function() {
                @if (isset($practicalSolution) && $practicalSolution->photos)
                    var files = {!! json_encode($practicalSolution->photos) !!}
                    for (var i in files) {
                    var file = files[i]
                    this.options.addedfile.call(this, file)
                    this.options.thumbnail.call(this, file, file.preview)
                    file.previewElement.classList.add('dz-complete')
                    $('form').append('<input type="hidden" name="photos[]" value="' + file.file_name + '">')
                    }
                @endif
            },
            error: function(file, response) {
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
        })
    </script>  