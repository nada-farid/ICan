@extends('layouts.frontend')

@section('content')
<<<<<<< HEAD
       <div class="page_content" style="margin-top: 50px;">
<div class="container">
     <div class="row">
    <div class="col-md-2"></div>
         
         <div class="col-md-8">

<div class="have_problem">
     <form action="{{ route('frontend.register_save') }}" method="Post">
                               @csrf
         <div class="form-group text-right">
=======
    <div class="page_content" style="margin-top: 50px;">
        <div class="container">
            <div class="row">
                <div class="col-md-2"></div>

                <div class="col-md-8">

                    <div class="have_problem">
                        <form action="{{ route('frontend.register_save') }}" method="Post">
                               @csrf
                            <div class="form-group text-right">
>>>>>>> 35d7b4305d81e7310d1a18723387e692ff4a91d9
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>البريد الإلكتروني </label>
                                        <input type="text" name="email">
                                    </div>
                                    <div class="col-md-6">
                                        <label>كلمة المرور </label>
                                        <input type="password" name="password">
                                    </div>
                                </div>
                            </div>


                            <div class="form-group text-right">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>الاسم بالكامل </label>
                                        <input type="text" name="name">
                                    </div>
                                    <div class="col-md-6">
                                        <label> رقم الهاتف </label>
                                        <input type="text" name="phone">
                                    </div>
                                </div>
                            </div>
<<<<<<< HEAD
                              <div class="form-group text-right">
             <div class="row">
                 <div class="col-md-6">
             <label>   </label>
				
             </div>
                 <div class="col-md-6">
             <label>   </label>
		
             </div>
         </div></div>
                            <div class="form-group text-right">
             <div class="row">
                 <div class="col-md-6">
             <label>   </label>
				
             </div>
                 <div class="col-md-6">
             <label>   </label>
		
             </div>
         </div></div>
         
 
                        <button  type= "submit"class="btn-primary"> <a> تسجيل  </a> </button>
				  </form>
    
    </div>
             
             </div>
         
         
<div class="col-md-2"></div>    </div>
    </div>
    </div>
        
   
        
  

=======
        
                            <button  type="submit" class="btn-primary"> تسجيل </button>
                        </form>

                    </div>


                </div>


                <div class="col-md-2"></div>
            </div>
        </div>

    </div>
>>>>>>> 35d7b4305d81e7310d1a18723387e692ff4a91d9
@endsection
