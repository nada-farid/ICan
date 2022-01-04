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
                            <div class="d-flex flex-column align-items-center text-center">
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
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">الاسم بالكامل</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">{{ $user->name ?? '' }}</div>
                            </div>
                            <hr />
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">البريد اللإكتروني</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">{{ $user->email ?? '' }}</div>
                            </div>
                            <hr />
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">هاتف</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">{{ $user->phone ?? '' }}</div>
                            </div>
                        </div>
                    </div>
                    <a class="btn btn-info" href="{{route('frontend.profile_edit') }}">تعديل 
                     بياناتي الشخصيه</a>
                </div>
            
            </div>
        </div>
    </div>

@endsection
