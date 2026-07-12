<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="light-theme">

<head>
    @include('partials.head')
</head>

<body>
    @php
        $notificacionesCount = 0;
        if (auth()->user()->isAdmin()) {
            $notificacionesCount = \App\Models\Negocio::where('plan_estado', 'activo')
                ->where('plan_fecha_fin', '<=', now()->addDays(7))
                ->where('plan_fecha_fin', '>', now())
                ->count();
        }
    @endphp
    <style>
        .page-wrapper { position: relative; z-index: 1; }
        @media screen and (min-width: 1025px) {
            .wrapper.toggled:not(.sidebar-hovered) .sidebar-header img {
                display: none;
            }
        }
        @media (max-width: 1024px) {
            .sidebar-wrapper { left: -250px; transition: left .2s ease-out; z-index: 1050; }
            .wrapper.toggled .sidebar-wrapper { left: 0; }
            .wrapper.toggled .overlay {
                position: fixed; inset: 0; background: rgba(0,0,0,0.5);
                z-index: 1040; display: block; cursor: pointer;
            }
            .wrapper.toggled .page-wrapper,
            .wrapper.toggled .topbar,
            .wrapper.toggled .page-footer { margin-left: 0; }
            .topbar { left: 0 !important; z-index: 1045; }
            .page-footer { left: 0 !important; z-index: 1030; }
        }
    </style>

    <div class="wrapper">
        <div class="sidebar-wrapper" data-simplebar="true">
            <div class="sidebar-header">
                <div>
                    <a href="{{ route('home') }}">
                        <img src="/image/imagenicono.png" alt="logo icon" style="height:40px;width:40px;object-fit:cover;border-radius:8px;">
                    </a>
                </div>
                <div class="logo-text">
                    <a href="{{ route('home') }}" class="text-decoration-none">
                        <span style="font-family:Georgia,serif;font-size:1rem;font-weight:700;color:#fff;">San Cristóbal</span>
                    </a>
                </div>
                <div class="toggle-icon ms-auto"><i class='bx bx-arrow-back'></i></div>
            </div>
            <ul class="metismenu" id="menu">
                @foreach ($groups as $group => $items)
                    <li class="menu-label">{{ $group }}</li>
                    @foreach ($items as $item)
                        <li>
                            <a href="{{ $item['url'] }}" class="{{ $item['current'] ? 'active' : '' }}">
                                <div class="parent-icon"><i class='bx bx-{{ $item['icon'] }}'></i></div>
                                <div class="menu-title">{{ $item['name'] }}</div>
                            </a>
                        </li>
                    @endforeach
                @endforeach
            </ul>
        </div>

        <header>
            <div class="topbar d-flex align-items-center">
                <nav class="navbar navbar-expand gap-3">
                    <div class="mobile-toggle-menu"><i class='bx bx-menu'></i></div>

                    <div class="top-menu ms-auto">
                        <ul class="navbar-nav align-items-center gap-1">
                            <li class="nav-item dark-mode d-none d-sm-flex">
                                <a class="nav-link dark-mode-icon" href="javascript:;"><i class='bx bx-moon'></i></a>
                            </li>

                            <li class="nav-item dropdown dropdown-large">
                                <a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative"
                                    href="#" data-bs-toggle="dropdown">
                                    <i class='bx bx-bell'></i>
                                    @if($notificacionesCount > 0)
                                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size:0.65rem;">
                                            {{ $notificacionesCount }}
                                        </span>
                                    @endif
                                </a>
                                <div class="dropdown-menu dropdown-menu-end" style="min-width: 300px;">
                                    <div class="header-notifications-list">
                                        @if($notificacionesCount > 0)
                                            @php
                                                $vencenPronto = \App\Models\Negocio::where('plan_estado', 'activo')
                                                    ->where('plan_fecha_fin', '<=', now()->addDays(7))
                                                    ->where('plan_fecha_fin', '>', now())
                                                    ->get();
                                            @endphp
                                            @foreach($vencenPronto as $neg)
                                                <a class="dropdown-item py-2" href="{{ route('admin.pagos.index') }}">
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-grow-1">
                                                            <h6 class="mb-0" style="font-size:0.85rem;">{{ $neg->nombre }}</h6>
                                                            <small class="text-warning">Plan vence: {{ \Carbon\Carbon::parse($neg->plan_fecha_fin)->format('d/m/Y') }}</small>
                                                        </div>
                                                    </div>
                                                </a>
                                            @endforeach
                                        @else
                                            <div class="dropdown-item text-center text-muted py-3">
                                                <i class="bx bx-bell fs-3 d-block mb-2"></i>
                                                <p class="mb-0">Sin notificaciones</p>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </li>

                            <li class="nav-item dropdown px-3">
                                <a class="d-flex align-items-center nav-link dropdown-toggle gap-2 dropdown-toggle-nocaret"
                                    href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <div class="rounded-circle bg-primary d-flex align-items-center justify-content-center text-white fw-bold" style="width:36px;height:36px;font-size:0.75rem;">
                                        {{ auth()->user()->initials() }}
                                    </div>
                                    <div class="user-info d-none d-md-block">
                                        <p class="user-name mb-0">{{ auth()->user()->name }}</p>
                                        <p class="designattion mb-0 small">{{ ucfirst(auth()->user()->role) }}</p>
                                    </div>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item d-flex align-items-center"
                                            href="{{ route('settings.profile') }}"><i
                                                class="bx bx-cog fs-5 me-2"></i>Configuración</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item d-flex align-items-center" href="#"
                                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            <i class="bx bx-log-out-circle fs-5 me-2"></i>Cerrar sesión
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </li>
                                </ul>
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

        <script>
        /* Unify Dexon dark-theme toggle with Flux/Tailwind .dark class */
        $(document).off('click', '.dark-mode').on('click', '.dark-mode', function() {
            var html = $('html');
            if ($('.dark-mode-icon i').attr('class') === 'bx bx-sun') {
                $('.dark-mode-icon i').attr('class', 'bx bx-moon');
                html.removeClass('light-theme').addClass('dark-theme dark');
            } else {
                $('.dark-mode-icon i').attr('class', 'bx bx-sun');
                html.removeClass('dark-theme dark').addClass('light-theme');
            }
        });
        /* Ensure sidebar toggle works with delegated events (survives Livewire morphing) */
        $(document).off('click.dexon.toggle').on('click.dexon.toggle', '.mobile-toggle-menu', function() {
            $('.wrapper').addClass('toggled');
        });
        $(document).off('click.dexon.collapse').on('click.dexon.collapse', '.overlay.toggle-icon', function() {
            $('.wrapper').removeClass('toggled');
        });
        </script>

        <div class="overlay toggle-icon"></div>
        <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
        <footer class="page-footer">
            <p class="mb-0">Copyright © 2025 todos los derechos reservados</p>
        </footer>
    </div>
    @livewireScripts
</body>

</html>
