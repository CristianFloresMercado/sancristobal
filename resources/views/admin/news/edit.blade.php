<x-layouts.app>
    <div class="mb-8">
        <nav class="text-sm text-gray-500 mb-4">
            <a href="{{ route('dashboard') }}" class="hover:underline">Dashboard</a> /
            <a href="{{ route('admin.news.index') }}" class="hover:underline">Noticias</a> /
            <span class="text-gray-700 font-semibold">Editar noticia</span>
        </nav>

        <div class="max-w-3xl mx-auto bg-white p-8 rounded-xl shadow-md">
            <h2 class="text-2xl font-bold text-center text-blue-700 mb-6">Editar Noticia</h2>

            <form action="{{ route('admin.news.update', $news->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Vista previa de imagen -->
                <div class="flex flex-col items-center gap-2">
                    <img id="preview-image" 
                        src="{{ asset('storage/' . $news->imagen_destacada) }}" 
                        class="img-fluid rounded border border-secondary shadow-sm"
                        style="width: 450px; height: 350px; object-fit: cover;" alt="Vista previa">

                    <label class="cursor-pointer bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow">
                        Cambiar Imagen
                        <input type="file" name="imagen" id="input-image" accept="image/*" class="hidden">
                    </label>
                    <a href="https://www.iloveimg.com/es/redimensionar-imagen" target="_blank"
                       class="text-sm text-blue-600 hover:underline">Convertir / Redimensionar imagen</a>
                    @error('imagen')
                        <p class="text-red-600 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Título -->
                <div>
                    <label class="block text-gray-700 font-medium mb-1">Título</label>
                    <input type="text" name="titulo" value="{{ old('titulo', $news->titulo) }}" placeholder="Ej. Lanzamiento de sitio web"
                           class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <!-- Autor -->
                <div>
                    <label class="block text-gray-700 font-medium mb-1">Autor</label>
                    <input type="text" name="autor" value="{{ old('autor', $news->autor) }}" placeholder="Ej. Juan Pérez"
                           class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <!-- Fuente -->
                <div>
                    <label class="block text-gray-700 font-medium mb-1">Fuente</label>
                    <input type="text" name="fuente" value="{{ old('fuente', $news->fuente) }}" placeholder="Ej. www.sitio.com"
                           class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <!-- Resumen -->
                <div>
                    <label class="block text-gray-700 font-medium mb-1">Resumen</label>
                    <textarea name="resumen" rows="4" placeholder="Escribe un resumen breve..."
                              class="w-full border border-gray-300 rounded-lg px-4 py-2 resize-none focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('resumen', $news->resumen) }}</textarea>
                    @error('resumen')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Publicado -->
                <div>
                    <label class="block text-gray-700 font-medium mb-2">¿Publicado?</label>
                    <div class="flex items-center gap-8">
                        <label class="flex items-center gap-2">
                            <input type="radio" name="publicado" value="1" 
                                   class="text-blue-600 focus:ring-blue-500 border-gray-300"
                                   {{ old('publicado', $news->publicado) == 1 ? 'checked' : '' }}>
                            <span class="text-gray-700">Sí</span>
                        </label>
                        <label class="flex items-center gap-2">
                            <input type="radio" name="publicado" value="0" 
                                   class="text-red-600 focus:ring-red-500 border-gray-300"
                                   {{ old('publicado', $news->publicado) == 0 ? 'checked' : '' }}>
                            <span class="text-gray-700">No</span>
                        </label>
                    </div>
                </div>

                <!-- Botón Enviar -->
                <div class="text-end">
                    <button type="submit"
                            class="bg-green-600 hover:bg-green-700 text-white font-semibold px-6 py-2 rounded-lg shadow transition duration-300">
                        Actualizar Noticia
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Vista previa de imagen para edición
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
