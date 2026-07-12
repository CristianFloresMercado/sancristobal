<x-layouts.app>
    <div class="container-fluid">
        <div class="page-header mb-4">
            <div class="page-title">
                <h4>Mi Panel</h4>
                <p class="text-muted mb-0">Bienvenido, {{ auth()->user()->name }}</p>
            </div>
        </div>

        <div class="row g-3 mb-4">
            <div class="col-6 col-md-4 col-xl">
                <div class="card border-0 shadow-sm h-100" style="background: linear-gradient(135deg, #3b82f6, #2563eb);">
                    <div class="card-body text-white py-3">
                        <div class="d-flex align-items-center justify-content-between">
                            <div style="min-width:0;">
                                <h3 class="mb-0 fw-bold">{{ auth()->user()->news()->count() }}</h3>
                                <small class="opacity-75">Mis Noticias</small>
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
                                <h3 class="mb-0 fw-bold">{{ auth()->user()->news()->where('publicado', 1)->count() }}</h3>
                                <small class="opacity-75">Publicadas</small>
                            </div>
                            <i class="bx bx-check-circle fs-3 opacity-50 flex-shrink-0"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-4 col-xl">
                <div class="card border-0 shadow-sm h-100" style="background: linear-gradient(135deg, #f59e0b, #d97706);">
                    <div class="card-body text-white py-3">
                        <div class="d-flex align-items-center justify-content-between">
                            <div style="min-width:0;">
                                <h3 class="mb-0 fw-bold">{{ auth()->user()->news()->where('publicado', 0)->count() }}</h3>
                                <small class="opacity-75">Borradores</small>
                            </div>
                            <i class="bx bx-file fs-3 opacity-50 flex-shrink-0"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-3">
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-transparent border-0 d-flex justify-content-between align-items-center">
                        <h6 class="mb-0"><i class="bx bx-news me-2"></i>Mis Últimas Noticias</h6>
                        <a href="{{ route('admin.mynews.index') }}" class="btn btn-sm btn-outline-primary" wire:navigate>Ver todas</a>
                    </div>
                    <div class="card-body p-0">
                        <div class="list-group list-group-flush">
                            @forelse(auth()->user()->news()->latest()->take(5)->get() as $noticia)
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
                                <div class="text-center text-muted py-4">No tienes noticias aún</div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header bg-transparent border-0">
                        <h6 class="mb-0"><i class="bx bx-info-circle me-2"></i>Acciones Rápidas</h6>
                    </div>
                    <div class="card-body d-flex flex-column gap-2">
                        <a href="{{ route('admin.mynews.create') }}" class="btn btn-primary w-100" wire:navigate>
                            <i class="bx bx-plus me-1"></i>Nueva Noticia
                        </a>
                        <a href="{{ route('admin.mynews.index') }}" class="btn btn-outline-primary w-100" wire:navigate>
                            <i class="bx bx-list-ul me-1"></i>Ver Mis Noticias
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
