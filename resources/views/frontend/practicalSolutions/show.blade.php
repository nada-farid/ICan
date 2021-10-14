@extends('layouts.frontend')

@section('content')

    <div class="container">
        <div class="page about">

            <div class="row">
                <div class="col-md-3">
                    <img src="img/about.png" class="img-fluid">
                </div>
                <div class="col-md-9">
                    <div class="text">

                        <h2 class="h3">{{ $practicalSolution->title }} </h2>

                        <br />
                        <p class="just">{{ $practicalSolution->description }}

                        </p>


                    </div>
                </div>

            </div>
        </div>
    </div>



@endsection
