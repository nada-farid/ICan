@extends('layouts.frontend')

@section('content')

    <div class="page_content">
        <div class="container">
            <div class="row">
                <div class="col-md-2"></div>

                <div class="col-md-8">
                    <div class="about_pic text-center"><img src="{{ asset('frontend/img/haveproblem.png') }}" width="300">
                    </div>

                    <div class="have_problem">
                        <form action="{{ route('frontend.problem') }}" method="POST">
                            @csrf

                            <div class="form-group text-right">
                                <label>عنوان المشكلة</label>
                                <input type="text" name="title">
                            </div>


                            <div class="form-group text-right">
                                <label>البريد الإلكتروني</label>
                                <input type="text" name="email">
                            </div>


                            <div class="form-group text-right">
                                <label> رقم التليفون</label>
                                <input type="text" name="phone">
                            </div>



                            <div class="form-group text-right">
                                <label> تفاصيل المشكلة</label>
                                <textarea id="w3review" name="description" rows="6">

          </textarea>

                            </div>

                            <button type="submit" class="btn-primary"><i class="fas fa-plus" aria-hidden="true"></i>
                                إرسال </a></button>
                        </form>

                    </div>

                </div>


                <div class="col-md-2"></div>
            </div>
        </div>
    </div>

@endsection
