<x-layouts.app>
    <div class="mb-8 flex justify-between items-center" >
        <flux:breadcrumbs >
           <flux:breadcrumbs.item :href="route('dashboard')">Dashboard</flux:breadcrumbs.item>  
            <flux:breadcrumbs.item>Noticias</flux:breadcrumbs.item>
        </flux:breadcrumbs>
        <a href="{{route('admin.news.create')}}" class="btn btn-blue rounded-lg">Nuevo</a>

    </div>

    <div class="relative overflow-x-auto">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        ID
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Tituto
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Resumen
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Imagen
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Estado
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Opciones
                    </th>
                </tr>
            </thead>
            <tbody>  
                @foreach ($news as $item)
                    <tr class="bg-white dark:bg-gray-800">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{$item->id}}
                        </th>
                        <td class="px-6 py-4">
                            {{$item->titulo}}
                        </td>
                        <td class="px-6 py-4">
                            {{$item->resumen}}
                        </td>
                        <td class="px-6 py-4">
                            <img src="{{ Storage::url($item->imagen_destacada) }}" alt="Imagen destacada">
                        </td>
                        <td class="px-6 py-4">
                            @if ($item->publicado == 1)
                                <i class="fadeIn animated bx bx-message-square-check"></i>
                            @else
                                <i class="fadeIn animated bx bx-message-square-x"></i>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex space-x-2">
                                <i class="btn btn-primary fadeIn animated bx bx-message-square-edit"></i>
                                <i class="btn btn-warning lni lni-eye"></i>
                                <i class="btn btn-danger lni lni-eraser"></i>
                            </div>
                        </td>

                       

                    </tr>
                @endforeach     
                
            </tbody>
        </table>
    </div>


</x-layouts.app>
