<x-layouts.app>
    <div class="container-fluid">
        <div class="page-header mb-4">
            <div class="page-title d-flex align-items-center justify-content-between flex-wrap gap-2">
                <div>
                    <h4>{{ $profesional->nombre }}</h4>
                    <p class="text-muted mb-0">{{ $profesional->especialidad }}</p>
                </div>
                <a href="{{ route('admin.profesionales.index') }}" class="btn btn-outline-secondary" wire:navigate>
                    <i class="bx bx-arrow-back me-1"></i>Volver
                </a>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-body text-center">
                        @if($profesional->foto)
                            <img src="{{ asset('storage/' . $profesional->foto) }}" class="rounded-circle mb-3" width="120" height="120" style="object-fit: cover;" alt="{{ $profesional->nombre }}">
                        @else
                            <div class="rounded-circle bg-light d-flex align-items-center justify-content-center mx-auto mb-3" style="width:120px;height:120px;">
                                <i class="bx bx-user text-muted" style="font-size: 3rem;"></i>
                            </div>
                        @endif

                        <h5 class="mb-1">{{ $profesional->nombre }}</h5>
                        <p class="text-muted mb-2">{{ $profesional->especialidad }}</p>

                        @if($profesional->sub_especialidad)
                            <p class="text-muted small"><em>{{ $profesional->sub_especialidad }}</em></p>
                        @endif

                        <span class="badge {{ $profesional->disponibilidad === 'disponible' ? 'bg-success' : 'bg-warning text-dark' }} mb-3">
                            {{ ucfirst($profesional->disponibilidad) }}
                        </span>

                        <div class="d-flex justify-content-center gap-2 mt-3">
                            <a href="{{ route('admin.profesionales.edit', $profesional) }}" class="btn btn-primary btn-sm" wire:navigate>
                                <i class="bx bx-edit me-1"></i>Editar
                            </a>
                            @if($profesional->curriculum)
                                <a href="{{ asset('storage/' . $profesional->curriculum) }}" target="_blank" class="btn btn-outline-info btn-sm">
                                    <i class="bx bx-file me-1"></i>Ver CV
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white border-bottom">
                        <h6 class="mb-0"><i class="bx bx-info-circle me-1"></i>Información del Profesional</h6>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            @if($profesional->telefono)
                                <div class="col-sm-6">
                                    <small class="text-muted d-block">Teléfono</small>
                                    <span><i class="bx bx-phone me-1"></i>{{ $profesional->telefono }}</span>
                                </div>
                            @endif

                            @if($profesional->email)
                                <div class="col-sm-6">
                                    <small class="text-muted d-block">Email</small>
                                    <span><i class="bx bx-envelope me-1"></i>{{ $profesional->email }}</span>
                                </div>
                            @endif

                            @if($profesional->direccion)
                                <div class="col-sm-6">
                                    <small class="text-muted d-block">Dirección</small>
                                    <span><i class="bx bx-map me-1"></i>{{ $profesional->direccion }}</span>
                                </div>
                            @endif

                            @if($profesional->localidad_nacimiento)
                                <div class="col-sm-6">
                                    <small class="text-muted d-block">Localidad de nacimiento</small>
                                    <span><i class="bx bx-home me-1"></i>{{ $profesional->localidad_nacimiento }}</span>
                                </div>
                            @endif

                            @if($profesional->residencia_actual)
                                <div class="col-sm-6">
                                    <small class="text-muted d-block">Residencia actual</small>
                                    <span><i class="bx bx-map-pin me-1"></i>{{ $profesional->residencia_actual }}</span>
                                </div>
                            @endif

                            @if($profesional->horario)
                                <div class="col-sm-6">
                                    <small class="text-muted d-block">Horario</small>
                                    <span><i class="bx bx-time me-1"></i>{{ $profesional->horario }}</span>
                                </div>
                            @endif

                            @if($profesional->experiencia_anios)
                                <div class="col-sm-6">
                                    <small class="text-muted d-block">Experiencia</small>
                                    <span><i class="bx bx-briefcase me-1"></i>{{ $profesional->experiencia_anios }} años</span>
                                </div>
                            @endif

                            @if($profesional->facebook || $profesional->instagram)
                                <div class="col-sm-6">
                                    <small class="text-muted d-block">Redes Sociales</small>
                                    @if($profesional->facebook)
                                        <a href="{{ $profesional->facebook }}" target="_blank" class="me-2"><i class="bx bxl-facebook"></i></a>
                                    @endif
                                    @if($profesional->instagram)
                                        <a href="{{ $profesional->instagram }}" target="_blank"><i class="bx bxl-instagram"></i></a>
                                    @endif
                                </div>
                            @endif
                        </div>

                        @if($profesional->observaciones)
                            <hr>
                            <small class="text-muted d-block mb-1">Observaciones</small>
                            <p class="mb-0">{{ $profesional->observaciones }}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
