@extends('layouts.frontend')

@section('content')

    <div class="overview">
        <div class="container">
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <div class="about_pic"><img src="{{ asset('frontend/img/about.png') }}" width="300"></div>
                    <div class="text">
                        <h3>مرحبــــــــــا بكــم</h3>

                        <p>{{ $about->description ?? '' }} </p>
                        <div>
                        </div>
                    </div>


                    <div class="iconss">
                        <div class="icon vision">
                            <a data-popup-open="popup-1" href="#">
                                <img src="{{ asset('frontend/img/vision_icon.png') }}">
                                <h4>الرؤية</h4>
                            </a>
                        </div>

                        <div class="icon message">
                            <a data-popup-open="popup-2" href="#">
                                <img src="{{ asset('frontend/img/message_icon.png') }}">
                                <h4>الرسالة</h4>
                        </div>


                        <div class="icon targets">
                            <a data-popup-open="popup-3" href="#">
                                <img src="{{ asset('frontend/img/target.png') }}">
                                <h4>الاهداف</h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-2"></div>
            </div>
        </div>
    </div>
    <div class="clear"></div>


    <div class="popup" data-popup="popup-1">
        <div class="popup-inner">
            <div class="vision_details">
                <img src="{{ asset('frontend/img/vision_icon_color.png') }}">
                <h3>رؤيتــنا</h3>

                <br />
                {{ $about->vision ?? '' }}

                <a class="popup-close" data-popup-close="popup-1" href="#">x</a>
            </div>
        </div>

    </div>

    <!--  -->

    <div class="popup" data-popup="popup-2">
        <div class="popup-inner">
            <div class="vision_details">
                <img src="{{ asset('frontend/img/message_icon_color.png') }}">
                <h3>رسالتنا</h3>

                <br />
                {{ $about->message ?? '' }}

                <a class="popup-close" data-popup-close="popup-2" href="#">x</a>
            </div>
        </div>

    </div>
    <!--  -->
    <div class="popup" data-popup="popup-3">
        <div class="popup-inner">
            <div class="vision_details">
                <img src="{{ asset('frontend/img/target-color.png') }}">
                <h3>أهدافنا</h3>

                <br />
                {{ $about->goals ?? '' }}

                <a class="popup-close" data-popup-close="popup-3" href="#">x</a>
            </div>
        </div>

    </div>



    <!--------------------------------services----------------------------->

    <!----ourteam----------->
    <div class="ourteam mb50">
        <div class="container">


            <div class="section_title text-center">

                <h3> فريق العمل </h3>

            </div>


            <ul id="flexiselDemo3">

                @foreach ($staffs as $staff)
                    <li>
                        <div class="team_">

                            <img src="{{ asset('frontend/img/team05.png') }}" />
                            <h4> {{ $staff->name }} </h4>
                            <div class="jobtitle"> {{ $staff->job_tilte }} </div>
                        </div>
                    </li>

                @endforeach

            </ul>

        </div>
        <div class="clear"> </div>

    </div>

    <!--------------------->




@endsection
