@extends('layouts.frontend')

@section('content')
    <div class="medical">

        <div class="container">
            <h2 class="text-center mb-8">أراء المختصون</h2><br/>
            @foreach ($medicalOpinions as $medicalOpinion)
            @php
            if($medicalOpinion->photo){
                $medicalOpinions_image = $medicalOpinion->photo->getUrl('preview2');
            }else{
                $medicalOpinions_image = '';
            }
        @endphp
                <div class="row">
                    <div class="col-md-1"></div>

                    <div class="col-md-10">

                        <div class="medicalopinions">
                            <div class="row">

                                <div class="col-md-2">
                                    <div class="pic"><img src="{{ $medicalOpinions_image }}"
                                            class="img-fluid"></div>
                                </div>
                                <div class="col-md-8">
                                    <div class="details">
                                        <ul>
                                            <li><i class="fas fa-pen-nib"></i> بقلم : د.
                                                {{ $medicalOpinion->doctor->name ?? '' }} </li>
                                            <li><i class="far fa-calendar"></i> {{ $medicalOpinion->created_at ?? '' }}</li>
                                        </ul>
                                        <div class="clear"></div>
                                        <p>{{ $medicalOpinion->opinion ?? '' }}</p>
                                    </div>
                                </div>
                        

                            </div>
                        </div>
                    </div>

                    <div class="col-md-1"></div>

                </div>
            @endforeach

            {{ $medicalOpinions->links() }}

        </div>
    </div>
@endsection
