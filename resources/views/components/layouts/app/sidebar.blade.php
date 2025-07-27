@php
    $groups = [
        'Plataforma' => [
            [
                'name' => 'Dashboard',
                'icon' => 'home', // 🏠 Dashboard → mantiene
                'url' => route('dashboard'),
                'current' => request()->routeIs('dashboard'),
            ],
            [
                'name' => 'Noticias',
                'icon' => 'news', // 📰 Noticias → mantiene
                'url' => route('admin.news.index'),
                'current' => request()->routeIs('admin.news.*'),
            ],
            [
                'name' => 'Historia',
                'icon' => 'book-open', // 📖 Historia
                'url' => route('admin.stories.index'), // <- quizás esta ruta debería cambiar si tienes otra tabla para Historia
                'current' => request()->routeIs('admin.history.*'),
            ],
            [
                'name' => 'Turismo',
                'icon' => 'map', // 🗺️ Turismo
                'url' => route('admin.tourists.index'), // <- ajusta esta ruta si es necesario
                'current' => request()->routeIs('admin.tourists.*'),
            ],
        ],
    ];
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    @include('partials.head')
</head>

<body>
    <!--wrapper-->
    <div class="wrapper">
        <!--sidebar wrapper -->
        <div class="sidebar-wrapper" data-simplebar="true">
            <div class="sidebar-header">
                <div>
                    <a href="{{ route('home') }}">
                        <img src="/Frontend/images/logomdr.png" alt="logo icon">
                    </a>
                </div>

                <div class="toggle-icon ms-auto"><i class='bx bx-arrow-back'></i>
                </div>
            </div>
            <!--navigation-->
            <ul class="metismenu" id="menu">
                @foreach ($groups as $group => $items)
                    <li class="menu-label">{{ $group }}</li>
                    @foreach ($items as $item)
                        <li>
                            <a href="{{ $item['url'] }}" class="{{ $item['current'] ? 'active' : '' }}">
                                <div class="parent-icon"><i class='bx bx-{{ $item['icon'] }}'></i>
                                </div>
                                <div class="menu-title">{{ $item['name'] }}</div>
                            </a>
                        </li>
                    @endforeach
                @endforeach


            </ul>
            <!--end navigation-->
        </div>
        <!--end sidebar wrapper -->
        <!--start header -->
        <header>
            <div class="topbar d-flex align-items-center">
                <nav class="navbar navbar-expand gap-3">
                    <div class="mobile-toggle-menu"><i class='bx bx-menu'></i>
                    </div>

                    <div class="position-relative search-bar d-lg-block d-none" data-bs-toggle="modal"
                        data-bs-target="#SearchModal">
                        <input class="form-control px-5" disabled type="search" placeholder="Search">
                        <span
                            class="position-absolute top-50 search-show ms-3 translate-middle-y start-0 top-50 fs-5"><i
                                class='bx bx-search'></i></span>
                    </div>


                    <div class="top-menu ms-auto">
                        <ul class="navbar-nav align-items-center gap-1">
                            <li class="nav-item mobile-search-icon d-flex d-lg-none" data-bs-toggle="modal"
                                data-bs-target="#SearchModal">
                                <a class="nav-link" href="avascript:;"><i class='bx bx-search'></i>
                                </a>
                            </li>
                            <li class="nav-item dropdown dropdown-laungauge d-none d-sm-flex">
                                <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="avascript:;"
                                    data-bs-toggle="dropdown"><img src="assets/images/county/02.png" width="22"
                                        alt="">
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item d-flex align-items-center py-2" href="javascript:;"><img
                                                src="assets/images/county/01.png" width="20" alt=""><span
                                                class="ms-2">English</span></a>
                                    </li>
                                    <li><a class="dropdown-item d-flex align-items-center py-2" href="javascript:;"><img
                                                src="assets/images/county/02.png" width="20" alt=""><span
                                                class="ms-2">Catalan</span></a>
                                    </li>
                                    <li><a class="dropdown-item d-flex align-items-center py-2" href="javascript:;"><img
                                                src="assets/images/county/03.png" width="20" alt=""><span
                                                class="ms-2">French</span></a>
                                    </li>
                                    <li><a class="dropdown-item d-flex align-items-center py-2" href="javascript:;"><img
                                                src="assets/images/county/04.png" width="20" alt=""><span
                                                class="ms-2">Belize</span></a>
                                    </li>
                                    <li><a class="dropdown-item d-flex align-items-center py-2" href="javascript:;"><img
                                                src="assets/images/county/05.png" width="20" alt=""><span
                                                class="ms-2">Colombia</span></a>
                                    </li>
                                    <li><a class="dropdown-item d-flex align-items-center py-2" href="javascript:;"><img
                                                src="assets/images/county/06.png" width="20" alt=""><span
                                                class="ms-2">Spanish</span></a>
                                    </li>
                                    <li><a class="dropdown-item d-flex align-items-center py-2" href="javascript:;"><img
                                                src="assets/images/county/07.png" width="20" alt=""><span
                                                class="ms-2">Georgian</span></a>
                                    </li>
                                    <li><a class="dropdown-item d-flex align-items-center py-2" href="javascript:;"><img
                                                src="assets/images/county/08.png" width="20" alt=""><span
                                                class="ms-2">Hindi</span></a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item dark-mode d-none d-sm-flex">
                                <a class="nav-link dark-mode-icon" href="javascript:;"><i class='bx bx-moon'></i>
                                </a>
                            </li>

                            <li class="nav-item dropdown dropdown-app">
                                <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" data-bs-toggle="dropdown"
                                    href="javascript:;"><i class='bx bx-grid-alt'></i></a>
                                <div class="dropdown-menu dropdown-menu-end p-0">
                                    <div class="app-container p-2 my-2">
                                        <div class="row gx-0 gy-2 row-cols-3 justify-content-center p-2">

                                            // aqui se puede poner columnas de aplicaciones

                                        </div><!--end row-->

                                    </div>
                                </div>
                            </li>

                            <li class="nav-item dropdown dropdown-large">
                                <a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative"
                                    href="#" data-bs-toggle="dropdown"><span class="alert-count">7</span>
                                    <i class='bx bx-bell'></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">

                                    <div class="header-notifications-list">

                                        <a class="dropdown-item" href="javascript:;">
                                            <div class="d-flex align-items-center">
                                                <div class="user-online">
                                                    <img src="{{ asset('Backend/assets/images/avatars/avatar-8.png') }}"
                                                        class="msg-avatar" alt="user avatar">
                                                </div>
                                                <div class="flex-grow-1">
                                                    <h6 class="msg-name">Pedro Valencia <span
                                                            class="msg-time float-end">6 hrs
                                                            atras</span></h6>
                                                    <p class="msg-info">Se popularizó en la década de 1960</p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <a href="javascript:;">
                                        <div class="text-center msg-footer">
                                            <button class="btn btn-primary w-100">Ver todas las
                                                notificaciones|</button>
                                        </div>
                                    </a>
                                </div>
                            </li>
                            <li class="nav-item dropdown dropdown-large">
                                <a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative"
                                    href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <span class="alert-count">8</span>
                                    <i class='bx bx-shopping-bag'></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">

                                    <div class="header-message-list">


                                    </div>

                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="user-box dropdown px-3">
                        <a class="d-flex align-items-center nav-link dropdown-toggle gap-3 dropdown-toggle-nocaret"
                            href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="{{ asset('Backend/assets/images/avatars/avatar-1.png') }}" class="user-img"
                                alt="user avatar">
                            <div class="user-info">
                                <p class="user-name mb-0">{{ auth()->user()->name }}
                                    ({{ auth()->user()->initials() }})</p>
                                <p class="designattion mb-0">Administrador</p>
                            </div>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            </li>
                            <li><a class="dropdown-item d-flex align-items-center"
                                    href="{{ route('settings.profile') }}"><i
                                        class="bx bx-cog fs-5"></i><span>Configuración</span></a>
                            </li>
                            <li>
                                <a class="dropdown-item d-flex align-items-center" href="#"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="bx bx-log-out-circle"></i>
                                    <span>Cerrar sesión</span>
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </header>

        {{ $slot }}

        @if (session('swal'))
            <script>
                Swal.fire(@json(session('swal')));
            </script>
        @endif

        @fluxScripts



        <div class="overlay toggle-icon"></div>
        <!--end overlay-->
        <!--Start Back To Top Button-->
        <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
        <!--End Back To Top Button-->
        <footer class="page-footer">
            <p class="mb-0">Copyright © 2025 todos los derechos reservados</p>
        </footer>
    </div>
    <!--end wrapper-->








</body>



</html>
