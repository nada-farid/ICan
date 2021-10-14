
@extends('layouts.frontend')



@section('content')
    <div class="container">
        <div class="page about">

            <div class="container">
                <div class="row contact">
                    <!-- Map Column -->
                    <div class="col-lg-8 mb-4 text-right">
                        <h3>إرسال رسالة</h3>
                        <form action="{{ route('frontend.contactus-store') }}" method="POST">
                            @csrf

                            <div class="form-group text-right">
                                <label>عنوان المشكلة</label>
                                <input type="text" name="title">
                            </div>

                            @if ($errors->has('title'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('title') }}
                                </div>
                            @endif

                            <div class="form-group text-right">
                                <label>البريد الإلكتروني</label>
                                <input type="text" name="email">
                            </div>
                            @if ($errors->has('email'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('email') }}
                                </div>
                            @endif


                            <div class="form-group text-right">
                                <label> الرسالة</label>
                                <textarea id="w3review" name="message" rows="4">

    </textarea>
                                @if ($errors->has('message'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('message') }}
                                    </div>
                                @endif
                            </div>

                            <button type="submit" class="btn-primary"> <i class="fas fa-plus" aria-hidden="true"></i>
                                إرسال </a> </button>
                        </form>
                        @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                        @endif
                    </div>
                    <!-- Contact Details Column -->
                    <div class="col-lg-4 mb-4 text-right">
                        <h3> بيانات التواصل</h3>
                        <p>
                            <span><i class="fas fa-map-marker-alt" aria-hidden="true"></i></span><br>
                            {{$about->address ??''}}

                        </p>
                        <p>
                            <span><i class="fas fa-phone" aria-hidden="true"></i></span><br>
                            {{$about->phone_1 ??''}}
                            <br>   {{$about->phone_2 ??''}}

                        </p>
                        <p>
                            <span><i class="fas fa-envelope" aria-hidden="true"></i></span><br>
                            <a href="mailto:name@example.com">   {{$about->email ??''}}
                            </a>
                        </p>
                        <p>
                            <span><i class="far fa-clock" aria-hidden="true"></i></span><br>
                            {{$about->time ??''}}



                        </p>
                    </div>
                </div>

            </div>



        </div>
    </div>

@endsection
