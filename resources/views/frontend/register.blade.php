@extends('layouts.frontend')

@section('content')
       <div class="page_content" style="margin-top: 50px;">
<div class="container">
     <div class="row">
    <div class="col-md-2"></div>
         
         <div class="col-md-8">

<div class="have_problem">
     <form action="{{ route('frontend.register_save') }}" method="Post">
                               @csrf
         <div class="form-group text-right">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>البريد الإلكتروني </label>
                                        <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"type="text" name="email">
                                        @if($errors->has('email'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('email') }}
                                        </div>
                                    @endif
                                    </div>
                                    <div class="col-md-6">
                                        <label>كلمة المرور </label>
                                        <input class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"type="password" name="password">
                                        @if($errors->has('password'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('password') }}
                                        </div>
                                    @endif
                                    </div>
                                </div>
                            </div>


                            <div class="form-group text-right">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>الاسم بالكامل </label>
                                        <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name">
                                        @if($errors->has('name'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('name') }}
                                        </div>
                                    @endif
                                    </div>
                                    <div class="col-md-6">
                                        <label> رقم الهاتف </label>
                                        <input class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" type="text" name="phone">
                                        @if($errors->has('phone'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('phone') }}
                                        </div>
                                    @endif
                                    </div>
                                </div>
                            </div>
                              <div class="form-group text-right">
             <div class="row">
                 <div class="col-md-6">
                    <label for="photo">الصورة الشخصية</label>
                    <div class="needsclick dropzone {{ $errors->has('photo') ? 'is-invalid' : '' }}" id="photo-dropzone">
                    </div>
                    @if($errors->has('photo'))
                        <div class="invalid-feedback">
                            {{ $errors->first('photo') }}
                        </div>
                    @endif
                    <span class="help-block"></span>
				
             </div>
                 <div class="col-md-6">
             <label>   </label>
		
             </div>
         </div></div>
                            <div class="form-group text-right">
             <div class="row">
                 <div class="col-md-6">
             <label>   </label>
				
             </div>
                 <div class="col-md-6">
             <label>   </label>
		
             </div>
         </div></div>
         
 
                        <button  type= "submit"class="btn-primary"> <a> تسجيل  </a> </button>
				  </form>
    
    </div>
             
             </div>
         
         
<div class="col-md-2"></div>    </div>
    </div>
    </div>
        
   
        
  

@endsection
@section('scripts')
<script>
    Dropzone.options.photoDropzone = {
    url: '{{ route('frontend.storeMedia') }}',
    maxFilesize: 4, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
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
@if(isset($user) && $user->photo)
      var file = {!! json_encode($user->photo) !!}
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