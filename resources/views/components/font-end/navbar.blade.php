    <!-- Start menu -->
    <section id="mu-menu">
        <nav class="navbar navbar-default " id="mNavbar" role="navigation">
            <div class="container ">
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
                    <a class="navbar-brand" href="/"><i class="fa fa-university"></i><span>Varsity</span></a>
                    <!-- IMG BASED LOGO  -->
                    <!-- <a class="navbar-brand" href="index.html"><img src="assets/img/logo.png" alt="logo"></a> -->
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul id="top-menu" class="nav navbar-nav navbar-right main-nav">
                        <li class="active"><a href="/">Home</a></li>
                        <li><a href="#mu-latest-courses">Our Teachers</a></li>

                        <li><a href="#mu-testimonial">Testimonial</a></li>
                        <li><a href="#mu-features">Our Courses</a></li>
                        <li><a href="{{ route('login') }}">Login</a></li>
                        <li><a href="#" id="mu-search-icon"><i class="fa fa-search"></i></a></li>
                    </ul>
                </div>
                <!--/.nav-collapse -->
            </div>
        </nav>
    </section>
    <!-- End menu -->