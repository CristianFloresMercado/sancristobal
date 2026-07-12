@php
    use Illuminate\Support\Str;
@endphp

<x-layouts.public>

    <style>
        .hero-section h1, .hero-section h2, .hero-section p, .hero-section span, .hero-section div {
            color: #ffffff !important;
        }
        .hero-section a { color: inherit !important; }

        @media (max-width: 767.98px) {
            .hero-section { min-height: 360px !important; }
            .hero-section h1 { font-size: 1.8rem !important; }
            .hero-section p { font-size: 0.9rem !important; }
            .hero-btns { flex-direction: column !important; align-items: flex-start !important; gap: 10px !important; }
            .hero-btns a { width: auto !important; }
            .quick-links-section { margin-top: -25px !important; }
            .quick-link-card { padding: 14px 12px !important; gap: 10px !important; }
            .quick-link-icon { width: 40px !important; height: 40px !important; }
            .quick-link-icon i { font-size: 1.1rem !important; }
            .section-about, .section-culture, .section-inst { padding: 40px 0 !important; }
            .section-about h2, .section-culture h2, .section-inst h2 { font-size: 1.5rem !important; }
            .culture-img { height: 140px !important; }
        }

        @media (max-width: 575.98px) {
            .hero-section { min-height: 300px !important; }
            .hero-section h1 { font-size: 1.5rem !important; }
            .quick-link-card { padding: 12px 10px !important; gap: 8px !important; }
            .quick-link-text { font-size: 0.85rem !important; }
            .quick-link-sub { font-size: 0.7rem !important; }
        }
    </style>

    {{-- HERO --}}
    <section class="hero-section" style="position:relative;min-height:480px;display:flex;align-items:center;background:url('https://boliviatravelsite.com/Images/Attractionphotos/san-cristobal-01.jpg') center/cover no-repeat;">
        <div style="position:absolute;inset:0;background:linear-gradient(135deg,rgba(10,40,100,0.94),rgba(15,60,130,0.90));"></div>
        <div class="container position-relative" style="z-index:2;">
            <div class="row align-items-center">
                <div class="col-lg-7 text-white">
                    <div style="font-size:0.75rem;text-transform:uppercase;letter-spacing:3px;opacity:0.7;margin-bottom:0.75rem;">San Cristóbal · Potosí · Bolivia</div>
                    <h1 style="font-family:Georgia,'Times New Roman',serif;font-size:3rem;font-weight:700;line-height:1.15;color:#ffffff !important;text-shadow:0 2px 8px rgba(0,0,0,0.5),0 1px 3px rgba(0,0,0,0.4);">Capital Histórica<br>de los Lípez</h1>
                    <p style="font-size:1.05rem;opacity:1;max-width:520px;line-height:1.7;margin:1.25rem 0 2rem;text-shadow:0 1px 4px rgba(0,0,0,0.3);">La historia de San Cristóbal se remonta a tiempos precolombinos, cuando la zona estaba habitada por diferentes etnias indígenas como los Lliphi y los Quechuas.                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- QUICK LINKS --}}
    <section class="quick-links-section" style="background:#fff;padding:0;position:relative;z-index:3;margin-top:-40px;">
        <div class="container">
            <div class="row g-3">
                <div class="col-md-4 col-6">
                    <a href="{{ route('turismo') }}" class="quick-link-card" style="display:flex;align-items:center;gap:12px;padding:20px;background:#fff;border-radius:14px;box-shadow:0 4px 20px rgba(0,0,0,0.06);text-decoration:none;transition:all .3s;" onmouseover="this.style.transform='translateY(-3px)';this.style.boxShadow='0 8px 30px rgba(0,0,0,0.1)'" onmouseout="this.style.transform='none';this.style.boxShadow='0 4px 20px rgba(0,0,0,0.06)'">
                        <div class="quick-link-icon" style="width:48px;min-width:40px;height:48px;border-radius:12px;background:linear-gradient(135deg,#0d47a1,#42a5f5);display:flex;align-items:center;justify-content:center;"><i class="la la-map-marker" style="color:#fff;font-size:1.3rem;"></i></div>
                        <div><span class="quick-link-text" style="font-weight:700;color:#1a237e;font-size:0.95rem;display:block;">Turismo</span><span class="quick-link-sub" style="font-size:0.78rem;color:#9ca3af;">Sitios turísticos</span></div>
                    </a>
                </div>
                <div class="col-md-4 col-6">
                    <a href="{{ route('noticias') }}" class="quick-link-card" style="display:flex;align-items:center;gap:12px;padding:20px;background:#fff;border-radius:14px;box-shadow:0 4px 20px rgba(0,0,0,0.06);text-decoration:none;transition:all .3s;" onmouseover="this.style.transform='translateY(-3px)';this.style.boxShadow='0 8px 30px rgba(0,0,0,0.1)'" onmouseout="this.style.transform='none';this.style.boxShadow='0 4px 20px rgba(0,0,0,0.06)'">
                        <div class="quick-link-icon" style="width:48px;min-width:40px;height:48px;border-radius:12px;background:linear-gradient(135deg,#1565c0,#64b5f6);display:flex;align-items:center;justify-content:center;"><i class="la la-newspaper-o" style="color:#fff;font-size:1.3rem;"></i></div>
                        <div><span class="quick-link-text" style="font-weight:700;color:#1a237e;font-size:0.95rem;display:block;">Noticias</span><span class="quick-link-sub" style="font-size:0.78rem;color:#9ca3af;">Últimas novedades</span></div>
                    </a>
                </div>
                <div class="col-md-4 col-6">
                    <a href="{{ route('negocios') }}" class="quick-link-card" style="display:flex;align-items:center;gap:12px;padding:20px;background:#fff;border-radius:14px;box-shadow:0 4px 20px rgba(0,0,0,0.06);text-decoration:none;transition:all .3s;" onmouseover="this.style.transform='translateY(-3px)';this.style.boxShadow='0 8px 30px rgba(0,0,0,0.1)'" onmouseout="this.style.transform='none';this.style.boxShadow='0 4px 20px rgba(0,0,0,0.06)'">
                        <div class="quick-link-icon" style="width:48px;min-width:40px;height:48px;border-radius:12px;background:linear-gradient(135deg,#1e88e5,#90caf9);display:flex;align-items:center;justify-content:center;"><i class="la la-briefcase" style="color:#fff;font-size:1.3rem;"></i></div>
                        <div><span class="quick-link-text" style="font-weight:700;color:#1a237e;font-size:0.95rem;display:block;">Negocios</span><span class="quick-link-sub" style="font-size:0.78rem;color:#9ca3af;">Comercio local</span></div>
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- ABOUT / MISIÓN Y VISIÓN --}}
    <section class="section-about" style="background:#f8fafc;padding:70px 0;">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-6">
                    <div style="font-size:0.7rem;text-transform:uppercase;letter-spacing:2px;color:#0d47a1;font-weight:700;margin-bottom:0.5rem;">Sobre nosotros</div>
                    <h2 style="font-family:Georgia,'Times New Roman',serif;font-size:2rem;font-weight:700;color:#111827;margin-bottom:1.5rem;">San Cristóbal, tierra de esfuerzo y esperanza</h2>

                    <div style="background:#fff;border-radius:14px;padding:1.5rem;margin-bottom:1rem;box-shadow:0 2px 10px rgba(0,0,0,0.04);border-left:4px solid #0d47a1;">
                        <h5 style="color:#0d47a1;font-weight:700;margin-bottom:0.5rem;font-size:0.95rem;"><i class="la la-bullseye me-1"></i> Misión</h5>
                        <p style="color:#4b5563;font-size:0.9rem;line-height:1.7;margin:0;">Fortalecer el desarrollo integral de la comunidad a través de la minería responsable, el trabajo colectivo y la preservación de nuestras raíces culturales.</p>
                    </div>

                    <div style="background:#fff;border-radius:14px;padding:1.5rem;margin-bottom:1.5rem;box-shadow:0 2px 10px rgba(0,0,0,0.04);border-left:4px solid #2e7d32;">
                        <h5 style="color:#2e7d32;font-weight:700;margin-bottom:0.5rem;font-size:0.95rem;"><i class="la la-eye me-1"></i> Visión</h5>
                        <p style="color:#4b5563;font-size:0.9rem;line-height:1.7;margin:0;">Ser una comunidad unida, modelo en desarrollo sostenible y gestión de recursos naturales, proyectando a San Cristóbal como referente regional.</p>
                    </div>

                    <a href="/descargas/sancristobal.pdf" download style="display:inline-flex;align-items:center;gap:6px;padding:10px 24px;background:linear-gradient(135deg,#0d47a1,#1565c0);color:#fff;border-radius:50px;font-weight:600;font-size:0.85rem;text-decoration:none;transition:all .3s;" onmouseover="this.style.transform='translateY(-1px)';this.style.boxShadow='0 4px 15px rgba(13,71,161,0.3)'" onmouseout="this.style.transform='none';this.style.boxShadow='none'">Descargar cultura <i class="la la-download"></i></a>
                </div>
                <div class="col-lg-6">
                    <img src="https://www.minerasancristobal.com/v3/es/wp-content/uploads/2020/03/04-Las-6-claves-que-hacen-de-Minera-San-Crist%C3%B3bal-una-empresa-boliviana-....jpg" alt="San Cristóbal" style="width:100%;border-radius:16px;box-shadow:0 10px 40px rgba(0,0,0,0.1);">
                </div>
            </div>
        </div>
    </section>

    {{-- CULTURA --}}
    <section class="section-culture" style="background:#fff;padding:70px 0;">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-6 order-lg-2">
                    <div style="font-size:0.7rem;text-transform:uppercase;letter-spacing:2px;color:#0d47a1;font-weight:700;margin-bottom:0.5rem;">Nuestra identidad</div>
                    <h2 style="font-family:Georgia,'Times New Roman',serif;font-size:2rem;font-weight:700;color:#111827;margin-bottom:1rem;">Cultura y Costumbres</h2>
                    <p style="color:#4b5563;font-size:0.95rem;line-height:1.8;margin-bottom:1rem;">San Cristóbal es una tierra rica en historia viva, donde las tradiciones ancestrales se entrelazan con la vida moderna. La comunidad celebra con orgullo sus festividades religiosas como la Fiesta Patronal de San Cristóbal.</p>
                    <p style="color:#4b5563;font-size:0.95rem;line-height:1.8;">Entre las expresiones culturales más representativas se encuentran los tinkus, la morenada y los diablos. Las festividades como Todos Santos y el Carnaval Andino marcan el calendario de celebraciones.</p>
                </div>
                <div class="col-lg-6 order-lg-1">
                    <div class="row g-3">
                        <div class="col-6"><img class="culture-img" src="https://www.minerasancristobal.com/v3/es/wp-content/uploads/2020/03/04-Las-6-claves-que-hacen-de-Minera-San-Crist%C3%B3bal-una-empresa-boliviana-....jpg" alt="Cultura" style="width:100%;height:180px;object-fit:cover;border-radius:12px;"></div>
                        <div class="col-6"><img class="culture-img" src="https://boliviatravelsite.com/Images/Attractionphotos/san-cristobal-01.jpg" alt="Danza" style="width:100%;height:180px;object-fit:cover;border-radius:12px;"></div>
                        <div class="col-6"><img class="culture-img" src="https://boliviatravelsite.com/Images/Attractionphotos/san-cristobal-01.jpg" alt="Carnaval" style="width:100%;height:180px;object-fit:cover;border-radius:12px;"></div>
                        <div class="col-6"><img class="culture-img" src="https://www.minerasancristobal.com/v3/es/wp-content/uploads/2020/03/04-Las-6-claves-que-hacen-de-Minera-San-Crist%C3%B3bal-una-empresa-boliviana-....jpg" alt="Tradiciones" style="width:100%;height:180px;object-fit:cover;border-radius:12px;"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- INSTITUCIONES --}}
    @if(isset($instituciones) && count($instituciones) > 0)
    <section class="section-inst" style="background:#f8fafc;padding:70px 0;">
        <div class="container">
            <div class="text-center mb-5">
                <div style="font-size:0.7rem;text-transform:uppercase;letter-spacing:2px;color:#0d47a1;font-weight:700;margin-bottom:0.5rem;">Información</div>
                <h2 style="font-family:Georgia,'Times New Roman',serif;font-size:2rem;font-weight:700;color:#111827;">Instituciones de la Comunidad</h2>
            </div>
            <div class="row g-4">
                @foreach($instituciones as $inst)
                    <div class="col-12 col-sm-6 col-lg-4">
                        <div style="background:#fff;border-radius:14px;padding:1.5rem;box-shadow:0 2px 12px rgba(0,0,0,0.04);text-align:center;height:100%;transition:transform .3s,box-shadow .3s;" onmouseover="this.style.transform='translateY(-4px)';this.style.boxShadow='0 8px 30px rgba(0,0,0,0.08)'" onmouseout="this.style.transform='none';this.style.boxShadow='0 2px 12px rgba(0,0,0,0.04)'">
                            @if($inst->imagen)
                                <img src="{{ asset('storage/' . $inst->imagen) }}" alt="{{ $inst->nombre }}" style="width:64px;height:64px;object-fit:cover;border-radius:50%;margin-bottom:1rem;">
                            @else
                                @php
                                    $icons = ['Hospital'=>'la-heart-1','Policia'=>'la-shield','Bomberos'=>'la-fire','Mercado'=>'la-shopping-cart','Municipalidad'=>'la-building','Escuela'=>'la-book','Iglesia'=>'la-heart','Plaza'=>'la-map-marker','Farmacia'=>'la-pills','Deporte'=>'la-trophy'];
                                    $icon = $icons[$inst->tipo] ?? 'la-map-pin';
                                @endphp
                                <div style="width:64px;height:64px;border-radius:50%;background:linear-gradient(135deg,#0d47a1,#42a5f5);display:flex;align-items:center;justify-content:center;margin:0 auto 1rem;"><i class="la {{ $icon }}" style="color:#fff;font-size:1.5rem;"></i></div>
                            @endif
                            @if($inst->tipo)<span style="display:inline-block;padding:3px 12px;border-radius:50px;font-size:0.7rem;font-weight:600;background:rgba(13,71,161,0.08);color:#0d47a1;margin-bottom:0.5rem;">{{ $inst->tipo }}</span>@endif
                            <h5 style="font-family:Georgia,serif;font-weight:700;color:#1a237e;margin-bottom:0.5rem;">{{ $inst->nombre }}</h5>
                            @if($inst->telefono)<p style="font-size:0.85rem;color:#6b7280;margin-bottom:4px;"><i class="la la-phone me-1" style="color:#0d47a1;"></i>{{ $inst->telefono }}</p>@endif
                            @if($inst->direccion)<p style="font-size:0.85rem;color:#6b7280;margin-bottom:4px;"><i class="la la-map-marker me-1" style="color:#e53935;"></i>{{ $inst->direccion }}</p>@endif
                            @if($inst->horario)<p style="font-size:0.8rem;color:#9ca3af;margin-bottom:0;"><i class="la la-clock-o me-1"></i>{{ $inst->horario }}</p>@endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

</x-layouts.public>
