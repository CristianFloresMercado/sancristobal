<head>
    <script>
        (function(){
            var saved = localStorage.getItem('sancristobal-theme');
            if (saved === 'dark') {
                document.documentElement.classList.add('dark');
                localStorage.setItem('flux-theme', 'dark');
            } else {
                document.documentElement.classList.remove('dark');
                document.documentElement.classList.remove('dark-theme');
                document.documentElement.style.colorScheme = 'light';
                localStorage.setItem('flux-theme', 'light');
            }
        })();
    </script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>San Cristobal</title>

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('image/imagenicono.png') }}">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Bootstrap 5 CSS (CDN) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Line Awesome (CDN) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/line-awesome@1.3.0/dist/line-awesome/css/line-awesome.min.css">

    <!-- Owl Carousel CSS (CDN) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/owl.carousel@2.3.4/dist/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/owl.carousel@2.3.4/dist/assets/owl.theme.default.min.css">

    <!-- Fancybox CSS (CDN) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css">

    <!-- Tooltipster CSS (CDN) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tooltipster@4.2.8/dist/css/tooltipster.bundle.min.css">

    <!-- Theme CSS (local - custom) -->
    <link rel="stylesheet" href="{{ asset('theme/style.css') }}">

    <!-- BS4 → BS5 compat shim -->
    <style>
        [class*="mr-"]{margin-right:0!important}[class*="ml-"]{margin-left:0!important}[class*="pr-"]{padding-right:0!important}[class*="pl-"]{padding-left:0!important}
        .mr-0,.mr-sm-1,.mr-1,.mr-2,.mr-3,.mr-4,.mr-5{margin-right:var(--bs-spacer,1rem)!important}
        .ml-0,.ml-sm-1,.ml-1,.ml-2,.ml-3,.ml-4,.ml-5{margin-left:var(--bs-spacer,1rem)!important}
        .pr-0,.pr-sm-1,.pr-1,.pr-2,.pr-3,.pr-4,.pr-5{padding-right:var(--bs-spacer,1rem)!important}
        .pl-0,.pl-sm-1,.pl-1,.pl-2,.pl-3,.pl-4,.pl-5{padding-left:var(--bs-spacer,1rem)!important}
        .mr-auto{margin-right:auto!important}.ml-auto{margin-left:auto!important}
        .mr-0{margin-right:0!important}.mr-1{margin-right:.25rem!important}.mr-2{margin-right:.5rem!important}.mr-3{margin-right:1rem!important}.mr-4{margin-right:1.5rem!important}.mr-5{margin-right:3rem!important}
        .ml-0{margin-left:0!important}.ml-1{margin-left:.25rem!important}.ml-2{margin-left:.5rem!important}.ml-3{margin-left:1rem!important}.ml-4{margin-left:1.5rem!important}.ml-5{margin-left:3rem!important}
        .pr-0{padding-right:0!important}.pr-1{padding-right:.25rem!important}.pr-2{padding-right:.5rem!important}.pr-3{padding-right:1rem!important}.pr-4{padding-right:1.5rem!important}.pr-5{padding-right:3rem!important}
        .pl-0{padding-left:0!important}.pl-1{padding-left:.25rem!important}.pl-2{padding-left:.5rem!important}.pl-3{padding-left:1rem!important}.pl-4{padding-left:1.5rem!important}.pl-5{padding-left:3rem!important}
        .font-weight-light{font-weight:300!important}.font-weight-normal{font-weight:400!important}.font-weight-medium{font-weight:500!important}.font-weight-bold{font-weight:700!important}.font-weight-bolder{font-weight:bolder!important}
        .font-italic{font-style:italic!important}.text-monospace{font-family:var(--bs-font-monospace)!important}
        .media{display:flex!important}.media-body{flex:1}
        .badge-pill{border-radius:50rem!important}
        .form-group{margin-bottom:1rem}
        .form-inline{display:flex;flex-flow:row wrap;align-items:center;gap:.5rem}
        .no-gutters{padding-right:0!important;padding-left:0!important;margin-right:0!important;margin-left:0!important}
        .jumbotron{padding:2rem 1rem;margin-bottom:2rem;background-color:#e9ecef;border-radius:.3rem}
        @media (min-width:576px){.jumbotron{padding:4rem 2rem}}
        .text-hide{font:0/0 a;color:transparent;text-shadow:none;background-color:transparent;border:0}
        .float-left{float:left!important}.float-right{float:right!important}
        .border-left{border-left:1px solid #dee2e6!important}.border-right{border-right:1px solid #dee2e6!important}
        .border-top{border-top:1px solid #dee2e6!important}.border-bottom{border-bottom:1px solid #dee2e6!important}
    </style>

    <!-- jQuery (CDN) -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
    <!-- Bootstrap 5 JS (CDN) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Owl Carousel JS (CDN) -->
    <script src="https://cdn.jsdelivr.net/npm/owl.carousel@2.3.4/dist/owl.carousel.min.js"></script>
    <!-- Isotope (CDN) -->
    <script src="https://cdn.jsdelivr.net/npm/isotope-layout@3.0.6/dist/isotope.pkgd.min.js"></script>
    <!-- Waypoint (CDN) -->
    <script src="https://cdn.jsdelivr.net/npm/waypoints@4.0.1/lib/jquery.waypoints.min.js"></script>
    <!-- CounterUp (CDN) -->
    <script src="https://cdn.jsdelivr.net/npm/jquery-counterup@2.1.0/jquery.counterup.min.js"></script>
    <!-- Fancybox JS (CDN) -->
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
    <!-- Tooltipster JS (CDN) -->
    <script src="https://cdn.jsdelivr.net/npm/tooltipster@4.2.8/dist/js/tooltipster.bundle.min.js"></script>
    <!-- Theme JS (local - custom) -->
    <script src="{{ asset('theme/main.js') }}"></script>

    <!-- Force light mode override -->
    <style>
        html, html.dark-theme, html.dark {
            background-color: #fff !important;
            color: #1b1b18 !important;
        }
        html.dark-theme *, html.dark * {
            color: inherit !important;
            background-color: transparent !important;
        }
        html.dark-theme .breadcrumb-area, html.dark .breadcrumb-area {
            background: linear-gradient(135deg,#1a237e 0%,#283593 50%,#3949ab 100%) !important;
        }
        html.dark-theme .section--padding, html.dark .section--padding,
        html.dark-theme .blog-area, html.dark .blog-area {
            background-color: #fff !important;
        }
        html.dark-theme .card, html.dark .card,
        html.dark-theme .news-card, html.dark .news-card,
        html.dark-theme .news-featured, html.dark .news-featured,
        html.dark-theme .tour-card, html.dark .tour-card,
        html.dark-theme .modal-content, html.dark .modal-content {
            background-color: #fff !important;
            color: #1b1b18 !important;
        }
        html.dark-theme h1, html.dark-theme h2, html.dark-theme h3, html.dark-theme h4,
        html.dark-theme h5, html.dark-theme h6, html.dark-theme p, html.dark-theme span,
        html.dark-theme a, html.dark-theme li, html.dark-theme td, html.dark-theme th,
        html.dark h1, html.dark h2, html.dark h3, html.dark h4,
        html.dark h5, html.dark h6, html.dark p, html.dark span,
        html.dark a, html.dark li, html.dark td, html.dark th {
            color: inherit !important;
        }
        html.dark-theme .text-muted, html.dark .text-muted { color: #6c757d !important; }
        html.dark-theme .bg-white, html.dark .bg-white,
        html.dark-theme .bg-light, html.dark .bg-light,
        html.dark-theme .off-canvas-menu, html.dark .off-canvas-menu { background-color: #fff !important; }
    </style>
</head>
