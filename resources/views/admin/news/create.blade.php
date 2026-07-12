<x-layouts.app>
    <div class="container-fluid">
        <div class="page-header mb-4">
            <div class="page-title d-flex align-items-center justify-content-between flex-wrap gap-2">
                <div>
                    <h4>Nueva Noticia</h4>
                    <p class="text-muted mb-0">Crear una nueva noticia</p>
                </div>
                <a href="{{ auth()->user()->isPeriodista() ? route('admin.mynews.index') : route('admin.news.index') }}" class="btn btn-sm btn-outline-primary" wire:navigate>
                    <i class="bx bx-arrow-back me-1"></i>Volver
                </a>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <form action="{{ auth()->user()->isPeriodista() ? route('admin.mynews.store') : route('admin.news.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="text-center mb-4">
                                <img id="preview-image" src="https://thumb.ac-illust.com/b1/b170870007dfa419295d949814474ab2_t.jpeg"
                                    class="rounded border shadow-sm mb-2" style="width: 100%; max-width: 450px; height: auto; max-height: 300px; object-fit: cover;" alt="Vista previa">
                                <div>
                                    <label class="btn btn-primary btn-sm cursor-pointer mt-2">
                                        <i class="bx bx-image me-1"></i>Subir Imagen
                                        <input type="file" name="imagen" id="input-image" accept="image/*" class="d-none">
                                    </label>
                                    <a href="https://www.iloveimg.com/es/redimensionar-imagen" target="_blank" class="ms-2 small text-muted">Redimensionar imagen</a>
                                </div>
                                @error('imagen') <p class="text-danger small mt-1">{{ $message }}</p> @enderror
                            </div>

                            <div class="row g-3">
                                <div class="col-12">
                                    <label class="form-label fw-semibold">Título *</label>
                                    <input type="text" class="form-control @error('titulo') is-invalid @enderror" name="titulo" value="{{ old('titulo') }}" required>
                                    @error('titulo') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Autor</label>
                                    <input type="text" class="form-control" name="autor" value="{{ old('autor') }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Fuente</label>
                                    <input type="text" class="form-control" name="fuente" value="{{ old('fuente') }}">
                                </div>
                                <div class="col-12">
                                    <label class="form-label fw-semibold">Resumen *</label>
                                    <textarea class="form-control @error('resumen') is-invalid @enderror" name="resumen" rows="4" required>{{ old('resumen') }}</textarea>
                                    @error('resumen') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-12">
                                    <label class="form-label fw-semibold">Enlace de Video (YouTube, Vimeo)</label>
                                    <input type="url" class="form-control @error('video_link') is-invalid @enderror" name="video_link" value="{{ old('video_link') }}" placeholder="https://www.youtube.com/watch?v=...">
                                    <small class="text-muted">Opcional. Se embeberá automáticamente en la noticia.</small>
                                    @error('video_link') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-12">
                                    <label class="form-label fw-semibold">Galería de Imágenes (máx. 9)</label>
                                    <input type="file" class="form-control @error('imagenes') is-invalid @enderror" name="imagenes[]" multiple accept="image/*" id="gallery-input">
                                    <small class="text-muted">Puedes seleccionar varias imágenes a la vez.</small>
                                    <div id="gallery-preview" class="d-flex flex-wrap gap-2 mt-2"></div>
                                    @error('imagenes') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-12">
                                    <label class="form-label fw-semibold">Estado</label>
                                    <div class="d-flex gap-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="publicado" value="1" id="pubSi">
                                            <label class="form-check-label" for="pubSi">Publicado</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="publicado" value="0" id="pubNo" checked>
                                            <label class="form-check-label" for="pubNo">Borrador</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="text-end mt-4">
                                <button type="submit" class="btn btn-primary px-4">
                                    <i class="bx bx-save me-1"></i>Publicar Noticia
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('input-image').addEventListener('change', function (e) {
            const file = e.target.files[0];
            const preview = document.getElementById('preview-image');
            if (file && file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function (event) { preview.src = event.target.result; }
                reader.readAsDataURL(file);
            }
        });

        document.getElementById('gallery-input').addEventListener('change', function (e) {
            const container = document.getElementById('gallery-preview');
            container.innerHTML = '';
            const files = Array.from(e.target.files).slice(0, 9);
            files.forEach(function(file) {
                if (file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = function (event) {
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
