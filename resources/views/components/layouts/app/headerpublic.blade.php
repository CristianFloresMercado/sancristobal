<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
       @include('partials.headpublic')
</head>

<body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] flex p-6 lg:p-8 items-center lg:justify-center min-h-screen flex-col">
    
    <header class="header-menu-area bg-white">
        <div class="header-top pr-150px pl-150px border-bottom border-bottom-gray py-1">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="header-widget">
                            <ul class="generic-list-item d-flex flex-wrap align-items-center fs-14">
                                <li class="d-flex align-items-center pr-3 mr-3 border-right border-right-gray"><i
                                        class="la la-phone mr-1"></i><a href="tel:00123456789"> (00) 74530416</a></li>
                                <li class="d-flex align-items-center"><i class="la la-envelope-o mr-1"></i><a
                                        href="mailto:contact@aduca.com"> contacto@techservicetsu@gmail.com</a></li>
                            </ul>
                        </div><!-- end header-widget -->
                    </div><!-- end col-lg-6 -->

                    <div class="col-lg-6">
                        <div class="header-widget d-flex flex-wrap align-items-center justify-content-end">
                            <div class="theme-picker d-flex align-items-center">
                                <button class="theme-picker-btn dark-mode-btn" title="Dark mode">
                                    <svg id="moon" viewBox="0 0 24 24" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path>
                                    </svg>
                                </button>
                                <button class="theme-picker-btn light-mode-btn" title="Light mode">
                                    <svg id="sun" viewBox="0 0 24 24" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <circle cx="12" cy="12" r="5"></circle>
                                        <line x1="12" y1="1" x2="12" y2="3"></line>
                                        <line x1="12" y1="21" x2="12" y2="23"></line>
                                        <line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line>
                                        <line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line>
                                        <line x1="1" y1="12" x2="3" y2="12"></line>
                                        <line x1="21" y1="12" x2="23" y2="12"></line>
                                        <line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line>
                                        <line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line>
                                    </svg>
                                </button>
                            </div>
                            <ul
                                class="generic-list-item d-flex flex-wrap align-items-center fs-14 border-left border-left-gray pl-3 ml-3">
                                @if (Route::has('login'))
                                    <nav class="flex items-center justify-end gap-4">
                                        @auth
                                            <li class="d-flex align-items-center pr-3 mr-3 border-right border-right-gray">
                                                <i class="la la-sign-in mr-1"></i><a href="{{ url('/dashboard') }}">
                                                    HOGAR</a>
                                            </li>
                                        @else
                                            <li class="d-flex align-items-center pr-3 mr-3 border-right border-right-gray">
                                                <i class="la la-sign-in mr-1"></i><a href="{{ route('login') }}"> Login</a>
                                            </li>
                                            @if (Route::has('register'))
                                                <li class="d-flex align-items-center"><i class="la la-user mr-1"></i><a
                                                        href="{{ route('register') }}"> Registrarse</a></li>
                                            @endif
                                        @endauth
                                    </nav>
                                @endif
                            </ul>
                        </div><!-- end header-widget -->
                    </div><!-- end col-lg-6 -->
                </div><!-- end row -->
            </div><!-- end container-fluid -->
        </div><!-- end header-top -->

        <div class="header-menu-content pr-150px pl-150px bg-white">
            <div class="container-fluid">
                <div class="main-menu-content">
                    <a href="#" class="down-button"><i class="la la-angle-down"></i></a>
                    <div class="row align-items-center">
                        <div class="col-lg-2">
                            <div class="logo-box">
                                <a href="index.html" class="logo"><img
                                        src="resources/css/FrontendTheme/images/logo.png" alt="logo"></a>
                                <div class="user-btn-action">
                                    <div class="search-menu-toggle icon-element icon-element-sm shadow-sm mr-2"
                                        data-toggle="tooltip" data-placement="top" title="Search">
                                        <i class="la la-search"></i>
                                    </div>


                                    <div class="off-canvas-menu-toggle main-menu-toggle icon-element icon-element-sm shadow-sm"
                                        data-toggle="tooltip" data-placement="top" title="Menu">
                                        <i class="la la-bars"></i>
                                    </div>
                                </div>
                            </div>
                        </div><!-- end col-lg-2 -->
                        <div class="col-lg-10">
                            <div class="menu-wrapper">

                                <form method="post">
                                    <div class="form-group mb-0">
                                        <input class="form-control form--control pl-3" type="text" name="search"
                                            placeholder="Search for anything">
                                        <span class="la la-search search-icon"></span>
                                    </div>
                                </form>
                                <nav class="main-menu">
                                    <ul>
                                        <li>
                                            <a href="#">Principal <i class="la la-angle-down fs-12"></i></a>
                                            <a href="#">Turismo<i class="la la-angle-down fs-12"></i></a>
                                            <a href="#">Noticias <i class="la la-angle-down fs-12"></i></a>
                                            <a href="#">Historia <i class="la la-angle-down fs-12"></i></a>
                                            <a href="#">Home <i class="la la-angle-down fs-12"></i></a>
                                        </li>
                                    </ul><!-- end ul -->
                                </nav><!-- end main-menu -->
                            </div><!-- end menu-wrapper -->
                        </div><!-- end col-lg-10 -->
                    </div><!-- end row -->
                </div>
            </div><!-- end container-fluid -->
        </div><!-- end header-menu-content -->

        <!--NAVEGACION MOVIL -->

        <div class="off-canvas-menu custom-scrollbar-styled main-off-canvas-menu">
            <div class="off-canvas-menu-close main-menu-close icon-element icon-element-sm shadow-sm"
                data-toggle="tooltip" data-placement="left" title="Close menu">
                <i class="la la-times"></i>
            </div><!-- end off-canvas-menu-close -->
            <ul class="generic-list-item off-canvas-menu-list pt-90px">
                <li>
                    <a href="#">Home</a>
                    <ul class="sub-menu">
                        <li><a href="index.html">Home One</a></li>
                        <li><a href="home-2.html">Home Two</a></li>
                    </ul>
                </li>
            </ul>
        </div><!-- end off-canvas-menu -->


        <div class="mobile-search-form">
            <div class="d-flex align-items-center">
                <form method="post" class="flex-grow-1 mr-3">
                    <div class="form-group mb-0">
                        <input class="form-control form--control pl-3" type="text" name="search"
                            placeholder="Search for anything">
                        <span class="la la-search search-icon"></span>
                    </div>
                </form>
                <div class="search-bar-close icon-element icon-element-sm shadow-sm">
                    <i class="la la-times"></i>
                </div><!-- end off-canvas-menu-close -->
            </div>
        </div><!-- end mobile-search-form -->
    </header><!-- end header-menu-area -->

    <section class="hero-area">
        <div class="hero-slider owl-action-styled">
            <div class=" "
                style="background-image: url('https://boliviatravelsite.com/Images/Attractionphotos/san-cristobal-01.jpg'); background-size: cover; background-position: center;">

                <div class="container">
                    <div class="hero-content">
                        <div class="section-heading">
                            <h2 class="section__title text-white fs-65 lh-80 pb-3">We Help You Learn <br> What You Love
                            </h2>
                            <p class="section__desc text-white pb-4">Emply dummy text of the printing and typesetting
                                industry orem Ipsum has been the
                                <br>industry's standard dummy text ever sinceprinting and typesetting industry.
                            </p>
                        </div><!-- end section-heading -->
                        <div class="hero-btn-box d-flex flex-wrap align-items-center pt-1">
                            <a href="admission.html" class="btn theme-btn mr-4 mb-4">Join with Us <i
                                    class="la la-arrow-right icon ml-1"></i></a>
                            <a href="#" class="btn-text video-play-btn mb-4" data-fancybox
                                data-src="https://www.youtube.com/watch?v=cRXm1p-CNyk">
                                Watch Preview<i class="la la-play icon-btn ml-2"></i>
                            </a>
                        </div><!-- end hero-btn-box -->
                    </div><!-- end hero-content -->
                </div><!-- end container -->
            </div><!-- end hero-slider-item -->
            <div class="hero-slider-item hero-bg-2">
                <div class="container">
                    <div class="hero-content text-center">
                        <div class="section-heading">
                            <h2 class="section__title text-white fs-65 lh-80 pb-3">Join Aduca & Get <br> Your Free
                                Courses!</h2>
                            <p class="section__desc text-white pb-4">Emply dummy text of the printing and typesetting
                                industry orem Ipsum has been the
                                <br>industry's standard dummy text ever sinceprinting and typesetting industry.
                            </p>
                        </div><!-- end section-heading -->
                        <div class="hero-btn-box d-flex flex-wrap align-items-center pt-1 justify-content-center">
                            <a href="admission.html" class="btn theme-btn mr-4 mb-4">Get Started <i
                                    class="la la-arrow-right icon ml-1"></i></a>
                            <a href="#" class="btn-text video-play-btn mb-4" data-fancybox
                                data-src="https://www.youtube.com/watch?v=cRXm1p-CNyk">
                                Watch Preview<i class="la la-play icon-btn ml-2"></i>
                            </a>
                        </div><!-- end hero-btn-box -->
                    </div><!-- end hero-content -->
                </div><!-- container -->
            </div><!-- end hero-slider-item -->
            <div class="hero-slider-item hero-bg-3">
                <div class="container">
                    <div class="hero-content text-right">
                        <div class="section-heading">
                            <h2 class="section__title text-white fs-65 lh-80 pb-3">Learn Anything, <br> Anytime,
                                Anywhere</h2>
                            <p class="section__desc text-white pb-4">Emply dummy text of the printing and typesetting
                                industry orem Ipsum has been the
                                <br>industry's standard dummy text ever sinceprinting and typesetting industry.
                            </p>
                        </div>
                        <div class="hero-btn-box d-flex flex-wrap align-items-center pt-1 justify-content-end">
                            <a href="#" class="btn-text video-play-btn mr-4 mb-4" data-fancybox
                                data-src="https://www.youtube.com/watch?v=cRXm1p-CNyk">
                                <i class="la la-play icon-btn mr-2"></i>Watch Preview
                            </a>
                            <a href="admission.html" class="btn theme-btn mb-4"><i
                                    class="la la-arrow-left icon mr-1"></i>Get Enrolled </a>
                        </div><!-- end hero-btn-box -->
                    </div><!-- end hero-content -->
                </div><!-- container -->
            </div><!-- end hero-slider-item -->
        </div><!-- end hero-slide -->
    </section><!-- end hero-area -->
    

    {{ $slot }}

    @fluxScripts

    @if (Route::has('login'))
        <div class="h-14.5 hidden lg:block"></div>
    @endif
</body>

</html>

