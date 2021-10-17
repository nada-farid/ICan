@extends('layouts.frontend')

@section('content')



    <div class="content">

        <!-----slider-->



        <ul id="demo1">
            @foreach ($sliders as $slider)
                @foreach ($slider->photo as $key => $media)
                    <li>
                        <img src="{{ $media->getUrl() }}" />
                    </li>
                @endforeach
            @endforeach
        </ul>



        <!-- End // .slider -->


        <div class="overview">
            <div class="container">
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <div class="text">
                            <h3>مرحبــــــــــا بكــم</h3>

                            <p><?php echo nl2br($about->description); ?> </p> 
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

        <div class="services">

            <div class="container">

                <div class="section_title text-center">
                    <h3>
                        حلول عملية</h3>

                </div>
                <div class="col-md-12">
                    <div class="row">
                        @foreach ($solutions as $solution)


                        @php
                            if($solution->photo){
                                $solution_image = $solution->photo->getUrl('preview2');
                            }else{
                                $solution_image = '';
                            }
                        @endphp
                            <div class="col-md-6">

                                <div class="home__services">

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="pic"><img
                                                    src="{{ $solution_image }}"
                                                    class="img-fluid">
                                            </div>
                                        </div>
                                        <div class="col-md-8">

                                            <div class="details"> <a href="practical_solutions.html">
                                                    <h5>{{ $solution->title ?? '' }} </h5>
                                                </a>
                                                <p>{{ $solution->description ?? '' }} </p>
                                                <button class="btn-more"> <a
                                                        href="{{ route('frontend.practical_solution_show', $solution->id) }}">المزيد
                                                    </a>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        @endforeach
                    </div>

                    <div class="row ">
                        <div class="col-md-12 text-center">

                            <button class="btn-primary"> <a href="{{ route('frontend.practical_solutions') }}"><i
                                        class="fas fa-plus" aria-hidden="true"></i> عرض الكل </a> </button>
                        </div>
                    </div>




                </div>
            </div>
        </div>
        <!--------------------------------services----------------------------->
        <!--  .overview -->
        <!------------------------>





        <!----------Successful cases---------->


        <!----ourteam----------->
        <div class="ourteam">
            <div class="container">


                <div class="section_title text-center">

                    <h3> ابطال استطاعــوا </h3>

                </div>


                <ul id="flexiselDemo3">
                    @foreach ($champions as $champion)


                        @php
                            if($champion->photo){
                                $champion_image = $champion->photo->getUrl('preview2');
                            }else{
                                $champion_image = '';
                            }
                        @endphp
                        <li>
                            <div class="team_">

                                <img src="{{ $champion_image }}" />
                                <h4>{{ $champion->name ?? '' }} </h4>
                                <div class="jobtitle">
                                    {{ $champion->brief ?? '' }} </div>
                                <div class="more"><span><a href="champion_single.html"> <i
                                                class="fas fa-plus-square"></i></a></span></div>
                            </div>
                        </li>
                    @endforeach
                </ul>

            </div>
            <div class="clear"> </div>

        </div>

        <svg width="100%" height="80" viewBox="0 0 500 80" preserveAspectRatio="none">
            <path d="M0,0 L0,40 Q250,80 500,40 L500,0 Z" fill="#393a56" />
        </svg>
        <div class="clear"> </div>

        <!--------------------->

        <!----------medical opinions----------->



        <div class="medical">

            <div class="container">

                <div class="section_title text-center">
                    <h3>أراء طبية ومهارات</h3>

                </div>
                @foreach ($medicalOpinions as $medicalOpinion)
                    <div class="row">
                        <div class="col-md-1"></div>

                        <div class="col-md-10">

                            <div class="medicalopinions">
                                <div class="row">
                                    @php
                                        if($medicalOpinion->photo){
                                            $medicalOpinions_image = $medicalOpinion->photo->getUrl('preview2');
                                        }else{
                                            $medicalOpinions_image = '';
                                        }
                                    @endphp
                                    <div class="col-md-2">
                                        <div class="pic"><img src="{{ $medicalOpinions_image }}"
                                                class="img-fluid"></div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="details">
                                            <ul>
                                                <li><i class="fas fa-pen-nib"></i> بقلم : د.
                                                    {{ $medicalOpinion->doctor->name ?? '' }} </li>
                                                <li><i class="far fa-calendar"></i>
                                                    {{ $medicalOpinion->created_at ?? '' }}
                                                </li>
                                            </ul>
                                            <div class="clear"></div>
                                            <p>{{ $medicalOpinion->opinion ?? '' }}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="more"><button class="btn-more"> <a
                                                    href="medical_single.html"> المزيد </a> </button></div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="col-md-1"></div>

                    </div>
                @endforeach

                <div class="col-md-1"></div>

            </div>

            <div class="row ">
                <div class="col-md-12 text-center">

                    <button class="btn-primary"> <a  href="{{ route('frontend.medical_opinions') }}"><i class="fas fa-plus"
                                aria-hidden="true"></i> عرض الكل </a> </button>
                </div>
            </div>

        </div>
    </div>


@endsection
