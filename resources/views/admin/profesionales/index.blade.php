<x-layouts.app>
    <div class="container-fluid">
        <div class="page-header mb-4">
            <div class="page-title d-flex align-items-center justify-content-between flex-wrap gap-2">
                <div>
                    <h4>Banco de Profesionales</h4>
                    <p class="text-muted mb-0">Gestiona los profesionales de la localidad</p>
                </div>
                <a href="{{ route('admin.profesionales.create') }}" class="btn btn-primary" wire:navigate>
                    <i class="bx bx-plus me-1"></i>Nuevo Profesional
                </a>
            </div>
        </div>

        <!-- Filtros -->
        <div class="card border-0 shadow-sm mb-3">
            <div class="card-body py-2">
                <form method="GET" class="d-flex flex-wrap gap-2 align-items-center">
                    <div class="flex-grow-1" style="min-width: 200px;">
                        <input type="text" name="buscar" class="form-control form-control-sm" placeholder="Buscar por nombre o especialidad..." value="{{ request('buscar') }}">
                    </div>
                    <select name="disponibilidad" class="form-select form-select-sm" style="width: auto;">
                        <option value="">Todas las disponibilidades</option>
                        <option value="disponible" {{ request('disponibilidad') === 'disponible' ? 'selected' : '' }}>Disponible</option>
                        <option value="ocupado" {{ request('disponibilidad') === 'ocupado' ? 'selected' : '' }}>Ocupado</option>
                    </select>
                    <button type="submit" class="btn btn-sm btn-outline-primary"><i class="bx bx-search"></i></button>
                </form>
            </div>
        </div>

        <!-- Grid de profesionales -->
        <div class="row g-3">
            @forelse($profesionales as $profesional)
                <div class="col-sm-6 col-lg-4 col-xl-3">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body text-center">
                            @if($profesional->foto)
                                <img src="{{ asset('storage/' . $profesional->foto) }}" class="rounded-circle mb-3" width="80" height="80" style="object-fit: cover;" alt="{{ $profesional->nombre }}">
                            @else
                                <div class="rounded-circle bg-light d-flex align-items-center justify-content-center mx-auto mb-3" style="width:80px;height:80px;">
                                    <i class="bx bx-user text-muted" style="font-size: 2rem;"></i>
                                </div>
                            @endif
                            <h6 class="mb-1">{{ $profesional->nombre }}</h6>
                            <p class="text-muted mb-1 small">{{ $profesional->especialidad }}</p>
                            @if($profesional->sub_especialidad)
                                <p class="text-muted mb-2 small"><em>{{ $profesional->sub_especialidad }}</em></p>
                            @endif
                            <span class="badge {{ $profesional->disponibilidad === 'disponible' ? 'bg-success' : 'bg-warning text-dark' }} mb-2">
                                {{ ucfirst($profesional->disponibilidad) }}
                            </span>
                            @if($profesional->experiencia_anios)
                                <p class="small text-muted mb-2">{{ $profesional->experiencia_anios }} años de experiencia</p>
                            @endif
                            @if($profesional->telefono)
                                <p class="small mb-1"><i class="bx bx-phone me-1"></i>{{ $profesional->telefono }}</p>
                            @endif
                        </div>
                        <div class="card-footer bg-transparent border-0 d-flex gap-1 justify-content-center pb-3">
                            <a href="{{ route('admin.profesionales.edit', $profesional) }}" class="btn btn-sm btn-outline-primary" wire:navigate title="Editar">
                                <i class="bx bx-edit"></i>
                            </a>
                            @if($profesional->curriculum)
                                <a href="{{ asset('storage/' . $profesional->curriculum) }}" target="_blank" class="btn btn-sm btn-outline-info" title="Ver CV">
                                    <i class="bx bx-file"></i>
                                </a>
                            @endif
                            <form action="{{ route('admin.profesionales.destroy', $profesional->id) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Eliminar este profesional?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" title="Eliminar">
                                    <i class="bx bx-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="text-center text-muted py-5">
                        <i class="bx bx-user fs-1 d-block mb-2"></i>
                        <p>No se encontraron profesionales</p>
                        <a href="{{ route('admin.profesionales.create') }}" class="btn btn-primary btn-sm" wire:navigate>Registrar el primero</a>
                    </div>
                </div>
            @endforelse
        </div>

        <div class="mt-3">
            {{ $profesionales->withQueryString()->links() }}
        </div>
    </div>
</x-layouts.app>
