@extends('layouts.frontend')

@section('content')

    <div class="container">
        <div class="page about">
            <div class="row">
                @php
          if($specialTool->photo){
              $specialTool_img = $specialTool->photo->getUrl('preview2');
          }else{
              $specialTool_img = '';
          }
      @endphp
                <div class="col-md-3">
                    <img src="{{ $specialTool_img }}" class="img-fluid">
                </div>
                <div class="col-md-9">
                    <div class="text">
                        <h2 class="h3">{{ $specialTool->name ?? '' }} </h2>

                        <br />
                        <p class="just"><?php echo nl2br($specialTool->description); ?> </p>

                    </div>
                </div>
            </div>
            </div>
            </div>
            @endsection