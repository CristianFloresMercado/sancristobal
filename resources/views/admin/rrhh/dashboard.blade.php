<x-layouts.app>
    <div class="container-fluid">
        <div class="page-header mb-4">
            <div class="page-title">
                <h4>Panel de Recursos Humanos</h4>
                <p class="text-muted mb-0">Gestión del banco de profesionales</p>
            </div>
        </div>

        @php
            $totalProfesionales = \App\Models\Profesional::count();
            $disponibles = \App\Models\Profesional::where('disponibilidad', 'disponible')->count();
            $ocupados = \App\Models\Profesional::where('disponibilidad', 'ocupado')->count();
            $profRecientes = \App\Models\Profesional::latest()->take(5)->get();
        @endphp

        <div class="row g-3 mb-4">
            <div class="col-sm-6 col-lg-3">
                <div class="card border-0 shadow-sm bg-primary text-white">
                    <div class="card-body d-flex align-items-center gap-3">
                        <i class="bx bx-group fs-1"></i>
                        <div>
                            <h3 class="mb-0">{{ $totalProfesionales }}</h3>
                            <small>Total Profesionales</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="card border-0 shadow-sm bg-success text-white">
                    <div class="card-body d-flex align-items-center gap-3">
                        <i class="bx bx-check-circle fs-1"></i>
                        <div>
                            <h3 class="mb-0">{{ $disponibles }}</h3>
                            <small>Disponibles</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="card border-0 shadow-sm bg-warning text-dark">
                    <div class="card-body d-flex align-items-center gap-3">
                        <i class="bx bx-time fs-1"></i>
                        <div>
                            <h3 class="mb-0">{{ $ocupados }}</h3>
                            <small>Ocupados</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-3">
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white border-bottom d-flex justify-content-between align-items-center">
                        <h6 class="mb-0">Profesionales Recientes</h6>
                        <a href="{{ route('admin.profesionales.index') }}" class="btn btn-sm btn-outline-primary" wire:navigate>Ver todos</a>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Especialidad</th>
                                        <th>Residencia</th>
                                        <th>Disponibilidad</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($profRecientes as $prof)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center gap-2">
                                                    @if($prof->foto)
                                                        <img src="{{ asset('storage/' . $prof->foto) }}" class="rounded-circle" width="32" height="32" style="object-fit:cover;" alt="">
                                                    @else
                                                        <div class="rounded-circle bg-light d-flex align-items-center justify-content-center" style="width:32px;height:32px;">
                                                            <i class="bx bx-user text-muted small"></i>
                                                        </div>
                                                    @endif
                                                    {{ $prof->nombre }}
                                                </div>
                                            </td>
                                            <td>{{ $prof->especialidad }}</td>
                                            <td>{{ $prof->residencia_actual ?? '—' }}</td>
                                            <td>
                                                <span class="badge {{ $prof->disponibilidad === 'disponible' ? 'bg-success' : 'bg-warning text-dark' }}">
                                                    {{ ucfirst($prof->disponibilidad) }}
                                                </span>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center text-muted py-4">Sin profesionales registrados</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white border-bottom">
                        <h6 class="mb-0">Acciones Rápidas</h6>
                    </div>
                    <div class="card-body d-flex flex-column gap-2">
                        <a href="{{ route('admin.profesionales.index') }}" class="btn btn-primary" wire:navigate>
                            <i class="bx bx-list-ul me-1"></i>Ver Banco de Profesionales
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
