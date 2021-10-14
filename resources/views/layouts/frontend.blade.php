<!DOCTYPE HTML>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <link rel="shortcut icon" href="" type="image/x-icon">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>.. I CAN ..</title>


    <link rel="stylesheet" href="https://unpkg.com/@popperjs/core@2">
    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/js/bootstrap.js') }}">
    <link rel="stylesheet" href="{{ asset('frontend/fonts/stylesheet.css') }}">
    <script src="https://kit.fontawesome.com/e0387e9a75.js"></script>
    <link rel="stylesheet" href="{{ asset('frontend/css/main.css') }}">




    <link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">




    <script src="{{ asset('frontend/js/main.js') }}"></script>

    <link rel="stylesheet" href="{{ asset('frontend/fonts/stylesheet.css') }}" type="text/css" charset="utf-8" />

    <link href="{{ asset('frontend/css/model.css') }}" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <!----------brandslider---------------->
    <!----slider---->
    <script src="http://code.jquery.com/jquery.js"></script>

    <script src="{{ asset('frontend/src/skdslider.min.js') }}"></script>
    <link href="{{ asset('frontend/src/skdslider.css') }}" rel="stylesheet">
    <script type="text/javascript">
        jQuery(document).ready(function() {
            jQuery('#demo1').skdslider({
                'delay': 5000,
                'animationSpeed': 2000,
                'showNextPrev': true,
                'showPlayButton': true,
                'autoSlide': true,
                'animationType': 'sliding'
            });
            jQuery('#demo2').skdslider({
                'delay': 5000,
                'animationSpeed': 1000,
                'showNextPrev': true,
                'showPlayButton': true,
                'autoSlide': true,
                'animationType': 'sliding'
            });
            jQuery('#demo3').skdslider({
                'delay': 5000,
                'animationSpeed': 2000,
                'showNextPrev': true,
                'showPlayButton': true,
                'autoSlide': true,
                'animationType': 'fading'
            });

            jQuery('#responsive').change(function() {
                $('#responsive_wrapper').width(jQuery(this).val());
            });

        });
    </script>

    <!----slider---->

    <link href="{{ asset('frontend/css/style.css') }}" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="{{ asset('frontend/js/jquery.flexisel.js') }}"></script>




</head>

<body>

    <div class="upper-bar">
        <div class="container">
            <div class="row">
                <div class="col-md-7">
                    <div class="contact-head">
                        @php
                        
                        $about= \App\Models\AboutUs::first();

                        @endphp
                        <a href="tel:22408681"> <i class="fab fa-whatsapp"></i> <span>{{ $about->phone_1 ?? '' }}</span>
                        </a>

                        <a href="mailto:info@ican.com"> <i class="far fa-envelope"></i>
                            <span>{{ $about->email ?? '' }}</span></a>

                    </div>
                </div>

                <div class="col-md-5">
                    <div class="social">
                        <ul>
                            <li> <a href="{{ $about->twitter ?? '' }}"><i class="fab fa-twitter"
                                        aria-hidden="true"></i></a> </li>
                            <li> <a href="{{ $about->facebook ?? '' }}"><i class="fab fa-facebook-f"></i></a> </li>


                            <li> <a href="{{ $about->instegram ?? '' }}"> <i class="fab fa-instagram"
                                        aria-hidden="true"></i></a> </li>
                            <li> <a href="{{ $about->youtube ?? '' }}"><i class="fab fa-youtube"
                                        aria-hidden="true"></i></a> </li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>

    </div>

    <!----------slider---------->
    <!--------------header-------------->

    <header>

        <div class="container">

            <div class="row">
                <div class="col-md-6">
                    <div class="logo"><a href="#"> <img src="{{ asset('frontend/img/logo.png') }}"></a></div>
                </div>

                <div class="col-md-6">

                    <div class="header_actions">
                        <li class="login"> <a href="#" data-toggle="modal" data-target="#login-modal"> <i
                                    class="far fa-user"></i> تسجيل الدخول </a> </li>

                        <li class="proplem_quick"><a data-popup-open="popup-4" href="#"> <i
                                    class="fas fa-heart-broken"></i> عندي مشكلة </a></li>

                    </div>
                </div>
            </div>

        </div>

        <div class="menu">
            <div class="container">

                <nav class="navbar navbar-expand-md  justify-content-center theme_bg color_white ">
                    <button class="navbar-toggler ml-1" type="button" data-toggle="collapse"
                        data-target="#collapsingNavbar2">
                        <span class="navbar-toggler-icon"><i class="fas fa-grip-lines"></i></span>
                    </button>
                    <div class="navbar-collapse collapse justify-content-between align-items-center w-100"
                        id="collapsingNavbar2">
                        <ul class="navbar-nav mx-auto text-center">
                            <li class="nav-item active">
                                <a class="nav-link" href="{{ route('home') }}">الرئيسية</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('frontend.about_us') }}"> من نحن </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="('frontend.have_proplem')"> عندي مشكلة</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('frontend.practical_solutions') }}"> حلول
                                    عملية </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('frontend.medical_opinions') }}"> اراء طبية
                                </a>
                            </li>


                            <li class="nav-item">
                                <a class="nav-link"   href="{{ route('frontend.champions') }}"> ابطال استطاعوا </a>
                            </li>


                            <li class="nav-item">
                                <a class="nav-link"  href="{{ route('frontend.tools') }}"> ادوات والات خاصة </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('frontend.contactus') }}">تـواصل معنا </a>
                            </li>


                        </ul>

                    </div>

                </nav>




            </div>

        </div>
    </header>
    @yield('content')

    <div class="footer">
        <div class="container">

            جميع الحقوق محفوظة © 2021- <a href="https://alliance-sa.com/index_ar" target="_blank"> تصميم وبرمجة تحالف
                الرؤى</a>



        </div>
    </div>








    <script>
        $(function() {
            //----- OPEN
            $('[data-popup-open]').on('click', function(e) {
                var targeted_popup_class = jQuery(this).attr('data-popup-open');
                $('[data-popup="' + targeted_popup_class + '"]').fadeIn(350);

                e.preventDefault();
            });

            //----- CLOSE
            $('[data-popup-close]').on('click', function(e) {
                var targeted_popup_class = jQuery(this).attr('data-popup-close');
                $('[data-popup="' + targeted_popup_class + '"]').fadeOut(350);

                e.preventDefault();
            });
        });
    </script>





    <div class="popup" data-popup="popup-4">
        <div class="popup-inner">


            <div class="loginmodal-container text-center">
                <i class="fas fa-heart-broken" aria-hidden="true"></i>
                <h1>عندي مشكلة </h1>
                <form>
                    <input type="text" name="user" placeholder="عنوان ">
                    <input type="text" name="user" placeholder="البريد الإلكتروني ">
                    <input type="text" name="user" placeholder="رقم التليفون ">
                    <textarea id="w3review" name="" rows="4">

</textarea>
                    <input type="submit" name="login" class=" loginmodal-submit" value="إرسال">
                </form>



            </div>

            <a class="popup-close" data-popup-close="popup-4" href="#">x</a>

        </div>

    </div>



    </div>


    <script src="{{ asset('frontend/js/popper.min.js') }}"></script>
    <script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
    <!----slider---->
    <script>
        (function(i, s, o, g, r, a, m) {
            i['GoogleAnalyticsObject'] = r;
            i[r] = i[r] || function() {
                (i[r].q = i[r].q || []).push(arguments)
            }, i[r].l = 1 * new Date();
            a = s.createElement(o),
                m = s.getElementsByTagName(o)[0];
            a.async = 1;
            a.src = g;
            m.parentNode.insertBefore(a, m)
        })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

        ga('create', 'UA-3415878-12', 'dandywebsolution.com');
        ga('send', 'pageview');
    </script>
    <!----slider---->




    <script type="text/javascript">
        $(window).load(function() {
            $("#flexiselDemo1").flexisel();
            $("#flexiselDemo2").flexisel({
                enableResponsiveBreakpoints: true,
                responsiveBreakpoints: {
                    portrait: {
                        changePoint: 480,
                        visibleItems: 1
                    },
                    landscape: {
                        changePoint: 640,
                        visibleItems: 2
                    },
                    tablet: {
                        changePoint: 768,
                        visibleItems: 3
                    }
                }
            });

            $("#flexiselDemo3").flexisel({
                visibleItems: 4,
                animationSpeed: 1000,
                autoPlay: true,
                autoPlaySpeed: 3000,
                pauseOnHover: true,
                enableResponsiveBreakpoints: true,
                responsiveBreakpoints: {
                    portrait: {
                        changePoint: 480,
                        visibleItems: 1
                    },
                    landscape: {
                        changePoint: 640,
                        visibleItems: 2
                    },
                    tablet: {
                        changePoint: 768,
                        visibleItems: 3
                    }
                }
            });

            $("#flexiselDemo4").flexisel({
                clone: false
            });

        });
    </script>




    <div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-center">
            <div class="modal-dialog .modal-align-center">
                <div class="modal-content">

                    <div class="modal-body">
                        <div class="loginmodal-container text-center">
                            <i class="fas fa-lock"></i>
                            <h1>دخول المستخدمين </h1>
                            <form>
                                <input type="text" name="user" placeholder="اسم المستخدم">
                                <input type="password" name="pass" placeholder="كلمة المرور">
                                <input type="submit" name="login" class=" loginmodal-submit" value="دخول">
                            </form>
                            <div class="remmberme"> <input type="checkbox" value="lsRememberMe" id="rememberMe">
                                <label for="rememberMe"> تذكرني </label></div>
                            <div class="login-help">
                                <a href="#">مستخدم جديد</a> - <a href="#"> مساعدة </a>
                            </div>

                            <button type="button" class="btn default_button" data-dismiss="modal">إغــلاق</button>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
