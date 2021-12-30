@extends('layouts.frontend')

@section('styles') 
    <style type="text/css">
        .white-bg {
            background-color: #ffffff;
        }

        .page-heading {
            border-top: 0;
            padding: 0 10px 20px 10px;
        }

        .forum-post-container .media {
            margin: 10px 10px 10px 10px;
            padding: 20px 10px 20px 10px;
            border-bottom: 1px solid #f1f1f1;
        }

        .forum-avatar {
            float: left;
            margin-right: 20px;
            text-align: center;
            width: 110px;
        }

        .forum-avatar .img-circle {
            height: 48px;
            width: 48px;
        }

        .author-info {
            color: #676a6c;
            font-size: 11px;
            margin-top: 5px;
            text-align: center;
        }

        .forum-post-info {
            padding: 9px 12px 6px 12px;
            background: #f9f9f9;
            border: 1px solid #f1f1f1;
        }

        .media-body>.media {
            background: #f9f9f9;
            border-radius: 3px;
            border: 1px solid #f1f1f1;
        }

        .forum-post-container .media-body .photos {
            margin: 10px 0;
        }

        .forum-photo {
            max-width: 140px;
            border-radius: 3px;
        }

        .media-body>.media .forum-avatar {
            width: 70px;
            margin-right: 10px;
        }

        .media-body>.media .forum-avatar .img-circle {
            height: 38px;
            width: 38px;
        }

        .mid-icon {
            font-size: 66px;
        }

        .forum-item {
            margin: 10px 0;
            padding: 10px 0 20px;
            border-bottom: 1px solid #f1f1f1;
        }

        .views-number {
            font-size: 24px;
            line-height: 18px;
            font-weight: 400;
        }

        .forum-container,
        .forum-post-container {
            padding: 30px !important;
        }

        .forum-item small {
            color: #999;
        }

        .forum-item .forum-sub-title {
            color: #999;
            margin-left: 50px;
            text-align: right;
        }

        .forum-title {
            margin: 15px 0 15px 0;
            text-align: right;
        }

        .forum-info {
            text-align: center;
        }

        .forum-desc {
            color: #999;
        }

        .forum-icon {
            float: right;
            width: 30px;
            margin-left: 20px;
            text-align: center;
        }

        a.forum-item-title {
            color: inherit;
            display: block;
            font-size: 18px;
            font-weight: 600;
            text-align: right;
        }

        a.forum-item-title:hover {
            color: inherit;
        }

        .forum-icon .fa {
            font-size: 30px;
            margin-top: 8px;
            color: #9b9b9b;
        }

        .forum-item.active .fa {
            color: #2eb67d;
        }

        .forum-item.active a.forum-item-title {
            color: #2eb67d;
        }

        @media (max-width: 992px) {
            .forum-info {
                margin: 15px 0 10px 0;
                /* Comment this is you want to show forum info in small devices */
                display: none;
            }

            .forum-desc {
                float: none !important;
            }
        }

        .ibox {
            clear: both;
            margin-bottom: 25px;
            margin-top: 0;
            padding: 0;
        }

        .ibox.collapsed .ibox-content {
            display: none;
        }

        .ibox.collapsed .fa.fa-chevron-up:before {
            content: "\f078";
        }

        .ibox.collapsed .fa.fa-chevron-down:before {
            content: "\f077";
        }

        .ibox:after,
        .ibox:before {
            display: table;
        }

        .ibox-title {
            -moz-border-bottom-colors: none;
            -moz-border-left-colors: none;
            -moz-border-right-colors: none;
            -moz-border-top-colors: none;
            background-color: #ffffff;
            border-color: #e7eaec;
            border-image: none;
            border-style: solid solid none;
            border-width: 3px 0 0;
            color: inherit;
            margin-bottom: 0;
            padding: 14px 15px 7px;
            min-height: 48px;
        }

        .ibox-content {
            background-color: #ffffff;
            color: inherit;
            padding: 15px 20px 20px 20px;
            border-color: #e7eaec;
            border-image: none;
            border-style: solid solid none;
            border-width: 1px 0;
        }

        .ibox-footer {
            color: inherit;
            border-top: 1px solid #e7eaec;
            font-size: 90%;
            background: #ffffff;
            padding: 10px 15px;
        }

        .message-input {
            height: 90px !important;
        }

        .form-control,
        .single-line {
            background-color: #ffffff;
            background-image: none;
            border: 1px solid #e5e6e7;
            border-radius: 1px;
            color: inherit;
            display: block;
            padding: 6px 12px;
            transition: border-color 0.15s ease-in-out 0s,
                box-shadow 0.15s ease-in-out 0s;
            width: 100%;
            font-size: 14px;
        }

        .text-navy {
            color: #2eb67d;
        }

        .mid-icon {
            font-size: 66px !important;
        }

        .m-b-sm {
            margin-bottom: 10px;
        }

    </style>
@endsection

@section('content')


    <div class="page about">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="wrapper wrapper-content animated fadeInRight">
                        <div class="ibox-content forum-container" style="background: #f9fafb">
                            <div class="forum-title"> 
                                <h3>الموضوعات العامة</h3>
                            </div>
                            @foreach($subjects_categories as $category)
                                @php
                                    $posts = \App\Models\PublicSubject::where('subject_category_id',$category->id)->get();

                                    $comments = 0;
                                    $views = 0;
                                    foreach($posts as $post){
                                        $comments += $post->postComments()->count();
                                        $views += $post->views;
                                    }
                                @endphp
                                <div class="forum-item">
                                    <div class="row">
                                        <div class="col-md-9"> 
                                            <a href="{{ route('frontend.posts',$category->id) }}" class="forum-item-title">{{ $category->name }}</a>
                                            <div class="forum-sub-title">
                                                {{ $category->description }}
                                            </div>
                                        </div>
                                        <div class="col-md-1 forum-info">
                                            <span class="views-number"> {{ $views }} </span>
                                            <div>
                                                <small>المشاهدات</small>
                                            </div>
                                        </div>
                                        <div class="col-md-1 forum-info">
                                            <span class="views-number"> {{ $posts->count() }} </span>
                                            <div>
                                                <small>الموضوعات</small>
                                            </div>
                                        </div>
                                        <div class="col-md-1 forum-info">
                                            <span class="views-number"> {{ $comments }} </span>
                                            <div>
                                                <small>الردود</small>
                                            </div>
                                        </div>
                                    </div>
                                </div> 
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
