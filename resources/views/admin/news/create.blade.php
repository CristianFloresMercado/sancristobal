<x-layouts.app>
    <flux:breadcrumbs class="mb-8">
        <flux:breadcrumbs.item :href="route('dashboard')">Dashboard</flux:breadcrumbs.item>
        <flux:breadcrumbs.item :href="route('admin.news.index')">Noticias</flux:breadcrumbs.item>
        <flux:breadcrumbs.item>Noticias</flux:breadcrumbs.item>
    </flux:breadcrumbs>
    <form action="{{ route('admin.news.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card">
            <div class="relative">
                <img class=" w-full aspect-video object-cover object-center mb-4  "
                    src="https://thumb.ac-illust.com/b1/b170870007dfa419295d949814474ab2_t.jpeg" alt="">
                <div class="absolute top-8 right-8">
                    <label class="bg-white p-3 rounded-lg cursor-pointer">
                        Agrege imagen
                        <input type="file" class="hidden" name="image" accept="image/*" id="">
                    </label>
                </div>
            </div>

            <flux:input label="Titulo" name="titulo" value="{{ old('titulo') }}" placeholder="Agrege el titulo"
                class="mb-4" />
            <flux:input label="Autor" name="autor" placeholder="Agrege el autor" class="mb-4" />
            <flux:input label="Fuente" name="fuente" placeholder="Agrege la fuente" class="mb-4" />
            <flux:textarea label="Resumen" name="resumen" placeholder="El dia 28 de julio del 2025 se presento la pagina web de la comunidad de San Cristobal" class="mb-4" />
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
                            class="text-blue-600 focus:ring-blue-500 border-gray-300" >
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

</x-layouts.app>
