@extends('layouts.frontend')

@section('content')
<div class="ourteam tools" style="background: #fff;">
    <div class="container">

        <div class="row">


          @foreach ($specialTools as $specialTool)
            
            <div class="col-md-3">
                <div class="team_  bg-secondary text-white  border-bottom">

                    <img src="{{asset('frontend/img/tool01.png')}}" />
                    <h4> {{$specialTool->name ?? ''}}</h4>
                    <div class="jobtitle">{{$specialTool->description ?? ''}}
                        </div>
                    <div class="more"><span><a href="champion_single.html"> <i
                                    class="fas fa-plus-square"></i></a></span></div>
                </div>
            </div>

            @endforeach

        </div>
{{$specialTools->links()}}
    </div>
    <div class="clear"> </div>

</div>

@endsection