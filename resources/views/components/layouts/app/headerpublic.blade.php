<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('partials.headpublic')
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
</head>
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<body style="background-color:#FDFDFC;color:#1b1b18;min-height:100vh;font-family:Inter,sans-serif;">
    <script>!function(){document.documentElement.classList.remove('dark','dark-theme');document.documentElement.style.colorScheme='light'}();</script>

    <header class="header-menu-area bg-white">
        <div class="header-top pr-150px pl-150px border-bottom border-bottom-gray py-1">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="header-widget">
                            <ul class="generic-list-item d-flex flex-wrap align-items-center fs-14">
                                <li class="d-flex align-items-center pr-3 mr-3 border-right border-right-gray"><i
                                        class="la la-phone mr-1"></i><a
                                        href="https://wa.me/59174530416?text=Hola%20quiero%20más%20información"> (+591)
                                        74530416</a></li>
                                <li class="d-flex align-items-center"><i class="la la-envelope-o mr-1"></i><a
                                        href="https://mail.google.com/mail/?view=cm&fs=1&to=techservicetsu@gmail.com&su=Consulta%20desde%20la%20web&body=Hola,%20quiero%20más%20información%20sobre%20sus%20servicios.">
                                        contacto
                                        techservicetsu@gmail.com</a></li>
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
                                            {{-- @if (Route::has('register'))
                                                <li class="d-flex align-items-center"><i class="la la-user mr-1"></i><a
                                                        href="{{ route('register') }}"> Registrarse</a></li>
                                            @endif --}}
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
                                <a href="{{ route('home') }}" class="logo"><img src="/images/logomdr.png"
                                        alt="logo"></a>
                                <div class="user-btn-action">
                                    {{-- <div class="search-menu-toggle icon-element icon-element-sm shadow-sm mr-2"
                                        data-toggle="tooltip" data-placement="top" title="Searcdsah">
                                        <i class="la la-search"></i>
                                    </div> --}}


                                    <div class="off-canvas-menu-toggle main-menu-toggle icon-element icon-element-sm shadow-sm"
                                        data-bs-toggle="tooltip" data-bs-placement="top" title="">
                                        <i class="la la-bars"></i>
                                    </div>
                                </div>
                            </div>
                        </div><!-- end col-lg-2 -->
                        <div class="col-lg-10">
                            <div class="menu-wrapper">
                                {{-- boton de busqueda --}}
                                {{-- <form method="post">
                                    <div class="form-group mb-0">
                                        <input class="form-control form--control pl-3" type="text" name="search"
                                            placeholder="Search for anything">
                                        <span class="la la-search search-icon"></span>
                                    </div>
                                </form> --}}
                                <nav class="main-menu">
                                    <ul>
                                        <li>
                                            <a href="{{ route('home') }}">Principal</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('turismo') }}">Turismo</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('noticias') }}">Noticias</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('negocios') }}">Negocios</a>
                                        </li>
                                    </ul>
                                </nav>
                            </div><!-- end menu-wrapper -->
                        </div><!-- end col-lg-10 -->
                    </div><!-- end row -->
                </div>
            </div><!-- end container-fluid -->
        </div><!-- end header-menu-content -->

        <!--NAVEGACION MOVIL -->

        <div class="off-canvas-menu custom-scrollbar-styled main-off-canvas-menu">
            <div class="off-canvas-menu-close main-menu-close icon-element icon-element-sm shadow-sm"
                data-bs-toggle="tooltip" data-bs-placement="left" title="">
                <i class="la la-times"></i>
            </div><!-- end off-canvas-menu-close -->
            <div style="padding: 30px 20px 15px; border-bottom: 1px solid #e8e8e8;">
                <a href="{{ route('home') }}" style="display:flex;align-items:center;gap:10px;text-decoration:none;">
                    <img src="/image/imagenicono.png" alt="logo" style="width:44px;height:44px;border-radius:10px;object-fit:cover;background:#fff;padding:3px;box-shadow:0 2px 8px rgba(26,35,126,0.15);">
                    <span style="font-weight:700;font-size:16px;color:#1a237e;line-height:1.2;">San Cristóbal<br><span style="font-weight:400;font-size:12px;color:#64748b;">Portal Comunitario</span></span>
                </a>
            </div>
            <ul class="generic-list-item off-canvas-menu-list pt-3" style="padding: 12px 0;">
                <li style="margin-bottom:0;"><a href="{{ route('home') }}" style="padding:14px 20px;display:flex;align-items:center;gap:12px;font-size:15px;font-weight:500;color:#1e293b;border-right:3px solid transparent;transition:all .2s;" onmouseover="this.style.color='#1a237e';this.style.borderRightColor='#1a237e';this.style.backgroundColor='rgba(26,35,126,0.04)'" onmouseout="this.style.color='#1e293b';this.style.borderRightColor='transparent';this.style.backgroundColor='transparent'"><i class="la la-home" style="font-size:20px;width:24px;text-align:center;color:#1a237e;"></i> Principal</a></li>
                <li style="margin-bottom:0;"><a href="{{ route('turismo') }}" style="padding:14px 20px;display:flex;align-items:center;gap:12px;font-size:15px;font-weight:500;color:#1e293b;border-right:3px solid transparent;transition:all .2s;" onmouseover="this.style.color='#1a237e';this.style.borderRightColor='#1a237e';this.style.backgroundColor='rgba(26,35,126,0.04)'" onmouseout="this.style.color='#1e293b';this.style.borderRightColor='transparent';this.style.backgroundColor='transparent'"><i class="la la-map-marker" style="font-size:20px;width:24px;text-align:center;color:#1a237e;"></i> Turismo</a></li>
                <li style="margin-bottom:0;"><a href="{{ route('noticias') }}" style="padding:14px 20px;display:flex;align-items:center;gap:12px;font-size:15px;font-weight:500;color:#1e293b;border-right:3px solid transparent;transition:all .2s;" onmouseover="this.style.color='#1a237e';this.style.borderRightColor='#1a237e';this.style.backgroundColor='rgba(26,35,126,0.04)'" onmouseout="this.style.color='#1e293b';this.style.borderRightColor='transparent';this.style.backgroundColor='transparent'"><i class="la la-newspaper-o" style="font-size:20px;width:24px;text-align:center;color:#1a237e;"></i> Noticias</a></li>
                <li style="margin-bottom:0;"><a href="{{ route('negocios') }}" style="padding:14px 20px;display:flex;align-items:center;gap:12px;font-size:15px;font-weight:500;color:#1e293b;border-right:3px solid transparent;transition:all .2s;" onmouseover="this.style.color='#1a237e';this.style.borderRightColor='#1a237e';this.style.backgroundColor='rgba(26,35,126,0.04)'" onmouseout="this.style.color='#1e293b';this.style.borderRightColor='transparent';this.style.backgroundColor='transparent'"><i class="la la-briefcase" style="font-size:20px;width:24px;text-align:center;color:#1a237e;"></i> Negocios</a></li>
            </ul>
        </div><!-- end off-canvas-menu -->
    </header><!-- end header-menu-area -->




    {{ $slot }}

    @if (Route::has('login'))
        <div class="h-14.5 hidden lg:block"></div>
    @endif



    <div style="background:#0d47a1;color:#fff;padding:12px 0;text-align:center;font-size:0.85rem;">
        <div class="container d-flex flex-wrap justify-content-center align-items-center gap-2">
            <span>💰 <strong>Paga y cobra en todo el mundo con Takenos</strong> — ¿Necesitas dólares? Convierte BS a $ fácil y rápido.</span>
            <a href="https://takenos.go.link/?adj_t=1ptq1hru&adj_label=cristianfloresmer" target="_blank" class="btn btn-sm btn-light fw-bold" style="color:#0d47a1;padding:4px 14px;font-size:0.8rem;">Unirme</a>
        </div>
    </div>

    <footer style="background:#1a237e;color:#fff;padding:40px 0 0;">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-5 col-md-6">
                    <div class="d-flex align-items-center gap-2 mb-3">
                        <img src="/image/imagenicono.png" alt="logo" style="width:40px;height:40px;border-radius:8px;object-fit:cover;">
                        <span style="font-family:Georgia,serif;font-size:1.1rem;font-weight:700;">San Cristóbal</span>
                    </div>
                    <p style="font-size:0.88rem;color:#cfd8dc;line-height:1.7;">Portal comunitario de información, turismo y negocios locales de San Cristóbal, Potosí - Bolivia.</p>
                    <ul class="list-unstyled mt-3" style="font-size:0.85rem;color:#cfd8dc;">
                        <li class="mb-2"><i class="la la-map-marker me-2" style="color:#90caf9;"></i>San Cristóbal - Potosí - Bolivia</li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h6 class="fw-bold mb-3 text-white" style="font-size:0.95rem;">Navegación</h6>
                    <ul class="list-unstyled" style="font-size:0.85rem;">
                        <li class="mb-2"><a href="{{ route('home') }}" style="color:#e3f2fd;text-decoration:none;">Inicio</a></li>
                        <li class="mb-2"><a href="{{ route('turismo') }}" style="color:#e3f2fd;text-decoration:none;">Turismo</a></li>
                        <li class="mb-2"><a href="{{ route('noticias') }}" style="color:#e3f2fd;text-decoration:none;">Noticias</a></li>
                        <li class="mb-2"><a href="{{ route('negocios') }}" style="color:#e3f2fd;text-decoration:none;">Negocios</a></li>
                    </ul>
                </div>
                <div class="col-lg-4 col-md-6">
                    <h6 class="fw-bold mb-3 text-white" style="font-size:0.95rem;">Contacto</h6>
                    <ul class="list-unstyled" style="font-size:0.85rem;color:#e3f2fd;">
                        <li class="mb-2"><i class="la la-phone me-2"></i>+591 74530416</li>
                        <li class="mb-2"><i class="la la-envelope me-2"></i>techservicetsu@gmail.com</li>
                        <li><i class="la la-map-marker me-2"></i>San Cristóbal - Potosí</li>
                    </ul>
                </div>
            </div>
        </div>
        <div style="border-top:1px solid rgba(255,255,255,0.15);margin-top:35px;">
            <div class="container py-3">
                <div class="d-flex flex-wrap justify-content-between align-items-center" style="font-size:0.8rem;color:#90caf9;">
                    <span>&copy; {{ date('Y') }} San Cristóbal. Todos los derechos reservados.</span>
                    <span>Por <a href="https://techserviceweb.com/" style="color:#fff;text-decoration:none;">TechService</a></span>
                </div>
            </div>
        </div>
    </footer>
    <!-- ================================
          END FOOTER AREA
-->

    <script>
        function showMessage(curso) {
            alert("Estamos trabajando en el curso de " + curso);
        }

        /* Public dark mode toggle */
        document.addEventListener('DOMContentLoaded', function() {
            var html = document.documentElement;
            var darkBtn = document.querySelector('.dark-mode-btn');
            var lightBtn = document.querySelector('.light-mode-btn');

            if (darkBtn) {
                darkBtn.addEventListener('click', function() {
                    html.classList.add('dark-theme', 'dark');
                    html.classList.remove('light-theme');
                    localStorage.setItem('flux-theme', 'dark');
                    localStorage.setItem('sancristobal-theme', 'dark');
                });
            }
            if (lightBtn) {
                lightBtn.addEventListener('click', function() {
                    html.classList.remove('dark-theme', 'dark');
                    html.classList.add('light-theme');
                    localStorage.setItem('flux-theme', 'light');
                    localStorage.setItem('sancristobal-theme', 'light');
                });
            }
        });
    </script>

</body>

</html>
