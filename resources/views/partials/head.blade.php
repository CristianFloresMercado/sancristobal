<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<title>{{ $title ?? config('app.name') }}</title>

<link rel="icon" href="/favicon.ico" sizes="any">
<link rel="icon" href="/favicon.svg" type="image/svg+xml">
<link rel="apple-touch-icon" href="/apple-touch-icon.png">

<link rel="preconnect" href="https://fonts.bunny.net">
<link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">


<!-- Theme Style CSS -->
<link href="{{ asset('Backend/assets/plugins/vectormap/jquery-jvectormap-2.0.2.css') }}" rel="stylesheet" />
<link href="{{ asset('Backend/assets/plugins/simplebar/css/simplebar.css') }}" rel="stylesheet" />
<link href="{{ asset('Backend/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet" />
<link href="{{ asset('Backend/assets/plugins/metismenu/css/metisMenu.min.css') }}" rel="stylesheet" />

<!-- loader -->
<link href="{{ asset('Backend/assets/css/pace.min.css') }}" rel="stylesheet" />
<script src="{{ asset('Backend/assets/js/pace.min.js') }}"></script>

<!-- Bootstrap CSS -->
<link href="{{ asset('Backend/assets/css/bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('Backend/assets/css/bootstrap-extended.css') }}" rel="stylesheet">

<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">

<link href="{{ asset('Backend/assets/css/app.css') }}" rel="stylesheet">
<link href="{{ asset('Backend/assets/css/icons.css') }}" rel="stylesheet">

<!-- Theme Style CSS -->
<link rel="stylesheet" href="{{ asset('Backend/assets/css/dark-theme.css') }}" />
<link rel="stylesheet" href="{{ asset('Backend/assets/css/semi-dark.css') }}" />
<link rel="stylesheet" href="{{ asset('Backend/assets/css/header-colors.css') }}" />

<script src="{{ asset('Backend/assets/js/bootstrap.bundle.min.js') }}  "></script>
<!-- Plugins -->
<script src="{{ asset('Backend/assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('Backend/assets/plugins/simplebar/js/simplebar.min.js') }}"></script>
<script src="{{ asset('Backend/assets/plugins/metismenu/js/metisMenu.min.js') }}"></script>
<script src="{{ asset('Backend/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>
<script src="{{ asset('Backend/assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js') }}"></script>
<script src="{{ asset('Backend/assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
<script src="{{ asset('Backend/assets/plugins/chartjs/js/chart.js') }}"></script>
<script src="{{ asset('Backend/assets/js/index.js') }}"></script>


	







<!-- App JS -->
<script src="{{ asset('Backend/assets/js/app.js') }}"></script>

<script>
    new PerfectScrollbar(".app-container");
</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@vite(['resources/css/app.css', 'resources/js/app.js'])


@fluxAppearance
