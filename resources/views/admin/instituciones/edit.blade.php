<x-layouts.app>
    <div class="container-fluid">
        <div class="page-header mb-4">
            <div class="page-title d-flex align-items-center justify-content-between flex-wrap gap-2">
                <div>
                    <h4>Editar Institución</h4>
                    <p class="text-muted mb-0">Actualiza la información de: {{ $institucion->nombre }}</p>
                </div>
                <a href="{{ route('admin.instituciones.index') }}" class="btn btn-outline-secondary" wire:navigate>
                    <i class="bx bx-arrow-back me-1"></i>Volver
                </a>
            </div>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <form action="{{ route('admin.instituciones.update', $institucion->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Nombre</label>
                            <input type="text" name="nombre" value="{{ old('nombre', $institucion->nombre) }}" class="form-control">
                            @error('nombre')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Tipo</label>
                            <select name="tipo" class="form-select">
                                <option value="">Seleccione un tipo</option>
                                @foreach(['Hospital', 'Policía', 'Bomberos', 'Mercado', 'Municipalidad', 'Escuela', 'Colegio', 'Banco', 'Otro'] as $tipo)
                                    <option value="{{ $tipo }}" {{ old('tipo', $institucion->tipo) == $tipo ? 'selected' : '' }}>{{ $tipo }}</option>
                                @endforeach
                            </select>
                            @error('tipo')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Teléfono</label>
                            <input type="text" name="telefono" value="{{ old('telefono', $institucion->telefono) }}" class="form-control">
                            @error('telefono')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Dirección</label>
                            <input type="text" name="direccion" value="{{ old('direccion', $institucion->direccion) }}" class="form-control">
                            @error('direccion')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Horario</label>
                            <input type="text" name="horario" value="{{ old('horario', $institucion->horario) }}" class="form-control">
                            @error('horario')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Contacto</label>
                            <input type="text" name="contacto" value="{{ old('contacto', $institucion->contacto) }}" class="form-control">
                            @error('contacto')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-12">
                            <label class="form-label">Descripción</label>
                            <textarea name="descripcion" rows="4" class="form-control">{{ old('descripcion', $institucion->descripcion) }}</textarea>
                            @error('descripcion')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Imagen</label>
                            <input type="file" name="imagen" id="imagenInput" class="form-control" accept="image/*">
                            @if($institucion->imagen)
                                <img src="{{ asset('storage/' . $institucion->imagen) }}" id="imagenPreview" class="mt-3 rounded border"
                                    style="width: 150px; height: 100px; object-fit: cover;">
                            @else
                                <img id="imagenPreview" class="mt-3 rounded border d-none"
                                    style="width: 150px; height: 100px; object-fit: cover;">
                            @endif
                            @error('imagen')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-3 d-flex align-items-end">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="publicado" value="1" id="publicado"
                                    {{ old('publicado', $institucion->publicado) ? 'checked' : '' }}>
                                <label class="form-check-label" for="publicado">Publicado</label>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Orden</label>
                            <input type="number" name="orden" value="{{ old('orden', $institucion->orden) }}" class="form-control" min="0">
                            @error('orden')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-12 text-end">
                            <button type="submit" class="btn btn-primary px-4">
                                <i class="bx bx-save me-1"></i>Actualizar Institución
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('imagenInput').addEventListener('change', function(e) {
            const archivo = e.target.files[0];
            if (archivo) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    const img = document.getElementById('imagenPreview');
                    img.src = event.target.result;
                    img.classList.remove('d-none');
                }
                reader.readAsDataURL(archivo);
            }
        });
    </script>
</x-layouts.app>
