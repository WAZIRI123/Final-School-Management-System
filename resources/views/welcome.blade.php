<html lang="en" class=""><head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Varsity | Home</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="  {{asset('storage/img/favicon.ico')}}" type="image/x-icon">
    @vite([
    'resources/css/style.css' , 'resources/css/bootstrap.css','resources/css/font-awesome.css',
   'resources/css/jquery.fancybox.css','resources/css/theme-color/default-theme.css', 'resources/css/slick.css'
,'resources/js/jquery.min.js','resources/js/bootstrap1.js','resources/js/slick.js','resources/js/waypoints.js','resources/js/jquery.counterup.js','resources/js/jquery.mixitup.js','resources/js/jquery.fancybox.pack.js','resources/js/custom.js']);



    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,400italic,300,300italic,500,700" rel="stylesheet" type="text/css">


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

<style type="text/css">.fancybox-margin{margin-right:17px;}</style></head>

<body>

    <!--START SCROLL TOP BUTTON -->
    <a class="scrollToTop" href="#" style="display: none;">
        <i class="fa fa-angle-up"></i>
    </a>
    <!-- END SCROLL TOP BUTTON -->

    <!-- Start header  -->
    <header id="mu-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="mu-header-area">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                <div class="mu-header-top-left">
                                    <div class="mu-top-email">
                                        <i class="fa fa-envelope"></i>
                                        <span>info@markups.io</span>
                                    </div>
                                    <div class="mu-top-phone">
                                        <i class="fa fa-phone"></i>
                                        <span>{{ asset('resources/css/bootstrap.css') }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                <div class="mu-header-top-right">
                                    <nav>
                                        <ul class="mu-top-social-nav">
                                            <li><a href="#"><span class="fa fa-facebook"></span></a></li>
                                            <li><a href="#"><span class="fa fa-twitter"></span></a></li>
                                            <li><a href="#"><span class="fa fa-google-plus"></span></a></li>
                                            <li><a href="#"><span class="fa fa-linkedin"></span></a></li>
                                            <li><a href="#"><span class="fa fa-youtube"></span></a></li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- End header  -->
    <!-- Start menu -->
    <section id="mu-menu">
        <nav class="navbar navbar-default" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <!-- FOR MOBILE VIEW COLLAPSED BUTTON -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
                    <!-- LOGO -->
                    <!-- TEXT BASED LOGO -->
                    <a class="navbar-brand" href="index.html"><i class="fa fa-university"></i><span>Varsity</span></a>
                    <!-- IMG BASED LOGO  -->
                    <!-- <a class="navbar-brand" href="index.html"><img src="assets/img/logo.png" alt="logo"></a> -->
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul id="top-menu" class="nav navbar-nav navbar-right main-nav">
                        <li class="active"><a href="index.html">Home</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Course <span class="fa fa-angle-down"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="course.html">Course Archive</a></li>
                                <li><a href="course-detail.html">Course Detail</a></li>
                            </ul>
                        </li>
                        <li><a href="gallery.html">Gallery</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Blog <span class="fa fa-angle-down"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="blog-archive.html">Blog Archive</a></li>
                                <li><a href="blog-single.html">Blog Single</a></li>
                            </ul>
                        </li>
                        <li><a href="contact.html">Contact</a></li>
                        <li><a href="404.html">404 Page</a></li>
                        <li><a href="#" id="mu-search-icon"><i class="fa fa-search"></i></a></li>
                    </ul>
                </div>
                <!--/.nav-collapse -->
            </div>
        </nav>
    </section>
    <!-- End menu -->
    <!-- Start search box -->
    <div id="mu-search">
        <div class="mu-search-area">
            <button class="mu-search-close"><span class="fa fa-close"></span></button>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <form class="mu-search-form">
                            <input type="search" placeholder="Type Your Keyword(s) &amp; Hit Enter">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End search box -->
    <!-- Start Slider -->
    <section id="mu-slider" class="slick-initialized slick-slider"><button type="button" data-role="none" class="slick-prev slick-arrow" aria-label="Previous" role="button" style="display: block;">Previous</button>
        <!-- Start single slider item -->
        <div aria-live="polite" class="slick-list draggable"><div class="slick-track" role="listbox" style="opacity: 1; width: 1875px; left: -1145.25px;"><div class="mu-slider-single slick-slide slick-cloned" data-slick-index="-1" aria-hidden="true" tabindex="-1" style="width: 375px;">
            <div class="mu-slider-img">
                <figure>
                    <img src=" {{asset('storage/img/slider/3.jpg')}}" alt="img">
                </figure>
            </div>
            <div class="mu-slider-content">
                <h4>Exclusivly For Education</h4>
                <span></span>
                <h2>Education For Everyone</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolor amet error eius reiciendis eum sint unde eveniet deserunt est debitis corporis temporibus recusandae accusamus.</p>
                <a href="#" class="mu-read-more-btn" tabindex="-1">Read More</a>
            </div>
        </div><div class="mu-slider-single slick-slide slick-current slick-active" data-slick-index="0" aria-hidden="false" tabindex="-1" role="option" aria-describedby="slick-slide00" style="width: 375px;">
            <div class="mu-slider-img">
                <figure>
                    <img src="{{asset('storage/img/slider/1.jpg')}}" alt="img">
                </figure>
            </div>
            <div class="mu-slider-content">
                <h4>Welcome To Varsity</h4>
                <span></span>
                <h2>We Will Help You To Learn</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolor amet error eius reiciendis eum sint unde eveniet deserunt est debitis corporis temporibus recusandae accusamus.</p>
                <a href="#" class="mu-read-more-btn" tabindex="-1">Read More</a>
            </div>
        </div><div class="mu-slider-single slick-slide" data-slick-index="1" aria-hidden="true" tabindex="-1" role="option" aria-describedby="slick-slide01" style="width: 375px;">
            <div class="mu-slider-img">
                <figure>
                    <img src="{{ asset('storage/img/slider/1.jpg')}}" alt="img">
                </figure>
            </div>
            <div class="mu-slider-content">
                <h4>Premiumu Quality Free Template</h4>
                <span></span>
                <h2>Best Education Template Ever</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolor amet error eius reiciendis eum sint unde eveniet deserunt est debitis corporis temporibus recusandae accusamus.</p>
                <a href="#" class="mu-read-more-btn" tabindex="-1">Read More</a>
            </div>
        </div><div class="mu-slider-single slick-slide" data-slick-index="2" aria-hidden="true" tabindex="-1" role="option" aria-describedby="slick-slide02" style="width: 375px;">
            <div class="mu-slider-img">
                <figure>
                    <img src="{{asset('storage/img/slider/3.jpg')}}" alt="img">
                </figure>
            </div>
            <div class="mu-slider-content">
                <h4>Exclusivly For Education</h4>
                <span></span>
                <h2>Education For Everyone</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolor amet error eius reiciendis eum sint unde eveniet deserunt est debitis corporis temporibus recusandae accusamus.</p>
                <a href="#" class="mu-read-more-btn" tabindex="0">Read More</a>
            </div>
        </div><div class="mu-slider-single slick-slide slick-cloned" data-slick-index="3" aria-hidden="true" tabindex="-1" style="width: 375px;">
            <div class="mu-slider-img">
                <figure>
                    <img src="{{asset('storage/img/slider/1.jpg')}}" alt="img">
                </figure>
            </div>
            <div class="mu-slider-content">
                <h4>Welcome To Varsity</h4>
                <span></span>
                <h2>We Will Help You To Learn</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolor amet error eius reiciendis eum sint unde eveniet deserunt est debitis corporis temporibus recusandae accusamus.</p>
                <a href="#" class="mu-read-more-btn" tabindex="-1">Read More</a>
            </div>
        </div></div></div>
        <!-- Start single slider item -->
        <!-- Start single slider item -->
        
        <!-- Start single slider item -->
        <!-- Start single slider item -->
        
        <!-- Start single slider item -->
    <button type="button" data-role="none" class="slick-next slick-arrow" aria-label="Next" role="button" style="display: block;">Next</button></section>
    <!-- End Slider -->



    <!-- Start about us counter -->
    <section id="mu-abtus-counter">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="mu-abtus-counter-area">
                        <div class="row">
                            <!-- Start counter item -->
                            <div class="col-lg-3 col-md-3 col-sm-3">
                                <div class="mu-abtus-counter-single">
                                    <span class="fa fa-book"></span>
                                    <h4 class="counter">568</h4>
                                    <p>Subjects</p>
                                </div>
                            </div>
                            <!-- End counter item -->
                            <!-- Start counter item -->
                            <div class="col-lg-3 col-md-3 col-sm-3">
                                <div class="mu-abtus-counter-single">
                                    <span class="fa fa-users"></span>
                                    <h4 class="counter">3500</h4>
                                    <p>Students</p>
                                </div>
                            </div>
                            <!-- End counter item -->
                            <!-- Start counter item -->
                            <div class="col-lg-3 col-md-3 col-sm-3">
                                <div class="mu-abtus-counter-single">
                                    <span class="fa fa-flask"></span>
                                    <h4 class="counter">65</h4>
                                    <p>Modern Lab</p>
                                </div>
                            </div>
                            <!-- End counter item -->
                            <!-- Start counter item -->
                            <div class="col-lg-3 col-md-3 col-sm-3">
                                <div class="mu-abtus-counter-single no-border">
                                    <span class="fa fa-user-secret"></span>
                                    <h4 class="counter">250</h4>
                                    <p>Teachers</p>
                                </div>
                            </div>
                            <!-- End counter item -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End about us counter -->

    <!-- Start testimonial -->
    <section id="mu-testimonial">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="mu-testimonial-area">
                        <div id="mu-testimonial-slide" class="mu-testimonial-content slick-initialized slick-slider" role="toolbar">
                            <!-- start testimonial single item -->
                            <div aria-live="polite" class="slick-list draggable"><div class="slick-track" role="listbox" style="opacity: 1; width: 1525px; left: -610px;"><div class="mu-testimonial-item slick-slide slick-cloned" data-slick-index="-1" aria-hidden="true" tabindex="-1" style="width: 305px;">
                                <div class="mu-testimonial-quote">
                                    <blockquote>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatem rerum soluta aperiam blanditiis obcaecati eveniet aliquam consequatur nobis eaque id.</p>
                                    </blockquote>
                                </div>
                                <div class="mu-testimonial-img">
                                    <img src="{{asset('storage/img/testimonial-2.jpg')}}" alt="img">
                                </div>
                                <div class="mu-testimonial-info">
                                    <h4>Stev Smith</h4>
                                    <span>Happy Student</span>
                                </div>
                            </div><div class="mu-testimonial-item slick-slide" data-slick-index="0" aria-hidden="true" tabindex="-1" role="option" aria-describedby="slick-slide10" style="width: 305px;">
                                <div class="mu-testimonial-quote">
                                    <blockquote>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatem rerum soluta aperiam blanditiis obcaecati eveniet aliquam consequatur nobis eaque id.</p>
                                    </blockquote>
                                </div>
                                <div class="mu-testimonial-img">
                                    <img src="{{asset('storage/img/testimonial-1.jpg')}}" alt="img">
                                </div>
                                <div class="mu-testimonial-info">
                                    <h4>John Doe</h4>
                                    <span>Happy Student</span>
                                </div>
                            </div><div class="mu-testimonial-item slick-slide slick-current slick-active" data-slick-index="1" aria-hidden="false" tabindex="-1" role="option" aria-describedby="slick-slide11" style="width: 305px;">
                                <div class="mu-testimonial-quote">
                                    <blockquote>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatem rerum soluta aperiam blanditiis obcaecati eveniet aliquam consequatur nobis eaque id.</p>
                                    </blockquote>
                                </div>
                                <div class="mu-testimonial-img">
                                    <img src="{{asset('storage/img/testimonial-3.jpg')}}" alt="img">
                                </div>
                                <div class="mu-testimonial-info">
                                    <h4>Rebaca Michel</h4>
                                    <span>Happy Parent</span>
                                </div>
                            </div><div class="mu-testimonial-item slick-slide" data-slick-index="2" aria-hidden="true" tabindex="-1" role="option" aria-describedby="slick-slide12" style="width: 305px;">
                                <div class="mu-testimonial-quote">
                                    <blockquote>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatem rerum soluta aperiam blanditiis obcaecati eveniet aliquam consequatur nobis eaque id.</p>
                                    </blockquote>
                                </div>
                                <div class="mu-testimonial-img">
                                    <img src="{{asset('storage/img/testimonial-2.jpg')}}" alt="img">
                                </div>
                                <div class="mu-testimonial-info">
                                    <h4>Stev Smith</h4>
                                    <span>Happy Student</span>
                                </div>
                            </div><div class="mu-testimonial-item slick-slide slick-cloned" data-slick-index="3" aria-hidden="true" tabindex="-1" style="width: 305px;">
                                <div class="mu-testimonial-quote">
                                    <blockquote>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatem rerum soluta aperiam blanditiis obcaecati eveniet aliquam consequatur nobis eaque id.</p>
                                    </blockquote>
                                </div>
                                <div class="mu-testimonial-img">
                                    <img src="{{asset('storage/img/testimonial-1.jpg')}}" alt="img">
                                </div>
                                <div class="mu-testimonial-info">
                                    <h4>John Doe</h4>
                                    <span>Happy Student</span>
                                </div>
                            </div></div></div>
                            <!-- end testimonial single item -->
                            <!-- start testimonial single item -->
                            
                            <!-- end testimonial single item -->
                            <!-- start testimonial single item -->
                            
                            <!-- end testimonial single item -->
                        <ul class="slick-dots" style="display: block;" role="tablist"><li class="" aria-hidden="true" role="presentation" aria-selected="true" aria-controls="navigation10" id="slick-slide10"><button type="button" data-role="none" role="button" aria-required="false" tabindex="0">1</button></li><li aria-hidden="false" role="presentation" aria-selected="false" aria-controls="navigation11" id="slick-slide11" class="slick-active"><button type="button" data-role="none" role="button" aria-required="false" tabindex="0">2</button></li><li aria-hidden="true" role="presentation" aria-selected="false" aria-controls="navigation12" id="slick-slide12" class=""><button type="button" data-role="none" role="button" aria-required="false" tabindex="0">3</button></li></ul></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End testimonial -->

    <!-- Start features section -->
    <section id="mu-features">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="mu-features-area">
                        <!-- Start Title -->
                        <div class="mu-title">
                            <h2>Our Features</h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Distinctio ipsa ea maxime mollitia, vitae voluptates, quod at, saepe reprehenderit totam aliquam architecto fugiat sunt animi!</p>
                        </div>
                        <!-- End Title -->
                        <!-- Start features content -->
                        <div class="mu-features-content">
                            <div class="row">
                                <div class="col-lg-4 col-md-4  col-sm-6">
                                    <div class="mu-single-feature">
                                        <span class="fa fa-book"></span>
                                        <h4>Professional Courses</h4>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus non dolorem excepturi libero itaque sint labore similique maxime natus eum.</p>
                                        <a href="#">Read More</a>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-6">
                                    <div class="mu-single-feature">
                                        <span class="fa fa-users"></span>
                                        <h4>Expert Teachers</h4>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus non dolorem excepturi libero itaque sint labore similique maxime natus eum.</p>
                                        <a href="#">Read More</a>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-6">
                                    <div class="mu-single-feature">
                                        <span class="fa fa-laptop"></span>
                                        <h4>Online Learning</h4>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus non dolorem excepturi libero itaque sint labore similique maxime natus eum.</p>
                                        <a href="#">Read More</a>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-6">
                                    <div class="mu-single-feature">
                                        <span class="fa fa-microphone"></span>
                                        <h4>Audio Lessons</h4>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus non dolorem excepturi libero itaque sint labore similique maxime natus eum.</p>
                                        <a href="#">Read More</a>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-6">
                                    <div class="mu-single-feature">
                                        <span class="fa fa-film"></span>
                                        <h4>Video Lessons</h4>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus non dolorem excepturi libero itaque sint labore similique maxime natus eum.</p>
                                        <a href="#">Read More</a>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-6">
                                    <div class="mu-single-feature">
                                        <span class="fa fa-certificate"></span>
                                        <h4>Professional Certificate</h4>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus non dolorem excepturi libero itaque sint labore similique maxime natus eum.</p>
                                        <a href="#">Read More</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End features content -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End features section -->

    <!-- Start latest course section -->
    <section id="mu-latest-courses">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="mu-latest-courses-area">
                        <!-- Start Title -->
                        <div class="mu-title">
                            <h2>Latest News</h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Distinctio ipsa ea maxime mollitia, vitae voluptates, quod at, saepe reprehenderit totam aliquam architecto fugiat sunt animi!</p>
                        </div>
                        <!-- End Title -->
                        <!-- Start latest course content -->
                        <div id="mu-latest-course-slide" class="mu-latest-courses-content slick-initialized slick-slider" role="toolbar">
                            
                            
                            
                            
                            
                            



                        <div aria-live="polite" class="slick-list draggable"><div class="slick-track" role="listbox" style="opacity: 1; width: 2760px; left: -1035px;"><div class="col-lg-4 col-md-4 col-xs-12 slick-slide slick-cloned" tabindex="-1" role="option" aria-describedby="slick-slide25" style="width: 345px;" data-slick-index="-1" aria-hidden="true">
                                <div class="mu-latest-course-single">
                                    <figure class="mu-latest-course-img">
                                        <a href="#" tabindex="-1"><img src=" {{asset('storage/img/courses/3.jpg')}}" alt="img"></a>
                                        <figcaption class="mu-latest-course-imgcaption">
                                            <a href="#" tabindex="-1">Inter Class</a>
                                            <span><i class="fa fa-clock-o"></i>12/12/2022</span>
                                        </figcaption>
                                    </figure>
                                    <div class="mu-latest-course-single-content">
                                        <h4><a href="#" tabindex="-1">Lorem ipsum dolor sit amet.</a></h4>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet quod nisi quisquam modi dolore, dicta obcaecati architecto quidem ullam quia.</p>
                                        <div class="mu-latest-course-single-contbottom">
                                            <a class="mu-course-details" href="#" tabindex="-1">Details</a>
                                            <span class="mu-course-price" href="#">$165.00</span>
                                        </div>
                                    </div>
                                </div>
                            </div><div class="col-lg-4 col-md-4 col-xs-12 slick-slide" tabindex="-1" role="option" aria-describedby="slick-slide20" style="width: 345px;" data-slick-index="0" aria-hidden="true">
                                <div class="mu-latest-course-single">
                                    <figure class="mu-latest-course-img">
                                        <a href="#" tabindex="-1"><img src="{{asset('storage/img/courses/1.jpg')}}" alt="img"></a>
                                        <figcaption class="mu-latest-course-imgcaption">
                                            <a href="#" tabindex="-1">Graduation</a>
                                            <span><i class="fa fa-clock-o"></i>02/02/2022</span>
                                        </figcaption>
                                    </figure>
                                    <div class="mu-latest-course-single-content">
                                        <h4><a href="#" tabindex="-1">Lorem ipsum dolor sit amet.</a></h4>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet quod nisi quisquam modi dolore, dicta obcaecati architecto quidem ullam quia.</p>
                                        <div class="mu-latest-course-single-contbottom">
                                            <a class="mu-course-details" href="#" tabindex="-1">Details</a>
                                            <span class="mu-course-price" href="#">$165.00</span>
                                        </div>
                                    </div>
                                </div>
                            </div><div class="col-lg-4 col-md-4 col-xs-12 slick-slide" tabindex="-1" role="option" aria-describedby="slick-slide21" style="width: 345px;" data-slick-index="1" aria-hidden="true">
                                <div class="mu-latest-course-single">
                                    <figure class="mu-latest-course-img">
                                        <a href="#" tabindex="-1"><img src="{{asset('storage/img/courses/2.jpg')}}" alt="img"></a>
                                        <figcaption class="mu-latest-course-imgcaption">
                                            <a href="#" tabindex="-1">School Meeting </a>
                                            <span><i class="fa fa-clock-o"></i>2/02/20022</span>
                                        </figcaption>
                                    </figure>
                                    <div class="mu-latest-course-single-content">
                                        <h4><a href="#" tabindex="-1">Lorem ipsum dolor sit amet.</a></h4>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet quod nisi quisquam modi dolore, dicta obcaecati architecto quidem ullam quia.</p>
                                        <div class="mu-latest-course-single-contbottom">
                                            <a class="mu-course-details" href="#" tabindex="-1">Details</a>
                                            <span class="mu-course-price" href="#">$165.00</span>
                                        </div>
                                    </div>
                                </div>
                            </div><div class="col-lg-4 col-md-4 col-xs-12 slick-slide slick-current slick-active" tabindex="-1" role="option" aria-describedby="slick-slide22" style="width: 345px;" data-slick-index="2" aria-hidden="false">
                                <div class="mu-latest-course-single">
                                    <figure class="mu-latest-course-img">
                                        <a href="#" tabindex="0"><img src="{{asset('storage/img/courses/3.jpg')}}" alt="img"></a>
                                        <figcaption class="mu-latest-course-imgcaption">
                                            <a href="#" tabindex="0">Inter Class</a>
                                            <span><i class="fa fa-clock-o"></i>12/12/2022</span>
                                        </figcaption>
                                    </figure>
                                    <div class="mu-latest-course-single-content">
                                        <h4><a href="#" tabindex="0">Lorem ipsum dolor sit amet.</a></h4>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet quod nisi quisquam modi dolore, dicta obcaecati architecto quidem ullam quia.</p>
                                        <div class="mu-latest-course-single-contbottom">
                                            <a class="mu-course-details" href="#" tabindex="0">Details</a>
                                            <span class="mu-course-price" href="#">$165.00</span>
                                        </div>
                                    </div>
                                </div>
                            </div><div class="col-lg-4 col-md-4 col-xs-12 slick-slide" tabindex="-1" role="option" aria-describedby="slick-slide23" style="width: 345px;" data-slick-index="3" aria-hidden="true">
                                <div class="mu-latest-course-single">
                                    <figure class="mu-latest-course-img">
                                        <a href="#" tabindex="-1"><img src="{{asset('storage/img/courses/1.jpg')}}" alt="img"></a>
                                        <figcaption class="mu-latest-course-imgcaption">
                                            <a href="#" tabindex="-1">Graduation</a>
                                            <span><i class="fa fa-clock-o"></i>02/02/2022</span>
                                        </figcaption>
                                    </figure>
                                    <div class="mu-latest-course-single-content">
                                        <h4><a href="#" tabindex="-1">Lorem ipsum dolor sit amet.</a></h4>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet quod nisi quisquam modi dolore, dicta obcaecati architecto quidem ullam quia.</p>
                                        <div class="mu-latest-course-single-contbottom">
                                            <a class="mu-course-details" href="#" tabindex="-1">Details</a>
                                            <span class="mu-course-price" href="#">$165.00</span>
                                        </div>
                                    </div>
                                </div>
                            </div><div class="col-lg-4 col-md-4 col-xs-12 slick-slide" tabindex="-1" role="option" aria-describedby="slick-slide24" style="width: 345px;" data-slick-index="4" aria-hidden="true">
                                <div class="mu-latest-course-single">
                                    <figure class="mu-latest-course-img">
                                        <a href="#" tabindex="-1"><img src="{{asset('storage/img/courses/2.jpg')}}" alt="img"></a>
                                        <figcaption class="mu-latest-course-imgcaption">
                                            <a href="#" tabindex="-1">School Meeting </a>
                                            <span><i class="fa fa-clock-o"></i>2/02/20022</span>
                                        </figcaption>
                                    </figure>
                                    <div class="mu-latest-course-single-content">
                                        <h4><a href="#" tabindex="-1">Lorem ipsum dolor sit amet.</a></h4>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet quod nisi quisquam modi dolore, dicta obcaecati architecto quidem ullam quia.</p>
                                        <div class="mu-latest-course-single-contbottom">
                                            <a class="mu-course-details" href="#" tabindex="-1">Details</a>
                                            <span class="mu-course-price" href="#">$165.00</span>
                                        </div>
                                    </div>
                                </div>
                            </div><div class="col-lg-4 col-md-4 col-xs-12 slick-slide" tabindex="-1" role="option" aria-describedby="slick-slide25" style="width: 345px;" data-slick-index="5" aria-hidden="true">
                                <div class="mu-latest-course-single">
                                    <figure class="mu-latest-course-img">
                                        <a href="#" tabindex="-1"><img src="{{asset('storage/img/courses/3.jpg')}}" alt="img"></a>
                                        <figcaption class="mu-latest-course-imgcaption">
                                            <a href="#" tabindex="-1">Inter Class</a>
                                            <span><i class="fa fa-clock-o"></i>12/12/2022</span>
                                        </figcaption>
                                    </figure>
                                    <div class="mu-latest-course-single-content">
                                        <h4><a href="#" tabindex="-1">Lorem ipsum dolor sit amet.</a></h4>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet quod nisi quisquam modi dolore, dicta obcaecati architecto quidem ullam quia.</p>
                                        <div class="mu-latest-course-single-contbottom">
                                            <a class="mu-course-details" href="#" tabindex="-1">Details</a>
                                            <span class="mu-course-price" href="#">$165.00</span>
                                        </div>
                                    </div>
                                </div>
                            </div><div class="col-lg-4 col-md-4 col-xs-12 slick-slide slick-cloned" tabindex="-1" role="option" aria-describedby="slick-slide20" style="width: 345px;" data-slick-index="6" aria-hidden="true">
                                <div class="mu-latest-course-single">
                                    <figure class="mu-latest-course-img">
                                        <a href="#" tabindex="-1"><img src="{{asset('storage/img/courses/1.jpg')}}" alt="img"></a>
                                        <figcaption class="mu-latest-course-imgcaption">
                                            <a href="#" tabindex="-1">Graduation</a>
                                            <span><i class="fa fa-clock-o"></i>02/02/2022</span>
                                        </figcaption>
                                    </figure>
                                    <div class="mu-latest-course-single-content">
                                        <h4><a href="#" tabindex="-1">Lorem ipsum dolor sit amet.</a></h4>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet quod nisi quisquam modi dolore, dicta obcaecati architecto quidem ullam quia.</p>
                                        <div class="mu-latest-course-single-contbottom">
                                            <a class="mu-course-details" href="#" tabindex="-1">Details</a>
                                            <span class="mu-course-price" href="#">$165.00</span>
                                        </div>
                                    </div>
                                </div>
                            </div></div></div><ul class="slick-dots" style="display: block;" role="tablist"><li class="" aria-hidden="true" role="presentation" aria-selected="true" aria-controls="navigation20" id="slick-slide20"><button type="button" data-role="none" role="button" aria-required="false" tabindex="0">1</button></li><li aria-hidden="true" role="presentation" aria-selected="false" aria-controls="navigation21" id="slick-slide21" class=""><button type="button" data-role="none" role="button" aria-required="false" tabindex="0">2</button></li><li aria-hidden="false" role="presentation" aria-selected="false" aria-controls="navigation22" id="slick-slide22" class="slick-active"><button type="button" data-role="none" role="button" aria-required="false" tabindex="0">3</button></li><li aria-hidden="true" role="presentation" aria-selected="false" aria-controls="navigation23" id="slick-slide23" class=""><button type="button" data-role="none" role="button" aria-required="false" tabindex="0">4</button></li><li aria-hidden="true" class="" role="presentation" aria-selected="false" aria-controls="navigation24" id="slick-slide24"><button type="button" data-role="none" role="button" aria-required="false" tabindex="0">5</button></li><li aria-hidden="true" role="presentation" aria-selected="false" aria-controls="navigation25" id="slick-slide25" class=""><button type="button" data-role="none" role="button" aria-required="false" tabindex="0">6</button></li></ul></div>
                        <!-- End latest course content -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End latest course section -->

    <!-- Start our teacher -->
    <section id="mu-our-teacher">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="mu-our-teacher-area">
                        <!-- begain title -->
                        <div class="mu-title">
                            <h2>Our Teachers</h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Culpa, repudiandae, suscipit repellat minus molestiae ea.</p>
                        </div>
                        <!-- end title -->
                        <!-- begain our teacher content -->
                        <div class="mu-our-teacher-content">
                            <div class="row">
                                <div class="col-lg-3 col-md-3  col-sm-6">
                                    <div class="mu-our-teacher-single">
                                        <figure class="mu-our-teacher-img">
                                            <img src=" {{asset('storage/img/teachers/teacher-01.jpg')}}" alt="teacher img">
                                            <div class="mu-our-teacher-social">
                                                <a href="#"><span class="fa fa-facebook"></span></a>
                                                <a href="#"><span class="fa fa-twitter"></span></a>
                                                <a href="#"><span class="fa fa-linkedin"></span></a>
                                                <a href="#"><span class="fa fa-google-plus"></span></a>
                                            </div>
                                        </figure>
                                        <div class="mu-ourteacher-single-content">
                                            <h4>Rebeca Michel</h4>
                                            <span>Math Teacher</span>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Similique quod pariatur recusandae odio dignissimos. Eligendi.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-6">
                                    <div class="mu-our-teacher-single">
                                        <figure class="mu-our-teacher-img">
                                            <img src="{{asset('storage/img/teachers/teacher-02.jpg')}}" alt="teacher img">
                                            <div class="mu-our-teacher-social">
                                                <a href="#"><span class="fa fa-facebook"></span></a>
                                                <a href="#"><span class="fa fa-twitter"></span></a>
                                                <a href="#"><span class="fa fa-linkedin"></span></a>
                                                <a href="#"><span class="fa fa-google-plus"></span></a>
                                            </div>
                                        </figure>
                                        <div class="mu-ourteacher-single-content">
                                            <h4>James Hein</h4>
                                            <span>Physics Teacher</span>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Similique quod pariatur recusandae odio dignissimos. Eligendi.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-6">
                                    <div class="mu-our-teacher-single">
                                        <figure class="mu-our-teacher-img">
                                            <img src="{{asset('storage/img/teachers/teacher-03.jpg')}}" alt="teacher img">
                                            <div class="mu-our-teacher-social">
                                                <a href="#"><span class="fa fa-facebook"></span></a>
                                                <a href="#"><span class="fa fa-twitter"></span></a>
                                                <a href="#"><span class="fa fa-linkedin"></span></a>
                                                <a href="#"><span class="fa fa-google-plus"></span></a>
                                            </div>
                                        </figure>
                                        <div class="mu-ourteacher-single-content">
                                            <h4>Brian Dean</h4>
                                            <span>English Teacher</span>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Similique quod pariatur recusandae odio dignissimos. Eligendi.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-6">
                                    <div class="mu-our-teacher-single">
                                        <figure class="mu-our-teacher-img">
                                            <img src="{{asset('storage/img/teachers/teacher-04.jpg')}}" alt="teacher img">
                                            <div class="mu-our-teacher-social">
                                                <a href="#"><span class="fa fa-facebook"></span></a>
                                                <a href="#"><span class="fa fa-twitter"></span></a>
                                                <a href="#"><span class="fa fa-linkedin"></span></a>
                                                <a href="#"><span class="fa fa-google-plus"></span></a>
                                            </div>
                                        </figure>
                                        <div class="mu-ourteacher-single-content">
                                            <h4>John Doe</h4>
                                            <span>Biology Teacher</span>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Similique quod pariatur recusandae odio dignissimos. Eligendi.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End our teacher content -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End our teacher -->

    <!-- Start footer -->
    <footer id="mu-footer">
        <!-- start footer top -->
        <div class="mu-footer-top">
            <div class="container">
                <div class="mu-footer-top-area">
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <div class="mu-footer-widget">
                                <h4>Information</h4>
                                <ul>
                                    <li><a href="#">About Us</a></li>
                                    <li><a href="">Features</a></li>
                                    <li><a href="">Course</a></li>
                                    <li><a href="">Event</a></li>
                                    <li><a href="">Sitemap</a></li>
                                    <li><a href="">Term Of Use</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <div class="mu-footer-widget">
                                <h4>Student Help</h4>
                                <ul>
                                    <li><a href="">Get Started</a></li>
                                    <li><a href="#">My Questions</a></li>
                                    <li><a href="">Download Files</a></li>
                                    <li><a href="">Latest Course</a></li>
                                    <li><a href="">Academic News</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <div class="mu-footer-widget">
                                <h4>News letter</h4>
                                <p>Get latest update, news &amp; academic offers</p>
                                <form class="mu-subscribe-form">
                                    <input type="email" placeholder="Type your Email">
                                    <button class="mu-subscribe-btn" type="submit">Subscribe!</button>
                                </form>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <div class="mu-footer-widget">
                                <h4>Contact</h4>
                                <address>
                  <p>P.O. Box 320, Ross, California 9495, USA</p>
                  <p>Phone: (415) 453-1568 </p>
                  <p>Website: www.markups.io</p>
                  <p>Email: info@markups.io</p>
                </address>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end footer top -->
        <!-- start footer bottom -->
        <div class="mu-footer-bottom">
            <div class="container">
                <div class="mu-footer-bottom-area">
                    <p>© All Right Reserved. Designed by <a href="http://www.markups.io/" rel="nofollow">MarkUps.io</a></p>
                </div>
            </div>
        </div>
        <!-- end footer bottom -->
    </footer>

</body></html>