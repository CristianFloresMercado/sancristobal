@php
    use Illuminate\Support\Facades\Storage;
    use Illuminate\Support\Str;
@endphp

<x-layouts.public>

    <section style="background:linear-gradient(135deg,#0d47a1 0%,#1565c0 40%,#1e88e5 100%);padding:30px 0;text-align:center;">
        <div class="container">
            <h2 class="text-white mb-1" style="font-family:Georgia,'Times New Roman',serif;font-size:2rem;font-weight:700;">Sitios Turísticos</h2>
            <p class="text-white-50 mb-0" style="font-size:0.9rem;">Los lugares más hermosos de San Cristóbal te esperan</p>
        </div>
    </section>

    <style>
        .tour-search { border:2px solid transparent;background:linear-gradient(#fff,#fff) padding-box,linear-gradient(135deg,#0d47a1,#42a5f5) border-box;border-radius:50px;transition:box-shadow .3s; }
        .tour-search:focus-within { box-shadow:0 0 0 3px rgba(13,71,161,0.15); }
        .tour-card { border:none;border-radius:16px;overflow:hidden;background:#fff;transition:transform .35s cubic-bezier(.4,0,.2,1),box-shadow .35s;position:relative; }
        .tour-card:hover { transform:translateY(-8px);box-shadow:0 20px 50px rgba(0,0,0,0.12); }
        .tour-card-img { position:relative;overflow:hidden;height:280px; }
        .tour-card-img img { width:100%;height:100%;object-fit:cover;transition:transform .6s cubic-bezier(.4,0,.2,1); }
        .tour-card:hover .tour-card-img img { transform:scale(1.08); }
        .tour-card-img::after { content:'';position:absolute;inset:0;background:linear-gradient(transparent 50%,rgba(0,0,0,0.6));pointer-events:none; }
        .tour-card-overlay { position:absolute;bottom:0;left:0;right:0;padding:1.25rem;z-index:2; }
        .tour-badge { display:inline-flex;align-items:center;gap:4px;padding:4px 12px;border-radius:50px;font-size:0.7rem;font-weight:600;text-transform:uppercase;letter-spacing:0.5px; }
        .tour-card-body { padding:1.25rem 1.5rem 1.5rem; }
        .tour-card-title { font-family:Georgia,'Times New Roman',serif;font-weight:700;font-size:1.15rem;color:#1a237e;margin-bottom:0.5rem;line-height:1.3; }
        .tour-card-text { font-size:0.9rem;color:#6b7280;line-height:1.6;margin-bottom:1rem; }
        .tour-info-row { display:flex;align-items:center;gap:8px;font-size:0.82rem;color:#6b7280;margin-bottom:6px; }
        .tour-info-row i { width:20px;text-align:center;font-size:1rem; }
        .tour-btn { display:inline-flex;align-items:center;gap:6px;padding:10px 24px;border-radius:50px;font-weight:600;font-size:0.85rem;border:none;cursor:pointer;transition:all .3s; }
        .tour-btn-primary { background:linear-gradient(135deg,#0d47a1,#1565c0);color:#fff; }
        .tour-btn-primary:hover { background:linear-gradient(135deg,#1565c0,#1e88e5);box-shadow:0 4px 15px rgba(13,71,161,0.3);transform:translateY(-1px);color:#fff;text-decoration:none; }
        .tour-empty { padding:80px 20px;text-align:center; }
        .tour-empty i { font-size:4rem;color:#bbdefb; }
        .leaflet-control-attribution { display: none !important; }
    </style>

    <section style="background:#f8fafc;padding:20px 0 60px;">
        <div class="container">

            <form method="GET" action="{{ route('turismo') }}" class="mb-4">
                <div class="row justify-content-center">
                    <div class="col-lg-6 col-md-8">
                        <div class="input-group tour-search bg-white shadow-sm">
                            <span class="input-group-text bg-transparent border-0"><i class="la la-search" style="color:#1a237e;font-size:1.1rem;"></i></span>
                            <input type="text" name="buscar" class="form-control border-0" style="padding:12px 0;font-size:0.95rem;" placeholder="Buscar sitios turísticos..." value="{{ request('buscar') }}">
                            <button class="tour-btn tour-btn-primary me-2" type="submit">Buscar</button>
                            @if (request('buscar'))
                                <a href="{{ route('turismo') }}" class="tour-btn me-3" style="background:#f1f5f9;color:#6b7280;"><i class="la la-times"></i></a>
                            @endif
                        </div>
                    </div>
                </div>
            </form>

            <div class="row g-4">
                @if ($touristsites->isEmpty())
                    <div class="col-12">
                        <div class="tour-empty">
                            <i class="la la-map-marked d-block mb-3"></i>
                            <h4 style="color:#1a237e;font-family:Georgia,serif;">Sin resultados</h4>
                            <p class="text-muted">No se encontraron sitios turísticos. Intenta con otra búsqueda.</p>
                        </div>
                    </div>
                @else
                    @foreach ($touristsites as $site)
                        @php
                            $imgs = $site->imagenes->sortBy('orden')->take(4);
                            $hasExtra = $imgs->isNotEmpty();
                        @endphp
                        <div class="col-lg-4 col-md-6 col-12">
                            <div class="tour-card h-100 d-flex flex-column">

                                <div class="tour-card-img">
                                    <img src="{{ asset('storage/' . $site->imagen_destacada) }}" alt="{{ $site->titulo }}">
                                    @if ($site->ubicacion)
                                        <div class="tour-card-overlay">
                                            <span class="tour-badge" style="background:rgba(255,255,255,0.95);color:#e53935;">
                                                <i class="la la-map-marker"></i> {{ Str::limit($site->ubicacion, 40) }}
                                            </span>
                                        </div>
                                    @endif
                                </div>

                                <div class="tour-card-body d-flex flex-column flex-grow-1">
                                    <h5 class="tour-card-title">{{ $site->titulo }}</h5>
                                    <p class="tour-card-text flex-grow-1">{{ Str::limit($site->resumen, 110) }}</p>

                                    @if ($site->horario)
                                        <div class="tour-info-row mb-3">
                                            <i class="la la-clock-o" style="color:#0d47a1;"></i>
                                            <span>{{ $site->horario }}</span>
                                        </div>
                                    @endif

                                    <div class="mt-auto">
                                        <button class="tour-btn tour-btn-primary w-100 justify-content-center"
                                            data-bs-toggle="modal" data-bs-target="#modal-site-{{ $site->id }}"
                                            data-lat="{{ $site->latitud }}" data-lng="{{ $site->longitud }}"
                                            data-title="{{ $site->titulo }}">
                                            Explorar <i class="la la-arrow-right"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="modal-site-{{ $site->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                                <div class="modal-content border-0 shadow-lg" style="border-radius:16px;overflow:hidden;">
                                    <div class="modal-header border-0 py-3 px-4" style="background:linear-gradient(135deg,#0d47a1,#1e88e5);color:#fff;">
                                        <h5 class="modal-title fw-bold" style="font-family:Georgia,serif;color:#fff;">{{ $site->titulo }}</h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body p-0">
                                        @php
                                            $allImgs = $site->imagenes->sortBy('orden');
                                            $modalHasExtra = $allImgs->isNotEmpty();
                                        @endphp
                                        <div id="carousel-modal-{{ $site->id }}" class="carousel slide" data-bs-ride="carousel">
                                            @if ($modalHasExtra && $allImgs->count() > 1)
                                                <div class="carousel-indicators">
                                                    @foreach ($allImgs as $idx => $img)
                                                        <button type="button" data-bs-target="#carousel-modal-{{ $site->id }}" data-bs-slide-to="{{ $idx }}" class="{{ $idx === 0 ? 'active' : '' }}" style="background-color:#0d47a1;"></button>
                                                    @endforeach
                                                </div>
                                            @endif
                                            <div class="carousel-inner">
                                                @if ($modalHasExtra)
                                                    @foreach ($allImgs as $idx => $img)
                                                        <div class="carousel-item {{ $idx === 0 ? 'active' : '' }}">
                                                            <img src="{{ asset('storage/' . $img->imagen) }}" class="d-block w-100" style="max-height:450px;object-fit:cover;" alt="{{ $site->titulo }}">
                                                        </div>
                                                    @endforeach
                                                @else
                                                    <div class="carousel-item active">
                                                        <img src="{{ asset('storage/' . $site->imagen_destacada) }}" class="d-block w-100" style="max-height:450px;object-fit:cover;" alt="{{ $site->titulo }}">
                                                    </div>
                                                @endif
                                            </div>
                                            @if ($modalHasExtra && $allImgs->count() > 1)
                                                <button class="carousel-control-prev" type="button" data-bs-target="#carousel-modal-{{ $site->id }}" data-slide="prev"><span class="carousel-control-prev-icon"></span></button>
                                                <button class="carousel-control-next" type="button" data-bs-target="#carousel-modal-{{ $site->id }}" data-slide="next"><span class="carousel-control-next-icon"></span></button>
                                            @endif
                                        </div>
                                        <div class="p-4">
                                            <p style="font-size:1rem;line-height:1.8;color:#374151;">{!! nl2br(e($site->resumen)) !!}</p>
                                            @if ($site->ubicacion)
                                                <div class="d-flex align-items-center gap-2 mb-2">
                                                    <i class="la la-map-marker" style="color:#e53935;font-size:1.1rem;"></i>
                                                    <span style="font-weight:600;color:#1a237e;">Ubicación:</span> <span class="text-muted">{{ $site->ubicacion }}</span>
                                                </div>
                                            @endif
                                            @if ($site->horario)
                                                <div class="d-flex align-items-center gap-2 mb-3">
                                                    <i class="la la-clock-o" style="color:#0d47a1;font-size:1.1rem;"></i>
                                                    <span style="font-weight:600;color:#1a237e;">Horario:</span> <span class="text-muted">{{ $site->horario }}</span>
                                                </div>
                                            @endif

                                            @if ($site->latitud && $site->longitud)
                                                <div id="mapa-site-{{ $site->id }}" style="height:280px;width:100%;border-radius:12px;" class="mb-3 shadow-sm"></div>
                                                <button class="tour-btn tour-btn-primary" onclick="iniciarRuta({{ $site->latitud }}, {{ $site->longitud }})">
                                                    <i class="la la-location-arrow"></i> Cómo llegar
                                                </button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section>

    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

    <script>
        var userLat = null;
        var userLng = null;
        var userMarker = null;
        var routeLine = null;

        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(pos) {
                userLat = pos.coords.latitude;
                userLng = pos.coords.longitude;
            }, function() {}, { enableHighAccuracy: true });
        }

        var maps = {};

        function initSiteMap(siteId, lat, lng, title) {
            if (maps[siteId]) {
                setTimeout(function() { maps[siteId].invalidateSize(); }, 200);
                return;
            }
            var m = L.map('mapa-site-' + siteId, { maxZoom: 17, minZoom: 12 }).setView([lat, lng], 16);

            L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
                attribution: '',
                maxZoom: 17
            }).addTo(m);

            L.marker([lat, lng]).addTo(m)
                .bindTooltip('<strong>' + title + '</strong>', { permanent: true, direction: 'top', offset: [0, -10], className: 'negocio-label' })
                .bindPopup('<strong>' + title + '</strong>');

            maps[siteId] = m;

            setTimeout(function() { m.invalidateSize(); }, 300);
        }

        function iniciarRuta(destLat, destLng) {
            if (!userLat || !userLng) {
                Swal.fire({
                    icon: 'info',
                    title: 'Ubicación no disponible',
                    text: 'Activa el GPS de tu dispositivo para usar la navegación.',
                    confirmButtonColor: '#0d47a1'
                });
                return;
            }

            var googleUrl = 'https://www.google.com/maps/dir/?api=1&origin=' + userLat + ',' + userLng + '&destination=' + destLat + ',' + destLng + '&travelmode=driving';
            window.open(googleUrl, '_blank');
        }

        document.querySelectorAll('[data-bs-target^="#modal-site-"]').forEach(function(btn) {
            btn.addEventListener('click', function() {
                var modalId = this.getAttribute('data-bs-target').replace('#modal-site-', '');
                var lat = parseFloat(this.dataset.lat);
                var lng = parseFloat(this.dataset.lng);
                var title = this.dataset.title;
                if (lat && lng) {
                    initSiteMap(modalId, lat, lng, title);
                }
            });
        });
    </script>

    <style>
        .negocio-label {
            background: rgba(255,255,255,0.92);
            border: 1px solid #1a237e;
            border-radius: 6px;
            padding: 3px 8px;
            font-size: 12px;
            font-weight: 600;
            color: #1a237e;
            box-shadow: 0 2px 6px rgba(0,0,0,0.2);
            white-space: nowrap;
        }
        .negocio-label::before { border-top-color: rgba(255,255,255,0.92) !important; }
    </style>

</x-layouts.public>
