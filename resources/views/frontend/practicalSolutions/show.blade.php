@extends('layouts.frontend')
@section('styles')

    <style>
        .video-container {
            overflow: hidden;
            position: relative;
            width: 100%;
        }

        .video-container::after {
            padding-top: 56.25%;
            display: block;
            content: "";
        }

        .video-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }

    </style>
@endsection
@section('content')

    <div class="container">
        <div class="page about">
            <div class="row">
                @php
                    if($practicalSolution->photo){
                        $practicalSolution_image = $practicalSolution->photo->getUrl('preview2');
                    }else{
                        $practicalSolution_image = '';
                    }
                @endphp
                <div class="col-md-3">
                    <img src="{{$practicalSolution_image}}" class="img-fluid">
                </div>
                <div class="col-md-9">
                    <div class="text">
                        <h2 class="h3">{{ $practicalSolution->title }} </h2>

                        <br />
                        <p class="just"><?php echo nl2br($practicalSolution->description); ?> </p>

                    </div>
                </div>
            </div>
            <br /><br />
            <h2>فيديوهـــــات</h2>
            <hr />

            <div class="row" style="padding: 40px; background: #faf9fb">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <div class="video-container">
                        <video style="width:100%" controls>
                            @if($practicalSolution->video)
<<<<<<< HEAD
                            <source src="{{ $practicalSolution->video->getUrl() }}" type="video/mp4">
=======
                            <source src="{{ $practicalSolution->video->getUrl() }}" type="video">
>>>>>>> 35d7b4305d81e7310d1a18723387e692ff4a91d9
                                @endif
                        </video>
                    </div>
                </div>

                <div class="col-md-3"></div>
            </div>

            <h2>فيديوهـــــات أخرى</h2>
            <hr />

            <div class="row" style="padding: 40px; background: #faf9fb"> 
                @foreach($practicalSolution->practicalSolutionVideosParticipates()->where('status','accepted')->get() as $video)
                    <div class="col-md-4">
                        <div class="video-container"> 
                            @if($video->type == 'upload_video')
                                <video style="width:100%" controls>
                                    @if($video->video)
                                        <source src="{{ $video->video->getUrl() }}" type="video/mp4">
                                    @endif
                                </video>
                            @elseif($video->type == 'youtube')
                                <?php echo $video->embed_code; ?>  
                            @endif
                        </div>
                    </div> 
                @endforeach
            </div>

            <br /><br />
            <h2>صور أخرى</h2>
            <hr />
            <section id="gallery" style="direction: ltr">
                <div class="container">
                    <div id="image-gallery">
                        <div class="row">
                            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 image">
                                <div class="img-wrapper">
                                    @foreach($practicalSolution->photos as $key => $media) 
                                        <a href="{{ $media->getUrl() }}">
                                            <img src="{{ $media->getUrl('preview2') }}" class="img-responsive" />
                                        </a>
                                    @endforeach
                                    <div class="img-overlay">
                                        <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End row -->
                    </div>
                    <!-- End image gallery -->
                </div>
                <!-- End container -->
            </section>
        </div>
    </div>


@endsection
