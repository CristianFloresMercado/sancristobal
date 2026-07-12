@php
    $isAdmin = auth()->user()->isAdmin();
    $isPeriodista = auth()->user()->isPeriodista();
    $groups = [];

    if ($isAdmin) {
        $groups['Plataforma'] = [
            ['name' => 'Dashboard', 'icon' => 'home', 'url' => route('dashboard'), 'current' => request()->routeIs('dashboard')],
            ['name' => 'Usuarios', 'icon' => 'group', 'url' => route('admin.users.index'), 'current' => request()->routeIs('admin.users.*')],
            ['name' => 'Negocios', 'icon' => 'store', 'url' => route('admin.negocios.index'), 'current' => request()->routeIs('admin.negocios.*')],
            ['name' => 'Noticias', 'icon' => 'news', 'url' => route('admin.news.index'), 'current' => request()->routeIs('admin.news.*')],
            ['name' => 'Turismo', 'icon' => 'map', 'url' => route('admin.tourists.index'), 'current' => request()->routeIs('admin.tourists.*')],
['name' => 'Profesionales', 'icon' => 'briefcase', 'url' => route('admin.profesionales.index'), 'current' => request()->routeIs('admin.profesionales.*')],
            ['name' => 'Instituciones', 'icon' => 'buildings', 'url' => route('admin.instituciones.index'), 'current' => request()->routeIs('admin.instituciones.*')],
        ];
        $groups['Configuración'] = [
            ['name' => 'Categorías', 'icon' => 'category', 'url' => route('admin.categorias.index'), 'current' => request()->routeIs('admin.categorias.*')],
            ['name' => 'Subcategorías', 'icon' => 'subdirectory-right', 'url' => route('admin.subcategorias.index'), 'current' => request()->routeIs('admin.subcategorias.*')],
            ['name' => 'Comunidad', 'icon' => 'buildings', 'url' => route('comunidad'), 'current' => request()->routeIs('comunidad')],
            ['name' => 'Pagos', 'icon' => 'dollar', 'url' => route('admin.pagos.index'), 'current' => request()->routeIs('admin.pagos.*')],
            ['name' => 'Actividad', 'icon' => 'file', 'url' => route('admin.activity-logs.index'), 'current' => request()->routeIs('admin.activity-logs.*')],
            ['name' => 'Backups', 'icon' => 'download', 'url' => route('admin.backups.index'), 'current' => request()->routeIs('admin.backups.*')],
        ];
    }

    if ($isPeriodista) {
        $groups['Plataforma'] = [
            ['name' => 'Dashboard', 'icon' => 'home', 'url' => route('admin.periodista.dashboard'), 'current' => request()->routeIs('admin.periodista.dashboard')],
            ['name' => 'Mis Noticias', 'icon' => 'news', 'url' => route('admin.mynews.index'), 'current' => request()->routeIs('admin.mynews.*')],
        ];
    }
@endphp
<x-layouts.app.sidebar :groups="$groups" :title="$title ?? null">
    <div class="page-wrapper">
        <div class="page-content">
            {{ $slot }}
        </div>
    </div>
</x-layouts.app.sidebar>
