<x-layouts.app>
    <div class="container-fluid">
        <div class="page-header mb-4">
            <div class="page-title d-flex align-items-center justify-content-between flex-wrap gap-2">
                <div>
                    <h4>Editar Profesional</h4>
                    <p class="text-muted mb-0">Modificar datos de {{ $profesional->nombre }}</p>
                </div>
                <a href="{{ route('admin.profesionales.index') }}" class="btn btn-sm btn-outline-primary" wire:navigate>
                    <i class="bx bx-arrow-back me-1"></i>Volver
                </a>
            </div>
        </div>

        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <form action="{{ route('admin.profesionales.update', $profesional->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row g-3">
                        <div class="col-12"><h6 class="text-muted border-bottom pb-2"><i class="bx bx-user me-1"></i>Datos Personales</h6></div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Nombre completo *</label>
                            <input type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre" value="{{ old('nombre', $profesional->nombre) }}" required>
                            @error('nombre') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Foto actual</label>
                            @if($profesional->foto)
                                <div><img src="{{ asset('storage/' . $profesional->foto) }}" class="rounded" width="60" height="60" style="object-fit: cover;" alt=""></div>
                            @else
                                <div class="text-muted small">Sin foto</div>
                            @endif
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Nueva foto</label>
                            <input type="file" class="form-control" name="foto" accept="image/*">
                        </div>

                        <div class="col-12"><h6 class="text-muted border-bottom pb-2 mt-2"><i class="bx bx-briefcase me-1"></i>Datos Profesionales</h6></div>

                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Especialidad *</label>
                            <input type="text" class="form-control @error('especialidad') is-invalid @enderror" name="especialidad" value="{{ old('especialidad', $profesional->especialidad) }}" required>
                            @error('especialidad') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Sub-especialidad</label>
                            <input type="text" class="form-control" name="sub_especialidad" value="{{ old('sub_especialidad', $profesional->sub_especialidad) }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Experiencia (años)</label>
                            <input type="number" class="form-control" name="experiencia_anios" value="{{ old('experiencia_anios', $profesional->experiencia_anios) }}" min="0">
                        </div>

                        <div class="col-12"><h6 class="text-muted border-bottom pb-2 mt-2"><i class="bx bx-map me-1"></i>Ubicación</h6></div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Localidad de nacimiento</label>
                            <input type="text" class="form-control" name="localidad_nacimiento" value="{{ old('localidad_nacimiento', $profesional->localidad_nacimiento) }}" placeholder="Ej: San Cristóbal, Potosí...">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Residencia actual</label>
                            <input type="text" class="form-control" name="residencia_actual" value="{{ old('residencia_actual', $profesional->residencia_actual) }}" placeholder="Ej: San Cristóbal, Uyuni...">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Disponibilidad *</label>
                            <select class="form-select" name="disponibilidad" required>
                                <option value="disponible" {{ old('disponibilidad', $profesional->disponibilidad) === 'disponible' ? 'selected' : '' }}>Disponible</option>
                                <option value="ocupado" {{ old('disponibilidad', $profesional->disponibilidad) === 'ocupado' ? 'selected' : '' }}>Ocupado</option>
                            </select>
                        </div>

                        <div class="col-12"><h6 class="text-muted border-bottom pb-2 mt-2"><i class="bx bx-contact me-1"></i>Información de Contacto</h6></div>

                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Teléfono</label>
                            <input type="tel" class="form-control" name="telefono" value="{{ old('telefono', $profesional->telefono) }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Email</label>
                            <input type="email" class="form-control" name="email" value="{{ old('email', $profesional->email) }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Horario</label>
                            <input type="text" class="form-control" name="horario" value="{{ old('horario', $profesional->horario) }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Dirección</label>
                            <input type="text" class="form-control" name="direccion" value="{{ old('direccion', $profesional->direccion) }}">
                        </div>

                        <div class="col-12"><h6 class="text-muted border-bottom pb-2 mt-2"><i class="bx bx-globe me-1"></i>Redes Sociales</h6></div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Facebook</label>
                            <input type="url" class="form-control" name="facebook" value="{{ old('facebook', $profesional->facebook) }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Instagram</label>
                            <input type="url" class="form-control" name="instagram" value="{{ old('instagram', $profesional->instagram) }}">
                        </div>

                        <div class="col-12"><h6 class="text-muted border-bottom pb-2 mt-2"><i class="bx bx-file me-1"></i>Documentos</h6></div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Currículum Vitae (PDF)</label>
                            @if($profesional->curriculum)
                                <div class="mb-2"><a href="{{ asset('storage/' . $profesional->curriculum) }}" target="_blank" class="btn btn-sm btn-outline-info"><i class="bx bx-file me-1"></i>Ver CV actual</a></div>
                            @endif
                            <input type="file" class="form-control" name="curriculum" accept=".pdf">
                            <small class="text-muted">Máximo 5MB. Solo archivos PDF.</small>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Observaciones</label>
                            <textarea class="form-control" name="observaciones" rows="3">{{ old('observaciones', $profesional->observaciones) }}</textarea>
                        </div>

                        <div class="col-12">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="publicado" value="1" {{ old('publicado', $profesional->publicado) ? 'checked' : '' }}>
                                <label class="form-check-label fw-semibold">Publicar en el sitio público</label>
                            </div>
                        </div>
                    </div>

                    <div class="text-end mt-4">
                        <a href="{{ route('admin.profesionales.index') }}" class="btn btn-outline-secondary me-2" wire:navigate>Cancelar</a>
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="bx bx-save me-1"></i>Guardar Cambios
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layouts.app>
