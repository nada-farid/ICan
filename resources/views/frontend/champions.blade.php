@extends('layouts.frontend')

@section('content')

    <div class="ourteam" style="background: #fff;">
        <div class="container">

            <div class="row">

                @foreach ($champions as $champion)

                @php
                if($champion->photo){
                    $champion_img = $champion->photo->getUrl('preview2');
                }else{
                    $champion_img = '';
                }
            @endphp

                    <div class="col-md-3" >
                        <div class="team_ border-bottom" >

                            <img src="{{ $champion_img}}" />
                            <h4> {{ $champion->name ?? '' }}</h4>
                            <div class="more"><span><a
                                        href="{{ route('frontend.champion_single', $champion->id) }}"> <i
                                            class="fas fa-plus-square"></i></a></span></div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>

        <div class="clear"> </div>

    </div>
    {{ $champions->links() }}
@endsection
