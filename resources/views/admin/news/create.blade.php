<x-layouts.app>
    <flux:breadcrumbs class="mb-8">
        <flux:breadcrumbs.item :href="route('dashboard')">Dashboard</flux:breadcrumbs.item>
        <flux:breadcrumbs.item :href="route('admin.news.index')">Noticias</flux:breadcrumbs.item>
        <flux:breadcrumbs.item>Noticias</flux:breadcrumbs.item>
    </flux:breadcrumbs>
   <form action="{{ route('admin.news.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="card">
        <div class="relative flex justify-center">
            <!-- Vista previa de imagen SIN RECORTE -->
            <img id="preview-image"
                class="mb-4 rounded border max-w-full max-h-[400px]"
                src="https://thumb.ac-illust.com/b1/b170870007dfa419295d949814474ab2_t.jpeg"
                alt="Vista previa de imagen" style="object-fit: cover; width: 100%; height: 100%;">

            <!-- Botón de cargar imagen -->
            <div class="absolute top-4 right-4">
                <label class="bg-white p-3 rounded-lg cursor-pointer shadow">
                    Agregar imagen
                    <input type="file" class="hidden" name="image" accept="image/*" id="input-image">
                </label>
            </div>
        </div>

        <flux:input label="Titulo" name="titulo" value="{{ old('titulo') }}" placeholder="Agregue el título"
            class="mb-4" />
        <flux:input label="Autor" name="autor" value="{{ old('autor') }}" placeholder="Agregue el autor" class="mb-4" />
        <flux:input label="Fuente" name="fuente" value="{{ old('fuente') }}" placeholder="Agregue la fuente" class="mb-4" />
        <flux:textarea label="Resumen" name="resumen"
            placeholder="El día 28 de julio del 2025 se presentó la página web de la comunidad de San Cristóbal"
            class="mb-4" />
        @error('resumen')
            <div class="text-red-600 text-sm mt-1">
                {{ $message }}
            </div>
        @enderror

        <div class="mb-4">
            <flux:label>¿Publicado?</flux:label>
            <div class="flex gap-6">
                <label class="inline-flex items-center">
                    <input type="radio" name="publicado" value="1"
                        class="text-blue-600 focus:ring-blue-500 border-gray-300">
                    <span class="ml-2 text-gray-700">Sí</span>
                </label>
                <label class="inline-flex items-center">
                    <input type="radio" name="publicado" value="0"
                        class="text-red-600 focus:ring-red-500 border-gray-300" checked>
                    <span class="ml-2 text-gray-700">No</span>
                </label>
            </div>
        </div>

        <div class="flex justify-end">
            <flux:button variant="primary" type="submit" color="red">Enviar</flux:button>
        </div>
    </div>
</form>

<!-- JavaScript para vista previa -->
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



