<x-layouts.public>

    <section class="breadcrumb-area section-padding img-bg-2">
        <div class="overlay"></div>
        <div class="container">
            <div class="breadcrumb-content d-flex flex-wrap align-items-center justify-content-between">
                <div class="section-heading">
                    <h2 class="section__title text-white">Sitios Turísticos</h2>
                </div>
            </div><!-- end breadcrumb-content -->
        </div><!-- end container -->
    </section><!-- end breadcrumb-area -->

    <section class="blog-area section--padding">
        <div class="container">
            <div class="row">
                @foreach ($touristsites as $site)
                    <div class="col-lg-4">
                        <div class="card card-item">
                            <div class="card-image">
                                <a href="#" class="d-block">
                                    <img class="card-img-top lazy" src="images/img-loading.png"
                                        data-src="{{ asset('storage/' . $site->imagen_destacada) }}" alt="{{ $site->titulo }}">
                                </a>
                                <div class="course-badge-labels">
                                    <div class="course-badge">{{ $site->created_at->format('M d, Y') }}</div>
                                </div>
                            </div><!-- end card-image -->
                            <div class="card-body">
                                <h5 class="card-title">
                                    <a href="#">{{ $site->titulo }}</a>
                                </h5>
                                <p>{{ Str::limit($site->resumen, 120) }}</p>
                                <ul class="generic-list-item generic-list-item-bullet generic-list-item--bullet d-flex align-items-center flex-wrap fs-14 pt-2">
                                    <li class="d-flex align-items-center">Ubicación: {{ $site->ubicacion }}</li>
                                    <li class="d-flex align-items-center">Horario: {{ $site->horario ?? 'N/A' }}</li>
                                </ul>
                                <div class="d-flex justify-content-between align-items-center pt-3">
                                    <a href="#" class="btn theme-btn theme-btn-sm theme-btn-white">Ver Más <i class="la la-arrow-right icon ml-1"></i></a>
                                    <div class="share-wrap">
                                        <ul class="social-icons social-icons-styled">
                                            <li><a href="#" class="facebook-bg"><i class="la la-facebook"></i></a></li>
                                            <li><a href="#" class="twitter-bg"><i class="la la-twitter"></i></a></li>
                                            <li><a href="#" class="instagram-bg"><i class="la la-instagram"></i></a></li>
                                        </ul>
                                        <div class="icon-element icon-element-sm shadow-sm cursor-pointer share-toggle" title="Compartir"><i class="la la-share-alt"></i></div>
                                    </div>
                                </div>
                            </div><!-- end card-body -->
                        </div><!-- end card -->
                    </div><!-- end col -->
                @endforeach
            </div><!-- end row -->
        </div><!-- end container -->
    </section><!-- end blog-area -->

</x-layouts.public>
