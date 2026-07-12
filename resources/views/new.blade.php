@php
    use Illuminate\Support\Str;
@endphp

<x-layouts.public>

    <section style="background:linear-gradient(135deg,#0d47a1 0%,#1565c0 40%,#1e88e5 100%);padding:30px 0;text-align:center;">
        <div class="container">
            <h2 class="text-white mb-1" style="font-family:Georgia,'Times New Roman',serif;font-size:2rem;font-weight:700;">Noticias</h2>
            <p class="text-white-50 mb-0" style="font-size:0.9rem;">Mantente informado con las últimas noticias de San Cristóbal</p>
        </div>
    </section>

    <style>
        .news-search { border:2px solid transparent;background:linear-gradient(#fff,#fff) padding-box,linear-gradient(135deg,#0d47a1,#42a5f5) border-box;border-radius:50px;transition:box-shadow .3s; }
        .news-search:focus-within { box-shadow:0 0 0 3px rgba(13,71,161,0.15); }
        .news-card { border:none;border-radius:16px;overflow:hidden;background:#fff;transition:transform .35s cubic-bezier(.4,0,.2,1),box-shadow .35s;position:relative; }
        .news-card:hover { transform:translateY(-8px);box-shadow:0 20px 50px rgba(0,0,0,0.12); }
        .news-card-img { position:relative;overflow:hidden;height:220px; }
        .news-card-img img { width:100%;height:100%;object-fit:cover;transition:transform .6s cubic-bezier(.4,0,.2,1); }
        .news-card:hover .news-card-img img { transform:scale(1.08); }
        .news-card-img::after { content:'';position:absolute;inset:0;background:linear-gradient(transparent 50%,rgba(0,0,0,0.6));pointer-events:none; }
        .news-card-overlay { position:absolute;bottom:0;left:0;right:0;padding:1.25rem;z-index:2; }
        .news-badge { display:inline-flex;align-items:center;gap:4px;padding:4px 12px;border-radius:50px;font-size:0.7rem;font-weight:600;text-transform:uppercase;letter-spacing:0.5px; }
        .news-card-body { padding:1.25rem 1.5rem 1.5rem; }
        .news-card-title { font-family:Georgia,'Times New Roman',serif;font-weight:700;font-size:1.15rem;color:#1a237e;margin-bottom:0.5rem;line-height:1.3; }
        .news-card-text { font-size:0.9rem;color:#6b7280;line-height:1.6;margin-bottom:1rem; }
        .news-info-row { display:flex;align-items:center;gap:8px;font-size:0.82rem;color:#6b7280;margin-bottom:6px; }
        .news-info-row i { width:20px;text-align:center;font-size:1rem; }
        .news-btn { display:inline-flex;align-items:center;gap:6px;padding:10px 24px;border-radius:50px;font-weight:600;font-size:0.85rem;border:none;cursor:pointer;transition:all .3s; }
        .news-btn-primary { background:linear-gradient(135deg,#0d47a1,#1565c0);color:#fff; }
        .news-btn-primary:hover { background:linear-gradient(135deg,#1565c0,#1e88e5);box-shadow:0 4px 15px rgba(13,71,161,0.3);transform:translateY(-1px);color:#fff;text-decoration:none; }
        .news-empty { padding:80px 20px;text-align:center; }
        .news-empty i { font-size:4rem;color:#bbdefb; }
        .news-featured { border:none;border-radius:16px;overflow:hidden;background:#fff;transition:transform .35s cubic-bezier(.4,0,.2,1),box-shadow .35s;position:relative; }
        .news-featured:hover { transform:translateY(-8px);box-shadow:0 20px 50px rgba(0,0,0,0.12); }
        .news-featured-img { position:relative;overflow:hidden; }
        .news-featured-img img { width:100%;height:100%;object-fit:cover;transition:transform .6s cubic-bezier(.4,0,.2,1); }
        .news-featured:hover .news-featured-img img { transform:scale(1.05); }
        .news-section-label { font-size:0.7rem;text-transform:uppercase;letter-spacing:2px;color:#1a237e;font-weight:700;margin-bottom:0.5rem; }
        .news-section-title { font-family:Georgia,'Times New Roman',serif;font-size:1.5rem;font-weight:700;color:#111827; }
        .news-divider { height:3px;background:linear-gradient(90deg,#0d47a1,#42a5f5,#bbdefb);border-radius:2px;margin:2rem 0; }
    </style>

    <section style="background:#f8fafc;padding:20px 0 60px;">
        <div class="container">

            <form action="{{ route('noticias') }}" method="GET" class="mb-4">
                <div class="row justify-content-center">
                    <div class="col-lg-6 col-md-8">
                        <div class="input-group news-search bg-white shadow-sm">
                            <span class="input-group-text bg-transparent border-0"><i class="la la-search" style="color:#1a237e;font-size:1.1rem;"></i></span>
                            <input type="text" name="buscar" class="form-control border-0" style="padding:12px 0;font-size:0.95rem;" placeholder="Buscar noticias..." value="{{ request('buscar') }}">
                            <button class="news-btn news-btn-primary me-2" type="submit">Buscar</button>
                            @if (request('buscar'))
                                <a href="{{ route('noticias') }}" class="news-btn me-3" style="background:#f1f5f9;color:#6b7280;"><i class="la la-times"></i></a>
                            @endif
                        </div>
                    </div>
                </div>
            </form>

            @if ($new->isEmpty())
                <div class="news-empty">
                    <i class="la la-newspaper-o d-block mb-3"></i>
                    <h4 style="color:#1a237e;font-family:Georgia,serif;">Sin noticias</h4>
                    <p class="text-muted">No se encontraron noticias. Intenta con otra búsqueda o vuelve más tarde.</p>
                </div>
            @else
                @php
                    $featured = $new->first();
                    $secondary = $new->slice(1, 3);
                    $rest = $new->slice(4);
                @endphp

                {{-- FEATURED --}}
                <div class="news-featured mb-4" data-bs-toggle="modal" data-bs-target="#modalNoticia{{ $featured->id }}">
                    <div class="row g-0">
                        <div class="col-md-7">
                            <div class="news-featured-img" style="height:400px;">
                                <img src="{{ asset('storage/' . $featured->imagen_destacada) }}" style="height:100%;object-fit:cover;" alt="{{ $featured->titulo }}">
                                <div class="news-card-overlay">
                                    <span class="news-badge" style="background:rgba(255,255,255,0.95);color:#1a237e;">
                                        <i class="la la-star"></i> Destacada
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5 d-flex flex-column justify-content-center p-4 p-md-5">
                            <div class="news-info-row mb-2">
                                <i class="la la-calendar" style="color:#0d47a1;"></i>
                                <span>{{ $featured->created_at->format('d/m/Y') }}</span>
                            </div>
                            <h3 class="news-card-title" style="font-size:1.5rem;">{{ $featured->titulo }}</h3>
                            <p class="news-card-text" style="font-size:0.95rem;">{{ Str::limit($featured->resumen, 200) }}</p>
                            <div class="news-info-row mb-3">
                                <i class="la la-user" style="color:#0d47a1;"></i> <span>{{ $featured->autor }}</span>
                                <span class="mx-1">·</span>
                                <i class="la la-bookmark" style="color:#0d47a1;"></i> <span>{{ $featured->fuente }}</span>
                            </div>
                            <div>
                                <button class="news-btn news-btn-primary">Leer más <i class="la la-arrow-right"></i></button>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- SECONDARY --}}
                @if ($secondary->isNotEmpty())
                    <div class="news-divider"></div>
                    <div class="mb-4">
                        <div class="news-section-label">Últimas</div>
                        <h3 class="news-section-title">Más Noticias</h3>
                    </div>
                    <div class="row g-4 mb-4">
                        @foreach ($secondary as $noticia)
                            <div class="col-md-4">
                                <div class="news-card h-100 d-flex flex-column" data-bs-toggle="modal" data-bs-target="#modalNoticia{{ $noticia->id }}">
                                    <div class="news-card-img">
                                        <img src="{{ asset('storage/' . $noticia->imagen_destacada) }}" alt="{{ $noticia->titulo }}">
                                        <div class="news-card-overlay">
                                            <span class="news-badge" style="background:rgba(255,255,255,0.95);color:#0d47a1;">
                                                <i class="la la-calendar"></i> {{ $noticia->created_at->format('d/m/Y') }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="news-card-body d-flex flex-column flex-grow-1">
                                        <h5 class="news-card-title">{{ $noticia->titulo }}</h5>
                                        <p class="news-card-text flex-grow-1">{{ Str::limit($noticia->resumen, 120) }}</p>
                                        <div class="mt-auto">
                                            <button class="news-btn news-btn-primary w-100 justify-content-center">Leer más <i class="la la-arrow-right"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif

                {{-- REST --}}
                @if ($rest->isNotEmpty())
                    <div class="news-divider"></div>
                    <div class="mb-4">
                        <div class="news-section-label">Recientes</div>
                        <h3 class="news-section-title">Todas las Noticias</h3>
                    </div>
                    <div class="row g-4">
                        @foreach ($rest as $noticia)
                            <div class="col-md-6 col-lg-3">
                                <div class="news-card h-100 d-flex flex-column" data-bs-toggle="modal" data-bs-target="#modalNoticia{{ $noticia->id }}">
                                    <div class="news-card-img">
                                        <img src="{{ asset('storage/' . $noticia->imagen_destacada) }}" alt="{{ $noticia->titulo }}">
                                        <div class="news-card-overlay">
                                            <span class="news-badge" style="background:rgba(255,255,255,0.95);color:#0d47a1;">
                                                <i class="la la-calendar"></i> {{ $noticia->created_at->format('d/m/Y') }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="news-card-body d-flex flex-column flex-grow-1">
                                        <h5 class="news-card-title" style="font-size:1rem;">{{ $noticia->titulo }}</h5>
                                        <p class="news-card-text" style="font-size:0.85rem;">{{ Str::limit($noticia->resumen, 90) }}</p>
                                        <div class="mt-auto">
                                            <button class="news-btn news-btn-primary w-100 justify-content-center" style="padding:8px 16px;font-size:0.8rem;">Leer <i class="la la-arrow-right"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            @endif

        </div>
    </section>

    {{-- MODALES --}}
    @foreach ($new as $noticias)
        <div class="modal fade" id="modalNoticia{{ $noticias->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content border-0 shadow-lg" style="border-radius:16px;overflow:hidden;">
                    <div class="modal-header border-0 py-3 px-4" style="background:linear-gradient(135deg,#0d47a1,#1e88e5);color:#fff;">
                        <h5 class="modal-title fw-bold" style="font-family:Georgia,serif;color:#fff;">{{ $noticias->titulo }}</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body p-0">
                        @php
                            $allImages = collect();
                            $allImages->push(['src' => asset('storage/' . $noticias->imagen_destacada), 'alt' => $noticias->titulo]);
                            if ($noticias->imagenes) {
                                foreach ($noticias->imagenes->take(8) as $img) {
                                    $allImages->push(['src' => asset('storage/' . $img->imagen), 'alt' => $noticias->titulo]);
                                }
                            }
                            $hasCarousel = $allImages->count() > 1;
                        @endphp
                        @if ($hasCarousel)
                            <div id="carouselNoticia{{ $noticias->id }}" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-indicators">
                                    @foreach ($allImages as $index => $img)
                                        <button type="button" data-bs-target="#carouselNoticia{{ $noticias->id }}" data-bs-slide-to="{{ $index }}" class="{{ $index === 0 ? 'active' : '' }}" style="background-color:#0d47a1;"></button>
                                    @endforeach
                                </div>
                                <div class="carousel-inner">
                                    @foreach ($allImages as $index => $img)
                                        <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                            <img src="{{ $img['src'] }}" class="d-block w-100" style="max-height:450px;object-fit:cover;" alt="{{ $img['alt'] }}">
                                        </div>
                                    @endforeach
                                </div>
                                <button class="carousel-control-prev" type="button" data-bs-target="#carouselNoticia{{ $noticias->id }}" data-bs-slide="prev"><span class="carousel-control-prev-icon"></span></button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carouselNoticia{{ $noticias->id }}" data-bs-slide="next"><span class="carousel-control-next-icon"></span></button>
                            </div>
                        @elseif ($allImages->count() === 1)
                            <img src="{{ $allImages->first()['src'] }}" class="d-block w-100" style="max-height:450px;object-fit:cover;" alt="{{ $allImages->first()['alt'] }}">
                        @endif
                        <div class="p-4">
                            <div class="d-flex align-items-center flex-wrap gap-3 mb-3" style="font-size:0.85rem;color:#6b7280;">
                                <span><i class="la la-calendar me-1" style="color:#0d47a1;"></i> {{ $noticias->created_at->format('d/m/Y') }}</span>
                                <span><i class="la la-user me-1" style="color:#0d47a1;"></i> {{ $noticias->autor }}</span>
                                <span><i class="la la-bookmark me-1" style="color:#0d47a1;"></i> {{ $noticias->fuente }}</span>
                            </div>
                            <p style="font-size:1rem;line-height:1.8;color:#374151;">{!! nl2br(e($noticias->resumen)) !!}</p>
                            @if ($noticias->video_link)
                                <div class="ratio ratio-16x9 mt-4 rounded-3 overflow-hidden">
                                    @php
                                        $embedUrl = $noticias->video_link;
                                        if (Str::contains($noticias->video_link, 'youtube.com/watch')) { parse_str(parse_url($noticias->video_link, PHP_URL_QUERY), $params); $embedUrl = 'https://www.youtube.com/embed/' . ($params['v'] ?? ''); }
                                        elseif (Str::contains($noticias->video_link, 'youtu.be/')) { $embedUrl = 'https://www.youtube.com/embed/' . Str::after($noticias->video_link, 'youtu.be/'); }
                                        elseif (Str::contains($noticias->video_link, 'vimeo.com/')) { $embedUrl = 'https://player.vimeo.com/video/' . Str::after($noticias->video_link, 'vimeo.com/'); }
                                    @endphp
                                    <iframe src="{{ $embedUrl }}" allowfullscreen allow="accelerometer;autoplay;clipboard-write;encrypted-media;gyroscope;picture-in-picture"></iframe>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="modal-footer border-0 py-2" style="background:#f9fafb;">
                        <button type="button" class="news-btn news-btn-primary" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

</x-layouts.public>
