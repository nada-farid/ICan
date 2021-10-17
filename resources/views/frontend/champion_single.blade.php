@extends('layouts.frontend')

@section('content')
    <div class="container">
        <div class="page about">

            <div class="row">
                <div class="col-md-3">
                  @php
                      if($champion->photo){
                          $champion_image = $champion->photo->getUrl('preview2');
                      }else{
                          $champion_image = '';
                      }
                  @endphp
                    <img src="{{ $champion_image }}" class="img-fluid rounded-circle">
                </div>
                <div class="col-md-9">
                    <div class="text">
                        <h2 class="h3">نبذة مختصرة </h2>

                        <br />
                        <p class="just">{{ $champion->brief }}

                        </p>

                        <hr />
                        <div class="champion_details">
                            <h5> بيانات شخصية</h5>
                            <ul>
                                <li>الدرجة العلمية : {{ App\Models\Champion::DEGREE_SELECT[$champion->degree] ?? '' }}
                                </li>
                                <li> العمر : {{ $champion->age }} عام</li>
                                <li> المؤهلات الاخرى : {{ $champion->other_skills }} </li>

                            </ul>
                        </div>


                        <hr />


                        <hr />

                        <div class="champion_details">
                            <h5>المهارات </h5>
                            <ul>

                                @foreach ($champion->languages as $key => $language)
                                    <li>
                                        <h6> {{ $language->language }}</h6>
                                        <p></p>


                                        <div class="progress">
                                            <div class="progress-bar progress-bar-striped  bg-info"
                                                style="width:{{ $language->pivot->rate }}%" role="progressbar"
                                                aria-valuenow="{{ $language->pivot->rate }}" aria-valuemin="0"
                                                aria-valuemax="100">{{ $language->pivot->rate }}%</div>
                                        </div>
                                    </li>
                                    <br />

                                @endforeach



                        </div>



                        <br /><br />
                        <h2> فيديوهـــــات </h2>
                        <hr />

                        <div class="row " style="padding: 40px; background: #faf9fb;">

                            @foreach($champion->tournament_videos as $key => $media)
                              <div class="col-md-4">
                                  <div class="video-container">
                                    <video style="width:100%" controls>
                                        <source src="{{ $media->getUrl() }}" type="video">
                                    </video>
                                  </div>
                              </div> 
                            @endforeach
                        </div>



                        <br /><br />
                        <h2>صور أخرى </h2>
                        <hr />
                        <section id="gallery" style="direction: ltr; ">
                            <div class="container">
                                <div id="image-gallery">
                                    <div class="row"> 
                                        @foreach($champion->tournament_photo as $key => $media)
                                          <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 image">
                                              <div class="img-wrapper">
                                                  <a href="{{ $media->getUrl() }}"><img src={{ $media->getUrl('preview2') }}
                                                          class="img-responsive"></a>
                                                  <div class="img-overlay">
                                                      <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                                  </div>
                                              </div>
                                          </div>
                                        @endforeach

                                    </div><!-- End row -->
                                </div><!-- End image gallery -->
                            </div><!-- End container -->
                        </section>


                    </div>


                </div>



            </div>
        </div>


    @endsection
