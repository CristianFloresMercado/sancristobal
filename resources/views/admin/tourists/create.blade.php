<x-layouts.app>
    <div class="container-fluid">
        <div class="page-header mb-4">
            <div class="page-title d-flex align-items-center justify-content-between flex-wrap gap-2">
                <div>
                    <h4>Nuevo Sitio Turístico</h4>
                    <p class="text-muted mb-0">Registra un nuevo sitio turístico</p>
                </div>
                <a href="{{ route('admin.tourists.index') }}" class="btn btn-outline-secondary" wire:navigate>
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
                <form action="{{ route('admin.tourists.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row g-3">
                        <div class="col-12 text-center">
                            <img id="preview-image" src="https://thumb.ac-illust.com/b1/b170870007dfa419295d949814474ab2_t.jpeg"
                                class="img-fluid rounded border shadow-sm mb-3"
                                style="width: 100%; max-width: 450px; height: 350px; object-fit: cover;" alt="Vista previa">
                            <div>
                                <label class="btn btn-primary btn-sm">
                                    <i class="bx bx-image me-1"></i>Subir Imagen Destacada
                                    <input type="file" name="imagen" id="input-image" accept="image/*" class="d-none">
                                </label>
                            </div>
                            @error('imagen')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Título</label>
                            <input type="text" name="titulo" value="{{ old('titulo') }}" placeholder="Ej. Laguna Verde"
                                class="form-control">
                            @error('titulo')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Ubicación</label>
                            <input type="text" name="ubicacion" value="{{ old('ubicacion') }}" placeholder="Ej. Provincia Sud Chichas"
                                class="form-control">
                            @error('ubicacion')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-12">
                            <label class="form-label">Galería de Imágenes (máx. 4)</label>
                            <input type="file" name="imagenes[]" multiple accept="image/*" class="form-control" id="gallery-input">
                            <small class="text-muted">Puedes seleccionar varias imágenes a la vez para el carrusel del sitio turístico.</small>
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
                            <label class="form-label">Horario</label>
                            <input type="text" name="horario" value="{{ old('horario') }}" placeholder="Ej. Lunes a domingo de 8:00 a 18:00"
                                class="form-control">
                            @error('horario')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-12">
                            <label class="form-label">Resumen</label>
                            <textarea name="resumen" rows="4" class="form-control">{{ old('resumen') }}</textarea>
                            @error('resumen')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">¿Publicado?</label>
                            <div class="d-flex gap-4 mt-1">
                                <div class="form-check">
                                    <input type="radio" name="publicado" value="1" class="form-check-input" id="pubSi" checked>
                                    <label class="form-check-label" for="pubSi">Sí</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" name="publicado" value="0" class="form-check-input" id="pubNo">
                                    <label class="form-check-label" for="pubNo">No</label>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 text-end">
                            <button type="submit" class="btn btn-success px-4">
                                <i class="bx bx-save me-1"></i>Guardar Sitio
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
        function initMapa() {
            if (typeof L === 'undefined' || !document.getElementById('mapa')) return;

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

            setTimeout(function() { mapa.invalidateSize(); }, 200);
        }

        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initMapa);
        } else {
            initMapa();
        }
    </script>

    <script>
        document.getElementById('input-image').addEventListener('change', function (e) {
            const file = e.target.files[0];
            const preview = document.getElementById('preview-image');
            if (file && file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function (event) {
                    preview.src = event.target.result;
                }
                reader.readAsDataURL(file);
            }
        });

        document.getElementById('gallery-input').addEventListener('change', function(e) {
            const container = document.getElementById('gallery-preview');
            container.innerHTML = '';
            const files = Array.from(e.target.files).slice(0, 4);
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
