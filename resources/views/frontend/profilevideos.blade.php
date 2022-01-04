@extends('layouts.frontend')

@section('content')

    <div class="container">
        <div class="main-body">
            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb" class="main-breadcrumb" style="background-color: #2eb67d; color: #fff">
                <ol class="breadcrumb" style="background-color: #2eb67d">
                    <li class="breadcrumb-item">
                        <a href="index.html">أهلا بك يا : اسم المستخدم</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="javascript:void(0)"><i class="fas fa-table"></i> 24-09-2021</a>
                    </li>
                </ol>
            </nav>
            <!-- /Breadcrumb -->

            <div class="row gutters-sm">
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-body text-right">
                            <div class="d-flex flex-column align-items-center text-center">
                                @php
                                if($user->photo)
                             
                                    $img=$user->photo->getUrl('thumb');
                                else
                                $img="";
                            
                            @endphp
                                <img src="{{$img}}" alt="{{Auth::user()->name }}"
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
                                        <i class="fas fa-address-book"></i> الفيدوهات
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
                                أضافة فيديو
                            </button>

                            <!-- Modal -->
                            <div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">
                                                أضافة فيديو
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="POST" action="{{ route("videos-participates.store") }}" enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" name="user_id" value="{{ Auth::id() }}" id="">
                                                <input type="hidden" name="status" value="pending">
                                                <div class="row"> 
                                                    <div class="form-group col-md-4">
                                                        <label class="required" for="title">{{ trans('cruds.videosParticipate.fields.title') }}</label>
                                                        <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', '') }}" required>
                                                        @if($errors->has('title'))
                                                            <div class="invalid-feedback">
                                                                {{ $errors->first('title') }}
                                                            </div>
                                                        @endif
                                                        <span class="help-block">{{ trans('cruds.videosParticipate.fields.title_helper') }}</span>
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label for="description">{{ trans('cruds.videosParticipate.fields.description') }}</label>
                                                        <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description">{{ old('description') }}</textarea>
                                                        @if($errors->has('description'))
                                                            <div class="invalid-feedback">
                                                                {{ $errors->first('description') }}
                                                            </div>
                                                        @endif
                                                        <span class="help-block">{{ trans('cruds.videosParticipate.fields.description_helper') }}</span>
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label class="required">{{ trans('cruds.videosParticipate.fields.type') }}</label>
                                                        <select class="form-control {{ $errors->has('type') ? 'is-invalid' : '' }}" name="type" id="type" required onchange="change_type()">
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
                                                    <div class="form-group col-md-12" id="video_dropzone_block">
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
                                                    <div class="form-group col-md-12" style="display: none" id="embed_code_block">
                                                        <label for="embed_code">{{ trans('cruds.videosParticipate.fields.embed_code') }}</label>
                                                        <textarea class="form-control {{ $errors->has('embed_code') ? 'is-invalid' : '' }}" name="embed_code" id="embed_code">{{ old('embed_code') }}</textarea>
                                                        @if($errors->has('embed_code'))
                                                            <div class="invalid-feedback">
                                                                {{ $errors->first('embed_code') }}
                                                            </div>
                                                        @endif
                                                        <span class="help-block">{{ trans('cruds.videosParticipate.fields.embed_code_helper') }}</span>
                                                    </div>
                                                    <div class="form-group col-md-6">
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
                                                    <div class="form-group col-md-6">
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
                            @foreach ($video_participates as $video)
                                <div class="profile-video">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="video-container">
                                                @if ($video->type == 'upload_video')
                                                    <video style="width:100%" controls>
                                                        @if ($video->video)
                                                            <source src="{{ $video->video->getUrl() }}" type="video/mp4">
                                                        @endif
                                                    </video>
                                                @elseif($video->type == 'youtube')
                                                    <?php echo $video->embed_code; ?>
                                                @endif
                                            </div>
                                            <br>
                                            @if ($video->status == 'accepted')
                                                <span class="badge badge-success">تم القبول</span>
                                            @elseif($video->status == 'refused')
                                                <span class="badge badge-danger">تم الرفض</span>
                                            @elseif($video->status == 'pending')
                                                <span class="badge badge-warning">قيد الأنتظار</span>
                                            @endif
                                        </div>

                                        <div class="col-md-8">
                                            <div class="desc">
                                                <p>
                                                    {{ $video->title }}
                                                    <br>
                                                    <?php echo nl2br($video->description ?? ''); ?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <button class="btn btn-info" onclick="editVideo('{{ $video->id }}')"><i
                                                class="fas fa-pen"></i>
                                            تعديل</button>
                                        <form action="{{ route('videos-participates.destroy', $video->id) }}"
                                            method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');"
                                            style="display: inline-block;">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <button type="submit" class="btn btn-danger"> <i class='fas fa-trash-alt'></i>
                                                {{ trans('global.delete') }}</button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div> {{ $video_participates->links() }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade bd-example-modal-lg" id="editVideo" tabindex="-1" role="dialog" aria-labelledby="editVideoLabel" aria-hidden="true">
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
        function change_type(){
            let type =  $('#type').val();
            if(type == 'youtube'){
                $('#embed_code_block').css('display','block');
                $('#video_dropzone_block').css('display','none');
            }else{
                $('#embed_code_block').css('display','none');
                $('#video_dropzone_block').css('display','block');
            }
        }

        function editVideo(id){ 
            $.ajax({
                url:'{{ route('videos-participates.edit') }}',
                method:'POST',
                data:{_token: '{{ csrf_token() }}', 'id':id},
                success:function(data){ 
                    $('#editVideo').modal('show');
                    $('#editVideo .modal-body').html(null); 
                    $('#editVideo .modal-body').html(data); 
                }, 
            })
        }
    </script> 
    <script>
        Dropzone.options.videoDropzone = {
            url: '{{ route('frontend.videos-participates.storeMedia') }}',
            maxFilesize: 15, // MB
            maxFiles: 1,
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            params: {
                size: 15
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
@endsection
