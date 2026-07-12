<x-layouts.app>
    <div class="container-fluid">
        <div class="page-header mb-4">
            <div class="page-title">
                <h4>Panel de Control</h4>
                <p class="text-muted mb-0">Resumen general del portal de San Cristóbal</p>
            </div>
        </div>

        <!-- Tarjetas de estadísticas -->
        <div class="row g-3 mb-4">
            <div class="col-6 col-md-4 col-xl">
                <div class="card border-0 shadow-sm h-100" style="background: linear-gradient(135deg, #3b82f6, #2563eb);">
                    <div class="card-body text-white py-3">
                        <div class="d-flex align-items-center justify-content-between">
                            <div style="min-width:0;">
                                <h3 class="mb-0 fw-bold">{{ $totalNews }}</h3>
                                <small class="opacity-75">Noticias</small>
                            </div>
                            <i class="bx bx-news fs-3 opacity-50 flex-shrink-0"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-4 col-xl">
                <div class="card border-0 shadow-sm h-100" style="background: linear-gradient(135deg, #10b981, #059669);">
                    <div class="card-body text-white py-3">
                        <div class="d-flex align-items-center justify-content-between">
                            <div style="min-width:0;">
                                <h3 class="mb-0 fw-bold">{{ $totalTourists }}</h3>
                                <small class="opacity-75">Turismo</small>
                            </div>
                            <i class="bx bx-map fs-3 opacity-50 flex-shrink-0"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-4 col-xl">
                <div class="card border-0 shadow-sm h-100" style="background: linear-gradient(135deg, #f59e0b, #d97706);">
                    <div class="card-body text-white py-3">
                        <div class="d-flex align-items-center justify-content-between">
                            <div style="min-width:0;">
                                <h3 class="mb-0 fw-bold">{{ $totalNegocios }}</h3>
                                <small class="opacity-75">Negocios</small>
                            </div>
                            <i class="bx bx-store fs-3 opacity-50 flex-shrink-0"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-4 col-xl">
                <div class="card border-0 shadow-sm h-100" style="background: linear-gradient(135deg, #8b5cf6, #7c3aed);">
                    <div class="card-body text-white py-3">
                        <div class="d-flex align-items-center justify-content-between">
                            <div style="min-width:0;">
                                <h3 class="mb-0 fw-bold">{{ $totalProfesionales }}</h3>
                                <small class="opacity-75">Profesionales</small>
                            </div>
                            <i class="bx bx-user fs-3 opacity-50 flex-shrink-0"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-4 col-xl">
                <div class="card border-0 shadow-sm h-100" style="background: linear-gradient(135deg, #06b6d4, #0891b2);">
                    <div class="card-body text-white py-3">
                        <div class="d-flex align-items-center justify-content-between">
                            <div style="min-width:0;">
                                <h3 class="mb-0 fw-bold">{{ $totalUsers }}</h3>
                                <small class="opacity-75">Usuarios</small>
                            </div>
                            <i class="bx bx-group fs-3 opacity-50 flex-shrink-0"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-3 mb-4">
            <!-- Mapa -->
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-transparent border-0">
                        <h6 class="mb-0"><i class="bx bx-map me-2"></i>Ubicación de Negocios</h6>
                    </div>
                    <div class="card-body p-0">
                        <div id="mapa-dashboard" style="height: 350px; border-radius: 0 0 0.5rem 0.5rem;"></div>
                    </div>
                </div>
            </div>

            <!-- Info de la comunidad -->
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header bg-transparent border-0 d-flex justify-content-between align-items-center">
                        <h6 class="mb-0"><i class="bx bx-buildings me-2"></i>Información Comunitaria</h6>
                        <a href="{{ route('comunidad') }}" class="btn btn-sm btn-outline-primary" wire:navigate>Editar</a>
                    </div>
                    <div class="card-body">
                        @if($comunidad)
                            <div class="mb-3">
                                <small class="text-muted d-block">Comunidad</small>
                                <strong>{{ $comunidad->nombre_comunidad }}</strong>
                            </div>
                            <div class="mb-3">
                                <small class="text-muted d-block">Alcalde</small>
                                <span>{{ $comunidad->alcalde ?? 'No registrado' }}</span>
                            </div>
                            <div class="mb-3">
                                <small class="text-muted d-block">Tel. Municipal</small>
                                <span>{{ $comunidad->telefono_municipal ?? 'No registrado' }}</span>
                            </div>
                            <div class="mb-3">
                                <small class="text-muted d-block">Hospital</small>
                                <span>{{ $comunidad->hospital_principal ?? 'No registrado' }}</span>
                            </div>
                            <div class="mb-3">
                                <small class="text-muted d-block">Emergencias</small>
                                <span class="text-danger fw-semibold">{{ $comunidad->telefono_emergencia ?? 'No registrado' }}</span>
                            </div>
                        @else
                            <p class="text-muted text-center">Sin datos de la comunidad</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Actividad reciente -->
        <div class="row g-3">
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-transparent border-0">
                        <h6 class="mb-0"><i class="bx bx-news me-2"></i>Últimas Noticias</h6>
                    </div>
                    <div class="card-body p-0">
                        <div class="list-group list-group-flush">
                            @forelse($newsRecientes as $noticia)
                                <div class="list-group-item border-0 py-3">
                                    <div class="d-flex align-items-center gap-3">
                                        @if($noticia->imagen_destacada)
                                            <img src="{{ asset('storage/' . $noticia->imagen_destacada) }}" class="rounded flex-shrink-0" width="50" height="50" style="object-fit: cover;" alt="">
                                        @else
                                            <div class="rounded bg-light d-flex align-items-center justify-content-center flex-shrink-0" style="width:50px;height:50px;">
                                                <i class="bx bx-image text-muted"></i>
                                            </div>
                                        @endif
                                        <div class="overflow-hidden flex-grow-1">
                                            <h6 class="mb-0 text-truncate">{{ $noticia->titulo }}</h6>
                                            <small class="text-muted">{{ $noticia->created_at->diffForHumans() }}</small>
                                        </div>
                                        <span class="badge {{ $noticia->publicado ? 'bg-success' : 'bg-secondary' }} flex-shrink-0">{{ $noticia->publicado ? 'Publicado' : 'Borrador' }}</span>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center text-muted py-4">Sin noticias recientes</div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-transparent border-0">
                        <h6 class="mb-0"><i class="bx bx-store me-2"></i>Últimos Negocios</h6>
                    </div>
                    <div class="card-body p-0">
                        <div class="list-group list-group-flush">
                            @forelse($negociosRecientes as $negocio)
                                <div class="list-group-item border-0 py-3">
                                    <div class="d-flex align-items-center gap-3">
                                        @if($negocio->logo)
                                            <img src="{{ asset('storage/' . $negocio->logo) }}" class="rounded flex-shrink-0" width="50" height="50" style="object-fit: cover;" alt="">
                                        @else
                                            <div class="rounded bg-light d-flex align-items-center justify-content-center flex-shrink-0" style="width:50px;height:50px;">
                                                <i class="bx bx-store text-muted"></i>
                                            </div>
                                        @endif
                                        <div class="overflow-hidden flex-grow-1">
                                            <h6 class="mb-0 text-truncate">{{ $negocio->nombre }}</h6>
                                            <small class="text-muted text-truncate d-block">{{ $negocio->direccion ?? 'Sin dirección' }}</small>
                                        </div>
                                        <span class="badge bg-primary flex-shrink-0 text-capitalize">{{ $negocio->plan }}</span>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center text-muted py-4">Sin negocios registrados</div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-transparent border-0">
                        <h6 class="mb-0"><i class="bx bx-user me-2"></i>Últimos Profesionales</h6>
                    </div>
                    <div class="card-body p-0">
                        <div class="list-group list-group-flush">
                            @forelse($profesionalesRecientes as $profesional)
                                <div class="list-group-item border-0 py-3">
                                    <div class="d-flex align-items-center gap-3">
                                        @if($profesional->foto)
                                            <img src="{{ asset('storage/' . $profesional->foto) }}" class="rounded-circle flex-shrink-0" width="50" height="50" style="object-fit: cover;" alt="">
                                        @else
                                            <div class="rounded-circle bg-light d-flex align-items-center justify-content-center flex-shrink-0" style="width:50px;height:50px;">
                                                <i class="bx bx-user text-muted fs-4"></i>
                                            </div>
                                        @endif
                                        <div class="overflow-hidden flex-grow-1">
                                            <h6 class="mb-0 text-truncate">{{ $profesional->nombre }}</h6>
                                            <small class="text-muted text-truncate d-block">{{ $profesional->especialidad }}</small>
                                        </div>
                                        <span class="badge {{ $profesional->disponibilidad === 'disponible' ? 'bg-success' : 'bg-warning' }} flex-shrink-0">
                                            {{ ucfirst($profesional->disponibilidad) }}
                                        </span>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center text-muted py-4">Sin profesionales registrados</div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Leaflet CSS/JS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <style>
        .negocio-tooltip {
            background: rgba(26,35,126,0.9);
            color: #fff;
            border: none;
            border-radius: 6px;
            padding: 4px 10px;
            font-size: 12px;
            font-weight: 600;
            box-shadow: 0 2px 8px rgba(0,0,0,0.25);
        }
        .negocio-tooltip::before {
            border-top-color: rgba(26,35,126,0.9) !important;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var mapa = L.map('mapa-dashboard');
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap'
            }).addTo(mapa);

            var negocios = @json($negociosMapa);
            var bounds = L.latLngBounds();
            var hasCoords = false;

            negocios.forEach(function(n) {
                if (n.latitud && n.longitud) {
                    L.marker([n.latitud, n.longitud]).addTo(mapa)
                        .bindTooltip(n.nombre, { permanent: true, direction: 'top', offset: [0, -10], className: 'negocio-tooltip' })
                        .bindPopup('<strong>' + n.nombre + '</strong><br>' + (n.direccion || ''));
                    bounds.extend([n.latitud, n.longitud]);
                    hasCoords = true;
                }
            });

            if (hasCoords) {
                mapa.fitBounds(bounds, { padding: [40, 40] });
            } else {
                mapa.setView([-18.18, -65.95], 13);
            }

            setTimeout(function() { mapa.invalidateSize(); }, 300);
        });
    </script>
</x-layouts.app>
