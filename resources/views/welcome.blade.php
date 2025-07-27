<x-layouts.public>

<section class="hero-area">
        <div class="hero-slider owl-action-styled">
            <div class="hero-slider-item hero-bg-2 "
                style="background-image: url('https://boliviatravelsite.com/Images/Attractionphotos/san-cristobal-01.jpg'); background-size: cover; background-position: center;">

                <div class="container">
                    <div class="hero-content">
                        <div class="section-heading">
                            <h2 class="section__title text-white fs-65 lh-80 pb-3">SAN CRISTÓBAL <br> CAPITAL HISTÓRICA DE LOS LIPEZ
                            </h2>
                            <p class="section__desc text-white pb-4">La historia de San Cristóbal se remonta a tiempos precolombinos (1584, según documentos de creación), cuando la zona estaba habitada por diferentes etnias indígenas, como los Lliphi y los Quechuas. Durante la colonización hispana, la región de los Lípez fue incorporada al Virreinato del Perú y posteriormente al Virreinato del Río de la Plata. Los colonizadores españoles establecieron una serie de asentamientos en la zona, incluyendo la actual San Cristóbal , que se convirtió en un  relevante centro administrativo.
                                <br>
                            </p>
                        </div><!-- end section-heading -->
                        <div class="hero-btn-box d-flex flex-wrap align-items-center pt-1">
                            <a href="admission.html" class="btn theme-btn mr-4 mb-4">Ver mas <i
                                    class="la la-arrow-right icon ml-1"></i></a>
                            <a href="#" class="btn-text video-play-btn mb-4" data-fancybox
                                data-src="https://www.youtube.com/watch?v=B_q-dIWoj4k">
                                Vista Previa<i class="la la-play icon-btn ml-2"></i>
                            </a>
                        </div><!-- end hero-btn-box -->
                    </div><!-- end hero-content -->
                </div><!-- end container -->
            </div><!-- end hero-slider-item -->
        
           
        </div><!-- end hero-slide -->
    </section><!-- end hero-area -->

<section class="about-area section--padding">
    <div class="container">
        <div class="row">
            <!-- Contenido: Misión y Visión -->
            <div class="col-lg-6">
                <div class="about-content pb-5">
                    <div class="section-heading">
                        <h2 class="section__title pb-3 lh-50">San Cristóbal, tierra de esfuerzo y esperanza</h2>

                        <h5 class="text-primary mb-2">Misión</h5>
                        <p class="section__desc pb-3">
                            Fortalecer el desarrollo integral de la comunidad de San Cristóbal a través de la minería responsable, el trabajo colectivo y la preservación de nuestras raíces culturales, impulsando el bienestar social y económico de nuestras familias.
                        </p>

                        <h5 class="text-success mb-2">Visión</h5>
                        <p class="section__desc">
                            Ser una comunidad unida, modelo en el desarrollo sostenible de la minería y en la gestión de nuestros recursos naturales, proyectando a San Cristóbal como un referente regional en organización, cultura y progreso.
                        </p>
                    </div><!-- end section-heading -->
                    <div class="btn-box pt-35px">
                        <a href="#historia" class="btn theme-btn">Conoce nuestra historia <i class="la la-arrow-right icon ml-1"></i></a>
                    </div>
                </div><!-- end about-content -->
            </div><!-- end col-lg-6 -->

            <!-- Imagen representativa -->
            <div class="col-lg-6">
                <div class="generic-img-box generic-img-box-layout-3">
                    <img src="https://www.minerasancristobal.com/v3/es/wp-content/uploads/2020/03/04-Las-6-claves-que-hacen-de-Minera-San-Crist%C3%B3bal-una-empresa-boliviana-....jpg" alt="San Cristóbal" class="img__item img__item-1">
                </div>
            </div><!-- end col-lg-6 -->
        </div><!-- end row -->
    </div><!-- end container -->
</section><!-- end about-area -->


<section class="about-area section--padding overflow-hidden">
    <div class="container">
        <div class="section-heading text-center mb-5">
            <h2 class="section__title lh-50">Información de la Comunidad</h2>
            <p class="section__desc">Conoce los datos más importantes sobre tu comunidad.</p>
        </div>
        <div class="row">
            <!-- Alcalde -->
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card card-item shadow-sm text-center h-100">
                    <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" class="card-img-top mx-auto mt-3" alt="alcalde" style="width:80px;height:80px;">
                    <div class="card-body">
                        <h5 class="card-title text-primary">Alcalde</h5>
                        <p class="card-text">{{ $comunidad->alcalde ?? 'No especificado' }}</p>
                    </div>
                </div>
            </div>

            <!-- Teléfono Municipal -->
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card card-item shadow-sm text-center h-100">
                    <img src="https://cdn-icons-png.flaticon.com/512/597/597177.png" class="card-img-top mx-auto mt-3" alt="telefono" style="width:80px;height:80px;">
                    <div class="card-body">
                        <h5 class="card-title text-primary">Teléfono Municipal</h5>
                        <p class="card-text">{{ $comunidad->telefono_municipal ?? 'No disponible' }}</p>
                    </div>
                </div>
            </div>

            <!-- Dirección Municipal -->
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card card-item shadow-sm text-center h-100">
                    <img src="https://cdn-icons-png.flaticon.com/512/684/684908.png" class="card-img-top mx-auto mt-3" alt="direccion" style="width:80px;height:80px;">
                    <div class="card-body">
                        <h5 class="card-title text-primary">Dirección Municipal</h5>
                        <p class="card-text">{{ $comunidad->direccion_municipal ?? 'No disponible' }}</p>
                    </div>
                </div>
            </div>

            <!-- Hospital Principal -->
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card card-item shadow-sm text-center h-100">
                    <img src="https://cdn-icons-png.flaticon.com/512/2965/2965567.png" class="card-img-top mx-auto mt-3" alt="hospital" style="width:80px;height:80px;">
                    <div class="card-body">
                        <h5 class="card-title text-primary">Hospital Principal</h5>
                        <p class="card-text">{{ $comunidad->hospital_principal ?? 'No disponible' }}</p>
                        <p class="small text-muted mb-0">Tel: {{ $comunidad->telefono_hospital ?? 'N/A' }}</p>
                        <p class="small text-muted">Dirección: {{ $comunidad->direccion_hospital ?? 'N/A' }}</p>
                    </div>
                </div>
            </div>

            <!-- Emergencias -->
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card card-item shadow-sm text-center h-100">
                    <img src="https://cdn-icons-png.flaticon.com/512/724/724664.png" class="card-img-top mx-auto mt-3" alt="emergencia" style="width:80px;height:80px;">
                    <div class="card-body">
                        <h5 class="card-title text-danger">Teléfonos de Emergencia</h5>
                        <p class="mb-1"><strong>Bomberos:</strong> {{ $comunidad->telefono_bomberos ?? 'N/A' }}</p>
                        <p class="mb-1"><strong>Policía:</strong> {{ $comunidad->telefono_policia ?? 'N/A' }}</p>
                        <p class="mb-0"><strong>Emergencias:</strong> {{ $comunidad->telefono_emergencia ?? 'N/A' }}</p>
                    </div>
                </div>
            </div>

            <!-- Horarios de Atención -->
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card card-item shadow-sm text-center h-100">
                    <img src="https://cdn-icons-png.flaticon.com/512/1828/1828884.png" class="card-img-top mx-auto mt-3" alt="horario" style="width:80px;height:80px;">
                    <div class="card-body">
                        <h5 class="card-title text-success">Horarios de Atención</h5>
                        <p class="card-text">{{ $comunidad->horarios_atencion ?? 'No especificado' }}</p>
                    </div>
                </div>
            </div>

            <!-- Enlaces útiles -->
            @if ($comunidad->enlaces_utiles)
            <div class="col-12 mt-4 text-center">
                <a href="{{ $comunidad->enlaces_utiles }}" class="btn btn-outline-primary" target="_blank">
                    Ver Enlaces Útiles
                </a>
            </div>
            @endif
        </div>
    </div>
</section>






</x-layouts.public>