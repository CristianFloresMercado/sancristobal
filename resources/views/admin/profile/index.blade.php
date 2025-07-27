<x-layouts.app>
    <div class="container mt-5">
        <h2 class="mb-4">Perfil de la Comunidad</h2>

        <form action="{{ route('comunidad.update', $comunidad->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="nombre_comunidad" class="form-label">Nombre de la comunidad</label>
                    <input type="text" class="form-control" id="nombre_comunidad" name="nombre_comunidad" value="{{ old('nombre_comunidad', $comunidad->nombre_comunidad) }}" required>
                </div>

                <div class="col-md-6">
                    <label for="alcalde" class="form-label">Alcalde</label>
                    <input type="text" class="form-control" id="alcalde" name="alcalde" value="{{ old('alcalde', $comunidad->alcalde) }}">
                </div>
            </div>

            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <textarea class="form-control" id="descripcion" name="descripcion" rows="3">{{ old('descripcion', $comunidad->descripcion) }}</textarea>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="telefono_municipal" class="form-label">Teléfono municipal</label>
                    <input type="tel" class="form-control" id="telefono_municipal" name="telefono_municipal" value="{{ old('telefono_municipal', $comunidad->telefono_municipal) }}">
                </div>

                <div class="col-md-6">
                    <label for="direccion_municipal" class="form-label">Dirección municipal</label>
                    <input type="text" class="form-control" id="direccion_municipal" name="direccion_municipal" value="{{ old('direccion_municipal', $comunidad->direccion_municipal) }}">
                </div>
            </div>

            <h5 class="mt-4">Hospital principal</h5>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="hospital_principal" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="hospital_principal" name="hospital_principal" value="{{ old('hospital_principal', $comunidad->hospital_principal) }}">
                </div>

                <div class="col-md-6">
                    <label for="direccion_hospital" class="form-label">Dirección</label>
                    <input type="text" class="form-control" id="direccion_hospital" name="direccion_hospital" value="{{ old('direccion_hospital', $comunidad->direccion_hospital) }}">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="telefono_hospital" class="form-label">Teléfono hospital</label>
                    <input type="tel" class="form-control" id="telefono_hospital" name="telefono_hospital" value="{{ old('telefono_hospital', $comunidad->telefono_hospital) }}">
                </div>

                <div class="col-md-4">
                    <label for="telefono_bomberos" class="form-label">Teléfono bomberos</label>
                    <input type="tel" class="form-control" id="telefono_bomberos" name="telefono_bomberos" value="{{ old('telefono_bomberos', $comunidad->telefono_bomberos) }}">
                </div>

                <div class="col-md-4">
                    <label for="telefono_policia" class="form-label">Teléfono policía</label>
                    <input type="tel" class="form-control" id="telefono_policia" name="telefono_policia" value="{{ old('telefono_policia', $comunidad->telefono_policia) }}">
                </div>
            </div>

            <div class="mb-3">
                <label for="telefono_emergencia" class="form-label">Teléfono de emergencia</label>
                <input type="tel" class="form-control" id="telefono_emergencia" name="telefono_emergencia" value="{{ old('telefono_emergencia', $comunidad->telefono_emergencia) }}">
            </div>

            <div class="mb-3">
                <label for="horarios_atencion" class="form-label">Horarios de atención</label>
                <input type="text" class="form-control" id="horarios_atencion" name="horarios_atencion" value="{{ old('horarios_atencion', $comunidad->horarios_atencion) }}">
            </div>

            <div class="mb-3">
                <label for="enlaces_utiles" class="form-label">Enlaces útiles</label>
                <textarea class="form-control" id="enlaces_utiles" name="enlaces_utiles" rows="2">{{ old('enlaces_utiles', $comunidad->enlaces_utiles) }}</textarea>
            </div>

            <div class="text-end">
                <button type="submit" class="btn btn-success">Guardar cambios</button>
            </div>
        </form>
    </div>
</x-layouts.app>
