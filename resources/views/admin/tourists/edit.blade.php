<x-layouts.app>
    <div class="mb-8">
        <nav class="text-sm text-gray-500 mb-4">
            <a href="{{ route('dashboard') }}" class="hover:underline">Dashboard</a> /
            <a href="{{ route('admin.tourists.index') }}" class="hover:underline">Sitios turísticos</a> /
            <span class="text-gray-700 font-semibold">Editar sitio</span>
        </nav>

        <div class="max-w-4xl mx-auto bg-white p-8 rounded-xl shadow-md">
            <h2 class="text-2xl font-bold text-center text-blue-700 mb-6">Editar Sitio Turístico</h2>

            <form action="{{ route('admin.tourists.update', $touristSite) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                {{-- Imagen destacada --}}
                <div class="flex flex-col items-center gap-2">
                    <img id="preview-image" 
                        src="{{ asset('storage/' . $touristSite->imagen_destacada) }}" 
                        class="img-fluid rounded border border-secondary shadow-sm"
                        style="width: 450px; height: 350px; object-fit: cover;" 
                        alt="Vista previa">
                    <label class="cursor-pointer bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow">
                        Cambiar Imagen Destacada
                        <input type="file" name="imagen_destacada" id="input-image" accept="image/*" class="hidden">
                    </label>
                    @error('imagen_destacada')
                        <p class="text-red-600 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Título --}}
                <div>
                    <label class="block text-gray-700 font-medium mb-1">Título</label>
                    <input type="text" name="titulo" value="{{ old('titulo', $touristSite->titulo) }}"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2">
                </div>

                {{-- Ubicación --}}
                <div>
                    <label class="block text-gray-700 font-medium mb-1">Ubicación</label>
                    <input type="text" name="ubicacion" value="{{ old('ubicacion', $touristSite->ubicacion) }}"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2">
                </div>

                {{-- Coordenadas --}}
                <div>
                    <label class="block text-gray-700 font-medium mb-1">Coordenadas</label>
                    <input type="text" name="coordenadas" value="{{ old('coordenadas', $touristSite->coordenadas) }}"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2">
                </div>

                {{-- Horario --}}
                <div>
                    <label class="block text-gray-700 font-medium mb-1">Horario</label>
                    <input type="text" name="horario" value="{{ old('horario', $touristSite->horario) }}"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2">
                </div>

                {{-- Resumen --}}
                <div>
                    <label class="block text-gray-700 font-medium mb-1">Resumen</label>
                    <textarea name="resumen" rows="4"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 resize-none focus:ring focus:ring-blue-400">{{ old('resumen', $touristSite->resumen) }}</textarea>
                </div>

                {{-- Galería de imágenes --}}
                <div>
                    <label class="block text-gray-700 font-medium mb-1">Agregar más imágenes a la galería</label>
                    <input type="file" name="galeria_imagenes[]" multiple accept="image/*"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2">
                    <p class="text-sm text-gray-500 mt-1">Puedes seleccionar varias imágenes manteniendo presionado Ctrl o Shift.</p>
                    @error('galeria_imagenes.*')
                        <p class="text-red-600 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Publicado --}}
                <div>
                    <label class="block text-gray-700 font-medium mb-1">¿Publicado?</label>
                    <div class="flex items-center gap-6">
                        <label class="flex items-center gap-2">
                            <input type="radio" name="publicado" value="1" class="text-blue-600"
                                {{ old('publicado', $touristSite->publicado) ? 'checked' : '' }}>
                            <span>Sí</span>
                        </label>
                        <label class="flex items-center gap-2">
                            <input type="radio" name="publicado" value="0" class="text-red-600"
                                {{ !old('publicado', $touristSite->publicado) ? 'checked' : '' }}>
                            <span>No</span>
                        </label>
                    </div>
                </div>

                {{-- Botón enviar --}}
                <div class="text-end">
                    <button type="submit"
                        class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-lg shadow font-semibold">
                        Actualizar Sitio
                    </button>
                </div>
            </form>
        </div>
    </div>

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
    </script>
</x-layouts.app>
