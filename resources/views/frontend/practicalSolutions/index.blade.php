@extends('layouts.frontend')

@section('content')
    <div class="page_content services">
        <div class="container">



            <div class="col-md-12">
                <div class="row">
                    @foreach ($practicalSolutions as $practicalSolution)

                    @php
                    if($practicalSolution->photo){
                        $solution_image = $practicalSolution->photo->getUrl('preview2');
                    }else{
                        $solution_image = '';
                    }
                @endphp

                        <div class="col-md-6">

                            <div class="home__services">

                                <div class="row">
                                    <div class="col-md-4">
        
                                        <div class="pic"><img src="{{ $solution_image }}"  class="img-fluid">
                                        </div>
                                    </div>
                                    <div class="col-md-8">

                                        <div class="details"> <a href="practical_solutions.html">
                                                <h5>{{ $practicalSolution->title }} </h5>
                                            </a>
                                            <p>{{ $practicalSolution->description }} </p>
                                            <button class="btn-more"> <a
                                                    href="{{ route('frontend.practical_solution_show', $practicalSolution->id) }}">
                                                    المزيد </a> </button>
                                        </div>
                                    </div>
                                </div>


                            </div>

                        </div>
                    @endforeach
                </div>

                    {{ $practicalSolutions->links() }}

                </div>




            </div>
        </div>
    </div>


@endsection
