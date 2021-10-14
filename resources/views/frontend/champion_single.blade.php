@extends('layouts.frontend')

@section('content')
<div class="container">
    <div class="page about">

<div class="row">
     <div class="col-md-3">
       <img src="{{asset('frontend/img/team01.jpg')}}" class="img-fluid rounded-circle">
</div>
    <div class="col-md-9">
        <div class="text">
<h2 class="h3">نبذة مختصرة </h2>
            
            <br />
<p class="just">{{$champion->brief}}

</p>

<hr />
            <div class="champion_details">
                <h5> بيانات شخصية</h5>
            <ul>
            <li>الدرجة العلمية :     {{ App\Models\Champion::DEGREE_SELECT[$champion->degree] ?? '' }}</li>
                <li> العمر : {{$champion->age}} عام</li>
                <li> المؤهلات الاخرى :   {{$champion->other_skills}} </li>
                
            </ul>
            </div>
            
            
            <hr />
                  
            
            <hr />
            
              <div class="champion_details">
                  <h5>المهارات </h5>
            <ul>
            <li>
                @foreach($champion->languages as $key => $language)
<h6 > {{ $language->language }}</h6>

<div class="progress">
<div class="progress-bar progress-bar-striped  bg-info" style="width:80%" role="progressbar" aria-valuenow="{{$language}}" aria-valuemin="0" aria-valuemax="100">80%</div>
</div></li>
                 <br />
                  <li>
     
                    @endforeach
                     

            
</div>
        
        
        
          <br /><br />
              <h2 > فيديوهـــــات </h2>
       <hr /> 
            
        <div class="row " style="padding: 40px; background: #faf9fb;">
            
            <div class="col-md-4"><div class="video-container">
<iframe src="https://www.youtube.com/embed/klZNNUz4wPQ" frameborder="0"></iframe>
</div>
           </div>
            <div class="col-md-4">
             
           <div class="video-container">
<iframe src="https://www.youtube.com/embed/klZNNUz4wPQ" frameborder="0"></iframe>
</div>
            </div>
            
            <div class="col-md-4"><div class="video-container">
<iframe src="https://www.youtube.com/embed/klZNNUz4wPQ" frameborder="0"></iframe>
</div>
           </div>
        </div>
        
        
        
        <br /><br />
        <h2 >صور أخرى </h2>
       <hr /> 
        <section id="gallery" style="direction: ltr; ">
<div class="container">
<div id="image-gallery">
<div class="row">
<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 image">
  <div class="img-wrapper">
    <a href="https://unsplash.it/500"><img src="https://unsplash.it/500" class="img-responsive"></a>
    <div class="img-overlay">
      <i class="fa fa-plus-circle" aria-hidden="true"></i>
    </div>
  </div>
</div>

</div><!-- End row -->
</div><!-- End image gallery -->
</div><!-- End container --> 
</section>
        
        
</div>
    

</div>
        
      
        
</div>    
</div>


@endsection