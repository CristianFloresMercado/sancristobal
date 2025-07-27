<x-layouts.app>
    <div class="mb-8">
        <nav class="text-sm text-gray-500 mb-4">
            <a href="{{ route('dashboard') }}" class="hover:underline">Dashboard</a> /
            <a href="{{ route('admin.stories.index') }}" class="hover:underline">Historias</a> /
            <span class="text-gray-700 font-semibold">Editar historia</span>
        </nav>

        <div class="max-w-3xl mx-auto bg-white p-8 rounded-xl shadow-md">
            <h2 class="text-2xl font-bold text-center text-purple-700 mb-6">Editar Historia</h2>

            <form action="{{ route('admin.stories.update', $story->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Imagen destacada -->
                <div class="flex flex-col items-center gap-2">
                    <img id="preview-image" 
                         src="{{ $story->imagen_destacada ? asset('storage/' . $story->imagen_destacada) : 'https://thumb.ac-illust.com/b1/b170870007dfa419295d949814474ab2_t.jpeg' }}"
                         class="img-fluid rounded border border-secondary shadow-sm"
                         style="width: 450px; height: 350px; object-fit: cover;" alt="Vista previa">
                    <label class="cursor-pointer bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-lg shadow">
                        Cambiar Imagen
                        <input type="file" name="imagen_destacada" id="input-image" accept="image/*" class="hidden">
                    </label>
                    <a href="https://www.iloveimg.com/es/redimensionar-imagen" target="_blank"
                       class="text-sm text-purple-600 hover:underline">Convertir / Redimensionar imagen</a>
                    @error('imagen_destacada')
                        <p class="text-red-600 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Título -->
                <div>
                    <label class="block text-gray-700 font-medium mb-1">Título</label>
                    <input type="text" name="titulo" value="{{ old('titulo', $story->titulo) }}" placeholder="Ej. Batalla del puente"
                           class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500">
                </div>

                <!-- Año ocurrido -->
                <div>
                    <label class="block text-gray-700 font-medium mb-1">Año ocurrido</label>
                    <input type="number" name="año_ocurrido" value="{{ old('año_ocurrido', $story->año_ocurrido) }}" placeholder="Ej. 1825"
                           class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500">
                </div>

                <!-- Personajes -->
                <div>
                    <label class="block text-gray-700 font-medium mb-1">Personajes</label>
                    <input type="text" name="personajes" value="{{ old('personajes', $story->personajes) }}" placeholder="Ej. Juana Azurduy, Simón Bolívar"
                           class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500">
                </div>

                <!-- Resumen -->
                <div>
                    <label class="block text-gray-700 font-medium mb-1">Resumen</label>
                    <textarea name="resumen" rows="4" placeholder="Escribe un resumen breve de la historia..."
                              class="w-full border border-gray-300 rounded-lg px-4 py-2 resize-none focus:outline-none focus:ring-2 focus:ring-purple-500">{{ old('resumen', $story->resumen) }}</textarea>
                    @error('resumen')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Publicado -->
                <div>
                    <label class="block text-gray-700 font-medium mb-2">¿Publicado?</label>
                    <div class="flex items-center gap-8">
                        <label class="flex items-center gap-2">
                            <input type="radio" name="publicado" value="1" class="text-purple-600 focus:ring-purple-500 border-gray-300"
                                   {{ old('publicado', $story->publicado) == 1 ? 'checked' : '' }}>
                            <span class="text-gray-700">Sí</span>
                        </label>
                        <label class="flex items-center gap-2">
                            <input type="radio" name="publicado" value="0" class="text-red-600 focus:ring-red-500 border-gray-300"
                                   {{ old('publicado', $story->publicado) == 0 ? 'checked' : '' }}>
                            <span class="text-gray-700">No</span>
                        </label>
                    </div>
                </div>

                <!-- Botón Enviar -->
                <div class="text-end">
                    <button type="submit"
                            class="bg-green-600 hover:bg-green-700 text-white font-semibold px-6 py-2 rounded-lg shadow transition duration-300">
                        Actualizar Historia
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
