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
                                        href="https://workspace.google.com/intl/es-419/gmail/"> contacto techservicetsu@gmail.com</a></li>
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
                                            {{--@if (Route::has('register'))
                                                <li class="d-flex align-items-center"><i class="la la-user mr-1"></i><a
                                                        href="{{ route('register') }}"> Registrarse</a></li>
                                            @endif--}}
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
                                        src="/Frontend/images/logomdr.png" alt="logo"></a>
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
                                            <a href="{{ route('home') }}">Principal <i class="pl-3 fs-12"></i></a>
                                            <a href="{{ route('turismo') }}">Turismo<i class="pl-3 fs-12"></i></a>
                                            <a href="{{ route('noticias') }}">Noticias <i class="pl-3 fs-12"></i></a>
                                            <a href="{{ route('historia') }}">Historia <i class="pl-3 fs-12"></i></a>
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
                    <a href="{{ route('home') }}">Principal</a>
                    <a href="{{ route('turismo') }}">Turismo</a>
                    <a href="{{ route('noticias') }}">Noticias</a>
                    <a href="{{ route('historia') }}">Historia</a>
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

    
    

    {{ $slot }}

    @fluxScripts

    @if (Route::has('login'))
        <div class="h-14.5 hidden lg:block"></div>
    @endif



<section class="footer-area pt-100px">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 responsive-column-half">
                <div class="footer-item">
                    <a href="index.html">
                        <img src="/Frontend/images/logomdr.png" alt="footer logo" class="footer__logo">
                    </a>
                    <ul class="generic-list-item pt-4">
                        <li><a href="tel:+1631237884">74530416</a></li>
                        <li><a href="mailto:support@wbsite.com">techservicetsu@gmail.com</a></li>
                        <li>San Cristobal - Potosi - Bolivia</li>
                    </ul>
                    <h3 class="fs-20 font-weight-semi-bold pt-4 pb-2">Síguenos en</h3>
                    <ul class="social-icons social-icons-styled">
                        <li class="mr-1"><a href="#" class="facebook-bg"><i class="la la-facebook"></i></a></li>
                        <li class="mr-1"><a href="#" class="twitter-bg"><i class="la la-twitter"></i></a></li>
                        <li class="mr-1"><a href="#" class="instagram-bg"><i class="la la-instagram"></i></a></li>
                        <li class="mr-1"><a href="#" class="linkedin-bg"><i class="la la-linkedin"></i></a></li>
                    </ul>
                </div><!-- end footer-item -->
            </div><!-- end col-lg-3 -->
            <div class="col-lg-3 responsive-column-half">
                <div class="footer-item">
                    <h3 class="fs-20 font-weight-semi-bold">Compania</h3>
                    <span class="section-divider section--divider"></span>
                    <ul class="generic-list-item">
                        <li><a href="#">Sobre nosotros</a></li>
                        <li><a href="#">Contáctanos</a></li>
                        <li><a href="#">Conviértete en profesor</a></li>
                        <li><a href="#">Soporte</a></li>
                        <li><a href="#">Preguntas Frecuentes</a></li>
                        <li><a href="#">Blog</a></li>
                    </ul>
                </div><!-- end footer-item -->
            </div><!-- end col-lg-3 -->
            <div class="col-lg-3 responsive-column-half">
                <div class="footer-item">
                    <h3 class="fs-20 font-weight-semi-bold">Cursos</h3>
                    <span class="section-divider section--divider"></span>
                    <ul class="generic-list-item">
                        <li><a href="#">Desarrollo Web</a></li>
                        <li><a href="#">Hacking</a></li>
                        <li><a href="#">Aprendizaje de PHP</a></li>
                        <li><a href="#">Inglés Hablado</a></li>
                        <li><a href="#">Coche Autónomo</a></li>
                        <li><a href="#">Recolección de Basura</a></li>
                    </ul>
                </div><!-- end footer-item -->
            </div><!-- end col-lg-3 -->
            <div class="col-lg-3 responsive-column-half">
                <div class="footer-item">
                    <h3 class="fs-20 font-weight-semi-bold">Descargar App</h3>
                    <span class="section-divider section--divider"></span>
                    <div class="mobile-app">
                        <p class="pb-3 lh-24">Descarga nuestra aplicación móvil y aprende sobre la marcha.</p>
                    </div>
                </div><!-- end footer-item -->
            </div><!-- end col-lg-3 -->
        </div><!-- end row -->
    </div><!-- end container -->
    <div class="section-block"></div>
    <div class="copyright-content py-4">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <p class="copy-desc">&copy; 2025 San Cristobal. Todos los derechos reservados. Por <a href="https://techydevs.com/">TechService</a></p>
                </div><!-- end col-lg-6 -->
                <div class="col-lg-6">
                    
                </div><!-- end col-lg-6 -->
            </div><!-- end row -->
        </div><!-- end container -->
    </div><!-- end copyright-content -->
</section><!-- end footer-area -->
<!-- ================================
          END FOOTER AREA
-->

</body>

</html>

