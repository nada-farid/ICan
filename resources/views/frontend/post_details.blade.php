@extends('layouts.frontend')

@section('content')

    @php
    if($post->photo){
        $post_img = $post->photo->getUrl('preview2');
    }else{
        $post_img = "https://via.placeholder.com/800x300/FF7F50/000000";
    }
    @endphp

    <div class="page about">

        <div class="container pb50">
            <div class="row">
                <div class="col-md-9 mb40">
                    <article>
                        <img src="img/photo-1455734729978-db1ae4f687fc.jpg" alt="" class="img-fluid mb30">
                        <div class="post-content">
                            <h3>عنوان الموضوع</h3>
                            <ul class="post-meta list-inline">
                                <li class="list-inline-item">
                                    <i class="fa fa-user-circle-o"></i> {{ $post->writer_name ?? '' }}
                                </li>
                                <li class="list-inline-item">
                                    <i class="fa fa-calendar-o"></i> {{ $post->created_at->format('d-m-y') ?? '' }}
                                </li>
                                <li class="list-inline-item">
                                    <i class="fa fa-tags"></i> {{ $post->title ?? '' }}
                                </li>
                            </ul>
                            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                                <div class="image">
                                    <img src="{{$post_img }}"alt="">
                                </div>
                            <br>
                            <p class="lead">{{ $post->description ?? '' }} </p>
                            <hr class="mb40">
                            <h4 class="mb40 text-uppercase font500">التعليقات</h4>
                            @foreach ($post->postComments as $comment)
                                <div class="media mb40">
                                     @php
                                if(Auth::user()->photo)
                             
                                    $img=Auth::user()->photo->getUrl('thumb');
                                else
                                $img="";
                            
                            @endphp
                                <img src="{{$img}}" alt="Admin"
                                    class="rounded-circle" width="70" />
                                    <div class="media-body">
                                        <h5 class="mt-0 font400 clearfix">

                                            {{ $comment->name ?? '' }}</h5> {{ $comment->comment ?? ''  }}
                                    </div>
                                </div>
                            @endforeach
                            <hr class="mb40">
                            <h4 class="mb40 text-uppercase font500">اترك تعليقك</h4>
                            <form role="form" action="{{ route('frontend.comment_store') }}" method="Post">
                                @csrf
                                <input type="hidden" value="{{$post->id}}" name="post_id">
                                <div class="form-group">
                                    <label>الاسم باكامل</label>
                                    <input  name ="name" type="text" class="form-control" placeholder="الاسم بالكامل">
                                </div>
                                <div class="form-group">
                                    <label>البريد الاكتروني</label>
                                    <input name="email"type="email" class="form-control" placeholder="البريد الاكتروني">
                                </div>
                                <div class="form-group">
                                    <label>التعليقات</label>
                                    <textarea name="comment" class="form-control" rows="5" placeholder="التعليقات"></textarea>
                                </div>
                                <div class="clearfix float-right">
                                    
                               @auth
                                   <button type="submit" class="btn-primary"><i class="fas fa-plus" aria-hidden="true"></i>
                                    إرسال </a></button>
                                    @else
                                    <a a href="#" data-toggle="modal" data-target="#login-modal" class="btn-primary"><i class="fas fa-plus" aria-hidden="true"></i>
                                        إرسال </a>
                                        @endauth
                            </form>
                        </div>
                    </article>
                    <!-- post article-->

                </div>
                <div class="col-md-3 mb40">

                    <!--/col-->
                    <div class="mb40">
                        <h4 class="sidebar-title">موضوعات اخرى</h4>
                        <ul class="list-unstyled categories">
                            @php
                                
                            $i=1;
                            @endphp
                            @foreach ($posts as $Myposts )
                                
                         @if($i==$post->id)
                         <li  class="active"><a href={{route('frontend.post_details',$Myposts->id)}}> الموضوع  {{$i++}} </a></li>
                         @else
                            <li><a href={{route('frontend.post_details',$Myposts->id)}}> الموضوع  {{$i++}} </a></li>
                           @endif
                            @endforeach
                        </ul>
                    </div>
                    <!--/col-->
                    <div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


@section('styles')
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">

    <style type="text/css">
        .text-primary {
            color: #2eb67d;
        }

        .entry-card {
            -webkit-box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.05);
            -moz-box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.05);
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.05);
        }

        .entry-content {
            background-color: #fff;
            padding: 36px 36px 36px 36px;
            border-bottom-left-radius: 6px;
            border-bottom-right-radius: 6px;
        }

        .entry-content .entry-title a {
            color: #333;
        }

        .entry-content .entry-title a:hover {
            color: #4782d3;
        }

        .entry-content .entry-meta span {
            font-size: 12px;
        }

        .entry-title {
            font-size: .95rem;
            font-weight: 500;
            margin-bottom: 15px;
        }

        .entry-thumb {
            display: block;
            position: relative;
            overflow: hidden;
            border-top-left-radius: 6px;
            border-top-right-radius: 6px;
        }

        .entry-thumb img {
            border-top-left-radius: 6px;
            border-top-right-radius: 6px;
        }

        .entry-thumb .thumb-hover {
            position: absolute;
            width: 100px;
            height: 100px;
            background: rgba(71, 130, 211, 0.85);
            display: block;
            top: 50%;
            left: 50%;
            color: #fff;
            font-size: 40px;
            line-height: 100px;
            border-radius: 50%;
            margin-top: -50px;
            margin-left: -50px;
            text-align: center;
            transform: scale(0);
            -webkit-transform: scale(0);
            opacity: 0;
            transition: all .3s ease-in-out;
            -webkit-transition: all .3s ease-in-out;
        }

        .entry-thumb:hover .thumb-hover {
            opacity: 1;
            transform: scale(1);
            -webkit-transform: scale(1);
        }

        .article-post {
            border-bottom: 1px solid #eee;
            padding-bottom: 70px;
        }

        .article-post .post-thumb {
            display: block;
            position: relative;
            overflow: hidden;
        }

        .article-post .post-thumb .post-overlay {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.6);
            transition: all .3s;
            -webkit-transition: all .3s;
            opacity: 0;
        }

        .article-post .post-thumb .post-overlay span {
            width: 100%;
            display: block;
            vertical-align: middle;
            text-align: center;
            transform: translateY(70%);
            -webkit-transform: translateY(70%);
            transition: all .3s;
            -webkit-transition: all .3s;
            height: 100%;
            color: #fff;
        }

        .article-post .post-thumb:hover .post-overlay {
            opacity: 1;
        }

        .article-post .post-thumb:hover .post-overlay span {
            transform: translateY(50%);
            -webkit-transform: translateY(50%);
        }

        .post-content .post-title {
            font-weight: 500;
        }

        .post-meta {
            padding-top: 15px;
            margin-bottom: 20px;
        }

        .post-meta li:not(:last-child) {
            margin-right: 10px;
        }

        .post-meta li a {
            color: #999;
            font-size: 13px;
        }

        .post-meta li a:hover {
            color: #4782d3;
        }

        .post-meta li i {
            margin-left: 5px;
        }

        .post-meta li:after {
            margin-top: -5px;
            content: "/";
            margin-left: 10px;
        }

        .post-meta li:last-child:after {
            display: none;
        }

        .post-masonry .masonry-title {
            font-weight: 500;
        }

        .share-buttons li {
            vertical-align: middle;
        }

        .share-buttons li a {
            margin-right: 0px;
        }

        .post-content .fa {
            color: #2eb67d;
        }

        .post-content a h2 {
            font-size: 1.5rem;
            color: #333;
            margin-bottom: 0px;
        }

        .article-post .owl-carousel {
            margin-bottom: 20px !important;
        }

        .post-masonry h4 {
            text-transform: capitalize;
            font-size: 1rem;
            font-weight: 700;
        }

        .mb40 {
            margin-bottom: 40px !important;
        }

        .mb30 {
            margin-bottom: 30px !important;
        }

        .media-body h5 a {
            color: #555;
        }

        .categories li a:before {
            content: "\f0da";
            font-family: 'FontAwesome';
            margin-left: 5px;
        }

        /*
    Template sidebar
    */

        .sidebar-title {
            margin-bottom: 1rem;
            font-size: 1.1rem;
        }

        .categories li {
            vertical-align: middle;
        }

        .categories li>ul {
            padding-left: 15px;
        }

        .categories li>ul>li>a {
            font-weight: 300;
        }

        .categories li a {
            color: #999;
            position: relative;
            display: block;
            padding: 5px 10px;
            border-bottom: 1px solid #eee;
        }

        .categories li a:before {
            content: "\f0da";
            font-family: 'FontAwesome';
            margin-right: 5px;
        }

        .categories li a:hover {
            color: #444;
            background-color: #f5f5f5;
        }

        .categories>li.active>a {
            font-weight: 600;
            color: #444;
        }

        .media-body h5 {
            font-size: 15px;
            letter-spacing: 0px;
            line-height: 20px;
            font-weight: 400;
        }

        .media-body h5 a {
            color: #555;
        }

        .media-body h5 a:hover {
            color: #4782d3;
        }

    </style>

    <script type="text/javascript">

    </script>

@endsection
