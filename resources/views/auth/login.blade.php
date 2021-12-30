@extends('layouts.app')


@section('styles')
    
<link rel="stylesheet" href="{{ asset('frontend/fonts/stylesheet.css') }}" type="text/css" charset="utf-8" />

<link href="{{ asset('frontend/css/model.css') }}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="https://unpkg.com/@popperjs/core@2">
<link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/js/bootstrap.js') }}">
<link rel="stylesheet" href="{{ asset('frontend/fonts/stylesheet.css') }}">
<script src="https://kit.fontawesome.com/e0387e9a75.js"></script>
<link rel="stylesheet" href="{{ asset('frontend/css/main.css') }}">

@endsection
@section('content')


                @if(session('message'))
                    <div class="alert alert-info" role="alert">
                        {{ session('message') }}
                    </div>
                @endif
                <div class="card-body p-4">
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div >
                    <div class="modal-center">
                        <div class="modal-dialog .modal-align-center">
                            <div class="modal-content">
            
                                <div class="modal-body">
                                    <div class="loginmodal-container text-center">
                                        <i class="fas fa-lock"></i>
                                        <h1>دخول المستخدمين </h1>
                                      
                                            <input type="text" name="email" type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" required autocomplete="email" autofocus placeholder="{{ trans('global.login_email') }}" value="{{ old('email', null) }}" placeholder="اسم المستخدم">
                                            
                                            @if($errors->has('email'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('email') }}
                                            </div>
                                        @endif
                                            <input type="password" name="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" required placeholder="{{ trans('global.login_password') }}">
                                                        @if($errors->has('password'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('password') }}
                                        </div>
                                    @endif
                                            <input type="submit" name="login" class=" loginmodal-submit" value="دخول">
                                        </form>
                                        <div class="remmberme"> <input type="checkbox" value="lsRememberMe" id="rememberMe">
                                            <label for="rememberMe"> تذكرني </label></div>
            
    
            
                                    </div>
            
                                </div>
                            </div>
                        </div>
@endsection