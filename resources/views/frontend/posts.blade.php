@extends('layouts.frontend')

@section('content')

            @foreach ($posts as $post )
            @php
            if($post->photo){
                $post_img = $post->photo->getUrl('preview2');
            }else{
                $post_img = "https://via.placeholder.com/800x300/FF7F50/000000";
            }
        @endphp
        <div class="container bootstrap snippets bootdey">

            <br /><br />
            <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="well blog">
                <a href="{{ route('frontend.post_details',$post->id) }}">
                    <div class="date">
                        <span class="blog-date">{{$post->created_at->format('M') ?? ''}}</span>
                        <span class="blog-number">{{$post->created_at->format('d') ?? '' }}</span>
                    </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                                <div class="image">
                                    <img src="{{$post_img }}"alt="">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                                <div class="blog-details">
                                    <h2>{{$post->title ?? ''  }}</h2>
                                    <p>
                                   {{$post->description ?? ''  }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
            @endforeach
        
    </div>
        </div>
            {{$posts->links() }}
        </div>
    </div>
@endsection
@section('styles')
<style type="text/css">

    p {
        font-size: 14px;
        color: #777;
    }
    
    .blog .image {
        height: 250px;
        overflow: hidden;
        border-radius: 3px 0 0 3px;
    }
    
    .blog .image img {
        width: 100%;
        height: auto;
    }
    
    .blog .date {
        top: -10px;
        z-index: 99;
        width: 65px;
        right: -10px;
        height: 65px;
        padding: 10px;
        position: absolute;
        color:#FFFFFF;
        font-weight:bold;
        background: #2eb67d;
        border-radius: 999px;
        text-align: center;
    }
    
    .blog .blog-details {
        padding: 0 20px 0 0;
        text-align: right;
    }
    
    .blog {
        padding: 0;
    }
    
    .well {
        border: 0;
        padding: 20px;
        min-height: 63px;
        background: #fff;
        box-shadow: none;
        border-radius: 3px;
        position: relative;
        max-height: 100000px;
        border-bottom: 2px solid #ccc;
    }
    
    .blog .blog-details h2 {
        margin-bottom: 10px;
        padding-bottom: 10px;
        border-bottom: 1px solid #eee;
        font-size: 22px;
    }
    
    .blog .date .blog-number {
        color: #fff;
        display: block;
        text-align: center;
    }                    
    </style>
    
    <script type="text/javascript">
                            
                        
    </script>
@endsection