<x-layouts.app>
    <div class="container-fluid">
        <div class="page-header mb-4">
            <div class="page-title d-flex align-items-center justify-content-between flex-wrap gap-2">
                <div>
                    <h4>Registrar Profesional</h4>
                    <p class="text-muted mb-0">Agregar un nuevo profesional al banco de datos</p>
                </div>
                <a href="{{ route('admin.profesionales.index') }}" class="btn btn-sm btn-outline-primary" wire:navigate>
                    <i class="bx bx-arrow-back me-1"></i>Volver
                </a>
            </div>
        </div>

        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <form action="{{ route('admin.profesionales.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row g-3">
                        <div class="col-12"><h6 class="text-muted border-bottom pb-2"><i class="bx bx-user me-1"></i>Datos Personales</h6></div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Nombre completo *</label>
                            <input type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre" value="{{ old('nombre') }}" required>
                            @error('nombre') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Foto</label>
                            <input type="file" class="form-control @error('foto') is-invalid @enderror" name="foto" accept="image/*">
                            @error('foto') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-12"><h6 class="text-muted border-bottom pb-2 mt-2"><i class="bx bx-briefcase me-1"></i>Datos Profesionales</h6></div>

                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Especialidad *</label>
                            <input type="text" class="form-control @error('especialidad') is-invalid @enderror" name="especialidad" value="{{ old('especialidad') }}" required placeholder="Ej: Medicina, Abogacía...">
                            @error('especialidad') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Sub-especialidad</label>
                            <input type="text" class="form-control" name="sub_especialidad" value="{{ old('sub_especialidad') }}" placeholder="Ej: Cardiología, Penal...">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Experiencia (años)</label>
                            <input type="number" class="form-control @error('experiencia_anios') is-invalid @enderror" name="experiencia_anios" value="{{ old('experiencia_anios') }}" min="0">
                            @error('experiencia_anios') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Disponibilidad *</label>
                            <select class="form-select @error('disponibilidad') is-invalid @enderror" name="disponibilidad" required>
                                <option value="disponible" {{ old('disponibilidad') === 'disponible' ? 'selected' : '' }}>Disponible</option>
                                <option value="ocupado" {{ old('disponibilidad') === 'ocupado' ? 'selected' : '' }}>Ocupado</option>
                            </select>
                            @error('disponibilidad') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-12"><h6 class="text-muted border-bottom pb-2 mt-2"><i class="bx bx-contact me-1"></i>Información de Contacto</h6></div>

                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Teléfono</label>
                            <input type="tel" class="form-control" name="telefono" value="{{ old('telefono') }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Email</label>
                            <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Horario</label>
                            <input type="text" class="form-control" name="horario" value="{{ old('horario') }}" placeholder="Ej: Lun-Vie 8:00-17:00">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Dirección</label>
                            <input type="text" class="form-control" name="direccion" value="{{ old('direccion') }}">
                        </div>

                        <div class="col-12"><h6 class="text-muted border-bottom pb-2 mt-2"><i class="bx bx-globe me-1"></i>Redes Sociales</h6></div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Facebook</label>
                            <input type="url" class="form-control" name="facebook" value="{{ old('facebook') }}" placeholder="https://facebook.com/...">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Instagram</label>
                            <input type="url" class="form-control" name="instagram" value="{{ old('instagram') }}" placeholder="https://instagram.com/...">
                        </div>

                        <div class="col-12"><h6 class="text-muted border-bottom pb-2 mt-2"><i class="bx bx-file me-1"></i>Documentos</h6></div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Currículum Vitae (PDF)</label>
                            <input type="file" class="form-control @error('curriculum') is-invalid @enderror" name="curriculum" accept=".pdf">
                            <small class="text-muted">Máximo 5MB. Solo archivos PDF.</small>
                            @error('curriculum') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Observaciones</label>
                            <textarea class="form-control" name="observaciones" rows="3">{{ old('observaciones') }}</textarea>
                        </div>

                        <div class="col-12">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="publicado" value="1" {{ old('publicado', '1') ? 'checked' : '' }}>
                                <label class="form-check-label fw-semibold">Publicar en el sitio público</label>
                            </div>
                        </div>
                    </div>

                    <div class="text-end mt-4">
                        <a href="{{ route('admin.profesionales.index') }}" class="btn btn-outline-secondary me-2" wire:navigate>Cancelar</a>
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="bx bx-save me-1"></i>Registrar Profesional
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layouts.app>
