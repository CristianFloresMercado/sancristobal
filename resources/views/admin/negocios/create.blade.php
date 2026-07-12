<x-layouts.app>
    <div class="container-fluid">
        <div class="page-header mb-4">
            <div class="page-title d-flex align-items-center justify-content-between flex-wrap gap-2">
                <div>
                    <h4>Nuevo Negocio</h4>
                    <p class="text-muted mb-0">Registra un nuevo negocio en el portal</p>
                </div>
                <a href="{{ route('admin.negocios.index') }}" class="btn btn-outline-secondary" wire:navigate>
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
                <form action="{{ route('admin.negocios.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Categoría</label>
                            <select name="categoria_id" class="form-select">
                                <option value="">Seleccione una categoría</option>
                                @foreach ($categorias as $categoria)
                                    <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                                @endforeach
                            </select>
                            @error('categoria_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Subcategoría</label>
                            <select name="subcategoria_id" class="form-select">
                                <option value="">Seleccione una subcategoría</option>
                                @foreach ($subcategorias as $subcategoria)
                                    <option value="{{ $subcategoria->id }}">{{ $subcategoria->nombre }}</option>
                                @endforeach
                            </select>
                            @error('subcategoria_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Nombre</label>
                            <input type="text" name="nombre" value="{{ old('nombre') }}" class="form-control">
                            @error('nombre')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Dirección</label>
                            <input type="text" name="direccion" value="{{ old('direccion') }}" class="form-control">
                            @error('direccion')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-12">
                            <label class="form-label">Descripción</label>
                            <textarea name="descripcion" rows="4" class="form-control">{{ old('descripcion') }}</textarea>
                            @error('descripcion')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Logo</label>
                            <input type="file" name="logo" id="logoInput" class="form-control" accept="image/*">
                            <img id="logoPreview" class="mt-3 rounded border d-none" style="width: 100px; height: 100px; object-fit: cover;">
                            @error('logo')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Foto Principal</label>
                            <input type="file" name="foto_principal" id="fotoInput" class="form-control" accept="image/*">
                            <img id="fotoPreview" class="mt-3 rounded border d-none" style="width: 150px; height: 100px; object-fit: cover;">
                            @error('foto_principal')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-12">
                            <label class="form-label">Galería de Imágenes (máx. 9)</label>
                            <input type="file" name="imagenes[]" multiple accept="image/*" class="form-control" id="gallery-input">
                            <small class="text-muted">Puedes seleccionar varias imágenes a la vez para el carrusel del negocio.</small>
                            <div id="gallery-preview" class="d-flex flex-wrap gap-2 mt-2"></div>
                            @error('imagenes') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-bold">Seleccione ubicación en el mapa</label>
                            <div id="mapa" class="border rounded-3 overflow-hidden"
                                style="height: 400px; width: 100%;">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Latitud</label>
                            <input type="text" name="latitud" id="latitud" value="{{ old('latitud') }}" class="form-control">
                            @error('latitud')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Longitud</label>
                            <input type="text" name="longitud" id="longitud" value="{{ old('longitud') }}" class="form-control">
                            @error('longitud')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Teléfono</label>
                            <input type="text" name="telefono" value="{{ old('telefono') }}" class="form-control">
                            @error('telefono')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">WhatsApp</label>
                            <input type="text" name="whatsapp" value="{{ old('whatsapp') }}" class="form-control">
                            @error('whatsapp')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Correo</label>
                            <input type="email" name="correo" value="{{ old('correo') }}" class="form-control">
                            @error('correo')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Sitio Web</label>
                            <input type="text" name="sitio_web" value="{{ old('sitio_web') }}" class="form-control">
                            @error('sitio_web')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Facebook</label>
                            <input type="text" name="facebook" value="{{ old('facebook') }}" class="form-control">
                            @error('facebook')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Instagram</label>
                            <input type="text" name="instagram" value="{{ old('instagram') }}" class="form-control">
                            @error('instagram')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">TikTok</label>
                            <input type="text" name="tiktok" value="{{ old('tiktok') }}" class="form-control">
                            @error('tiktok')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Horario</label>
                            <input type="text" name="horario" value="{{ old('horario') }}" class="form-control">
                            @error('horario')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Plan</label>
                            <select name="plan" class="form-select">
                                <option value="none">Ninguno</option>
                                <option value="mensual">Mensual</option>
                                <option value="anual">Anual</option>
                            </select>
                            @error('plan')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-3 d-flex align-items-end">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="publicado" value="1" id="publicado">
                                <label class="form-check-label" for="publicado">Publicado</label>
                            </div>
                        </div>

                        <div class="col-12 text-end">
                            <button type="submit" class="btn btn-success px-4">
                                <i class="bx bx-save me-1"></i>Guardar Negocio
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

    <script>
        const mapa = L.map('mapa', { maxZoom: 17, minZoom: 14 }).setView([-21.154317257395107, -67.16457366943361], 16);

        L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
            attribution: 'Tiles © Esri',
            maxZoom: 17,
        }).addTo(mapa);

        let marcador = L.marker([-21.154317257395107, -67.16457366943361]).addTo(mapa);

        mapa.on('click', function(e) {
            const lat = e.latlng.lat;
            const lng = e.latlng.lng;

            document.getElementById('latitud').value = lat;
            document.getElementById('longitud').value = lng;

            if (marcador) { mapa.removeLayer(marcador); }

            marcador = L.marker([lat, lng])
                .addTo(mapa)
                .bindPopup('Ubicación seleccionada')
                .openPopup();
        });
    </script>

    <script>
        document.getElementById('logoInput').addEventListener('change', function(e) {
            const archivo = e.target.files[0];
            if (archivo) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    const img = document.getElementById('logoPreview');
                    img.src = event.target.result;
                    img.classList.remove('d-none');
                }
                reader.readAsDataURL(archivo);
            }
        });

        document.getElementById('fotoInput').addEventListener('change', function(e) {
            const archivo = e.target.files[0];
            if (archivo) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    const img = document.getElementById('fotoPreview');
                    img.src = event.target.result;
                    img.classList.remove('d-none');
                }
                reader.readAsDataURL(archivo);
            }
        });

        document.getElementById('gallery-input').addEventListener('change', function(e) {
            const container = document.getElementById('gallery-preview');
            container.innerHTML = '';
            const files = Array.from(e.target.files).slice(0, 9);
            files.forEach(function(file) {
                if (file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = function(event) {
                        const img = document.createElement('img');
                        img.src = event.target.result;
                        img.className = 'rounded border';
                        img.style.cssText = 'width:80px;height:80px;object-fit:cover;';
                        container.appendChild(img);
                    }
                    reader.readAsDataURL(file);
                }
            });
        });
    </script>
</x-layouts.app>
