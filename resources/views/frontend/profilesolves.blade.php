@extends('layouts.frontend') 

@section('content')

    <div class="container">
        <div class="main-body">
            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb" class="main-breadcrumb" style="background-color: #2eb67d; color: #fff">
                <ol class="breadcrumb" style="background-color: #2eb67d">
                    <li class="breadcrumb-item">
                        <a href="index.html">أهلا بك يا {{ $user->name ?? '' }} </a>
                    </li>
                </ol>
            </nav>
            <!-- /Breadcrumb -->

            <div class="row gutters-sm">
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-body text-right">
                            @php
                            if($user->photo)
                         
                                $img=$user->photo->getUrl('thumb');
                            else
                            $img="";
                        
                        @endphp
                            <img src="{{$img}}"  alt="{{Auth::user()->name }}"
                                class="rounded-circle" width="150" />
                                <div class="mt-3">
                                    <h4> {{ $user->name ?? '' }} </h4>
                                    <p class="text-secondary mb-1">رقم العضوية : {{ $user->id ?? '' }}</p>

                                    <button class="btn btn-primary"
                                        onclick="event.preventDefault(); document.getElementById('logoutform').submit();">تسجيل
                                        الخروج</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mt-3">
                        <ul class="list-group list-group-flush">
                            <li class=" list-group-item d-flex ustify-content-between align-items-center flex-wrap ">
                                <h6 class="mb-0">
                                    <a href="{{ route('frontend.profile') }}">
                                        <i class="fas fa-user"></i> بياناتي الشخصية
                                    </a>
                                </h6>
                            </li>

                            <li class=" list-group-item d-flex ustify-content-between align-items-center flex-wrap ">
                                <h6 class="mb-0">
                                    <a href="{{ route('frontend.profile_solves') }}">
                                        <i class="fas fa-thumbs-up"></i> الحلول العملية 
                                    </a>
                                </h6>
                            </li>
                            <li class=" list-group-item d-flex justify-content-between align-items-center flex-wrap ">
                                <h6 class="mb-0">
                                    <a href="{{ route('frontend.profile_videos') }}">
                                        <i class="fas fa-address-book"></i>  الفيدوهات 
                                    </a>
                                </h6>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card mb-3">
                        <div class="card-header">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                أضافة حل عملي
                            </button>

                            <!-- Modal -->
                            <div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">أضافة حل عملي</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="POST" action="{{ route("practical-solutions.store") }}" enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" name="user_id" value="{{ Auth::id() }}" id="">
                                                <input type="hidden" name="status" value="pending">
                                                <div class="row">
                                                    <div class="form-group col-md-4">
                                                        <label class="required" for="title">{{ trans('cruds.practicalSolution.fields.title') }}</label>
                                                        <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', '') }}" required>
                                                        @if($errors->has('title'))
                                                            <div class="invalid-feedback">
                                                                {{ $errors->first('title') }}
                                                            </div>
                                                        @endif
                                                        <span class="help-block">{{ trans('cruds.practicalSolution.fields.title_helper') }}</span>
                                                    </div>
                                                    <div class="form-group col-md-8">
                                                        <label class="required" for="description">{{ trans('cruds.practicalSolution.fields.description') }}</label>
                                                        <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description" required>{{ old('description') }}</textarea>
                                                        @if($errors->has('description'))
                                                            <div class="invalid-feedback">
                                                                {{ $errors->first('description') }}
                                                            </div>
                                                        @endif
                                                        <span class="help-block">{{ trans('cruds.practicalSolution.fields.description_helper') }}</span>
                                                    </div>
                                                
                                                    <div class="form-group col-md-4">
                                                        <label class="required" for="photo">{{ trans('cruds.practicalSolution.fields.photo') }}</label>
                                                        <div class="needsclick dropzone {{ $errors->has('photo') ? 'is-invalid' : '' }}" id="photo-dropzone">
                                                        </div>
                                                        @if($errors->has('photo'))
                                                            <div class="invalid-feedback">
                                                                {{ $errors->first('photo') }}
                                                            </div>
                                                        @endif
                                                        <span class="help-block">{{ trans('cruds.practicalSolution.fields.photo_helper') }}</span>
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label for="video">{{ trans('cruds.practicalSolution.fields.video') }}</label>
                                                        <div class="needsclick dropzone {{ $errors->has('video') ? 'is-invalid' : '' }}" id="video-dropzone">
                                                        </div>
                                                        @if($errors->has('video'))
                                                            <div class="invalid-feedback">
                                                                {{ $errors->first('video') }}
                                                            </div>
                                                        @endif
                                                        <span class="help-block">{{ trans('cruds.practicalSolution.fields.video_helper') }}</span>
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label for="photos">{{ trans('cruds.practicalSolution.fields.photos') }}</label>
                                                        <div class="needsclick dropzone {{ $errors->has('photos') ? 'is-invalid' : '' }}" id="photos-dropzone">
                                                        </div>
                                                        @if($errors->has('photos'))
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
                                </div>
                            </div>
                        </div>
                        <div class="card-body"> 

                            @foreach($practical_solutions as $practicalSolution)
                                <div class="profile-video">
                                    <div class="row">
                                        <div class="col-md-4">
                                            @if($practicalSolution->photo) 
                                                <img src="{{ $practicalSolution->photo->getUrl() }}" class="img-fluid"> 
                                            @endif 
                                            <br>
                                            @if($practicalSolution->status == 'accepted')
                                                <span class="badge badge-success">تم القبول</span>
                                            @elseif($practicalSolution->status == 'refused')
                                                <span class="badge badge-danger">تم الرفض</span>
                                            @elseif($practicalSolution->status == 'pending')
                                                <span class="badge badge-warning">قيد الأنتظار</span>
                                            @endif
                                        </div>

                                        <div class="col-md-8">
                                            <div class="desc">
                                                <p>
                                                    {{ $practicalSolution->title }}
                                                    <br>
                                                    <?php echo nl2br($practicalSolution->description ?? ''); ?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <button class="btn btn-info"  onclick="editPracticalSolution('{{ $practicalSolution->id }}')"><i class="fas fa-pen"></i>
                                            تعديل</button> 
                                        <form action="{{ route('practical-solutions.destroy', $practicalSolution->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}"> 
                                            <button type="submit" class="btn btn-danger"> <i class='fas fa-trash-alt'></i> {{ trans('global.delete') }}</button>
                                        </form>
                                    </div>
                                </div> 
                                <hr>
                            @endforeach
                        </div>
                        <div> {{ $practical_solutions->links() }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <div class="modal fade bd-example-modal-lg" id="editPracticalSolution" tabindex="-1" role="dialog" aria-labelledby="editPracticalSolutionLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header"> 
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    
                </div> 
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        function editPracticalSolution(id){ 
            $.ajax({
                url:'{{ route('practical-solutions.edit') }}',
                method:'POST',
                data:{_token: '{{ csrf_token() }}', 'id':id},
                success:function(data){ 
                    $('#editPracticalSolution').modal('show');
                    $('#editPracticalSolution .modal-body').html(null); 
                    $('#editPracticalSolution .modal-body').html(data); 
                }, 
            })
        }
    </script>
    <script>
        Dropzone.options.photoDropzone = {
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
        }
    </script>
    <script>
        Dropzone.options.videoDropzone = {
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
        }
    </script>
    <script>
        var uploadedPhotosMap = {}
        Dropzone.options.photosDropzone = {
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
        }
    </script>
@endsection