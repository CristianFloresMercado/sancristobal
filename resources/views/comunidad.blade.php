<x-layouts.app>
    <div class="container-fluid">
        <div class="page-header mb-4">
            <div class="page-title d-flex align-items-center justify-content-between flex-wrap gap-2">
                <div>
                    <h4>Datos de la Comunidad</h4>
                    <p class="text-muted mb-0">Información general de San Cristóbal</p>
                </div>
                <a href="{{ route('dashboard') }}" class="btn btn-sm btn-outline-primary" wire:navigate>
                    <i class="bx bx-arrow-back me-1"></i>Volver al Dashboard
                </a>
            </div>
        </div>

        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <form action="{{ route('admin.profile.update', $comunidad->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Nombre de la comunidad</label>
                            <input type="text" class="form-control" name="nombre_comunidad" value="{{ old('nombre_comunidad', $comunidad->nombre_comunidad) }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Alcalde</label>
                            <input type="text" class="form-control" name="alcalde" value="{{ old('alcalde', $comunidad->alcalde) }}">
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold">Descripción</label>
                            <textarea class="form-control" name="descripcion" rows="3">{{ old('descripcion', $comunidad->descripcion) }}</textarea>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Teléfono municipal</label>
                            <input type="tel" class="form-control" name="telefono_municipal" value="{{ old('telefono_municipal', $comunidad->telefono_municipal) }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Dirección municipal</label>
                            <input type="text" class="form-control" name="direccion_municipal" value="{{ old('direccion_municipal', $comunidad->direccion_municipal) }}">
                        </div>

                        <div class="col-12"><hr><h6 class="text-muted"><i class="bx bx-link me-1"></i>Enlaces Útiles</h6></div>

                        <div class="col-12">
                            <label class="form-label fw-semibold">Enlaces útiles</label>
                            <textarea class="form-control" name="enlaces_utiles" rows="4" placeholder="Una URL por línea. Ejemplo:&#10;https://miempresa.com&#10;https://facebook.com/miempresa">{{ old('enlaces_utiles', $comunidad->enlaces_utiles) }}</textarea>
                            <small class="text-muted">Agrega enlaces a páginas de empresas, servicios o sitios de interés de la comunidad.</small>
                        </div>
                    </div>

                    <div class="text-end mt-4">
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="bx bx-save me-1"></i>Guardar cambios
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layouts.app>
