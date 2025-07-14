<x-layouts.app>
    <div class="mb-8 flex justify-between items-center" >
        <flux:breadcrumbs >
            <flux:breadcrumbs.item href="#">Dashboard</flux:breadcrumbs.item>
            <flux:breadcrumbs.item>Noticias</flux:breadcrumbs.item>
        </flux:breadcrumbs>
        <a href="" class="btn btn-blue">Nuevo</a>

    </div>

    <div class="relative overflow-x-auto">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Tituto
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Resumen
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Autor
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Fuente
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Imagen
                    </th>
                </tr>
            </thead>


            <tbody>
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        Apple MacBook Pro 17"
                    </th>
                    <td class="px-6 py-4">
                        Silver
                    </td>
                    <td class="px-6 py-4">
                        Laptop
                    </td>
                    <td class="px-6 py-4">
                        $2999
                    </td>
                </tr>
                
            </tbody>
        </table>
    </div>


</x-layouts.app>
