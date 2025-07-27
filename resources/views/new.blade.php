<x-layouts.public>


    <section class="breadcrumb-area section-padding img-bg-2">
        <div class="overlay"></div>
        <div class="container">
            <div class="breadcrumb-content d-flex flex-wrap align-items-center justify-content-between">
                <div class="section-heading">
                    <h2 class="section__title text-white">Seccion Noticias</h2>
                </div>

            </div><!-- end breadcrumb-content -->
        </div><!-- end container -->
    </section><!-- end breadcrumb-area -->
    <!-- ================================
    END BREADCRUMB AREA
================================= -->

    <!-- ================================
       START BLOG AREA
================================= -->
    <section class="blog-area section--padding">
        <div class="container">
            <div class="row">
                @foreach ($new as $noticias)
                    <div class="col-lg-4">
                        <div class="card card-item">
                            <div class="card-image">
                                <a href="" class="d-block">
                                    <img class="card-img-top lazy" src="images/img-loading.png"
                                        data-src="{{ asset('storage/' . $noticias->imagen_destacada) }}">
                                </a>
                                <div class="course-badge-labels">
                                    <div class="course-badge">{{ $noticias->created_at->format('M d, Y') }}</div>
                                </div>
                            </div><!-- end card-image -->
                            <div class="card-body">
                                
                            </div><!-- end card-body -->
                            <div class="card-body">
                                <h5 class="card-title">
                                    <a href="">{{ $noticias->titulo }}</a>
                                </h5>
                                <ul
                                    class="generic-list-item generic-list-item-bullet generic-list-item--bullet d-flex align-items-center flex-wrap fs-14 pt-2">
                                    <li class="d-flex align-items-center">Autor: {{ $noticias->autor }}</li>
                                    <li class="d-flex align-items-center">Fuente: {{ $noticias->fuente }}</li>
                                </ul>
                                <div class="d-flex justify-content-between align-items-center pt-3">
                                    <a href="blog-single.html" class="btn theme-btn theme-btn-sm theme-btn-white">Leer
                                        Más <i class="la la-arrow-right icon ml-1"></i></a>
                                    <div class="share-wrap">
                                        <ul class="social-icons social-icons-styled">
                                            <li class="mr-0"><a href="#" class="facebook-bg"><i
                                                        class="la la-facebook"></i></a></li>
                                            <li class="mr-0"><a href="#" class="twitter-bg"><i
                                                        class="la la-twitter"></i></a></li>
                                            <li class="mr-0"><a href="#" class="instagram-bg"><i
                                                        class="la la-instagram"></i></a></li>
                                        </ul>
                                        <div class="icon-element icon-element-sm shadow-sm cursor-pointer share-toggle"
                                            title="Toggle to expand social icons"><i class="la la-share-alt"></i></div>
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
