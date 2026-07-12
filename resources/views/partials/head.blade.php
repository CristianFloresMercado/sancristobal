<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<title>{{ $title ?? config('app.name') }}</title>

<link rel="icon" href="{{ asset('image/imagenicono.png') }}">

<link rel="preconnect" href="https://fonts.bunny.net">
<link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">

<!-- Bootstrap 5 CSS (CDN) -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Boxicons (CDN) -->
<link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">

<!-- Dexon Theme CSS -->
<link href="{{ asset('Backend/assets/css/app.css') }}" rel="stylesheet">
<link href="{{ asset('Backend/assets/css/icons.css') }}" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('Backend/assets/css/dark-theme.css') }}" />
<link rel="stylesheet" href="{{ asset('Backend/assets/css/semi-dark.css') }}" />
<link rel="stylesheet" href="{{ asset('Backend/assets/css/header-colors.css') }}" />

<!-- Simplebar CSS (CDN) -->
<link href="https://cdn.jsdelivr.net/npm/simplebar@6.0.3/dist/simplebar.min.css" rel="stylesheet">

<!-- Metismenu CSS (CDN) -->
<link href="https://cdn.jsdelivr.net/npm/metismenujs@1.4.0/dist/metisMenu.min.css" rel="stylesheet">

<!-- jQuery + Bootstrap 5 JS (CDN) -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Simplebar JS (CDN) -->
<script src="https://cdn.jsdelivr.net/npm/simplebar@6.0.3/dist/simplebar.min.js"></script>

<!-- Metismenu JS (CDN) -->
<script src="https://cdn.jsdelivr.net/npm/metismenujs@1.4.0/dist/metisMenu.min.js"></script>

<!-- Dexon App JS -->
<script src="{{ asset('Backend/assets/js/app.js') }}"></script>

<!-- Chart.js (CDN) -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@livewireStyles
