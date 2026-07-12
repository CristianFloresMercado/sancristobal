<x-layouts.app>
    <div class="container-fluid">
        <div class="page-header mb-4">
            <div class="page-title d-flex align-items-center justify-content-between flex-wrap gap-2">
                <div>
                    <h4>{{ auth()->user()->isAdmin() ? 'Gestión de Noticias' : 'Mis Noticias' }}</h4>
                    <p class="text-muted mb-0">{{ auth()->user()->isAdmin() ? 'Administra todas las noticias del portal' : 'Gestiona tus noticias publicadas' }}</p>
                </div>
                <a href="{{ route('admin.news.create') }}" class="btn btn-primary" wire:navigate>
                    <i class="bx bx-plus me-1"></i>Nueva Noticia
                </a>
            </div>
        </div>

        <div class="card border-0 shadow-sm">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="d-none d-md-table-cell">ID</th>
                            <th>Título</th>
                            @if(auth()->user()->isAdmin())
                                <th class="d-none d-lg-table-cell">Autor</th>
                            @endif
                            <th class="d-none d-lg-table-cell">Resumen</th>
                            <th class="d-none d-sm-table-cell">Imagen</th>
                            <th>Estado</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($news as $item)
                            <tr>
                                <td class="d-none d-md-table-cell">{{ $item->id }}</td>
                                <td class="fw-semibold">{{ \Illuminate\Support\Str::limit($item->titulo, 30) }}</td>
                                @if(auth()->user()->isAdmin())
                                    <td class="d-none d-lg-table-cell">{{ $item->user->name ?? 'N/A' }}</td>
                                @endif
                                <td class="d-none d-lg-table-cell text-truncate" style="max-width: 250px;" title="{{ $item->resumen }}">
                                    {{ \Illuminate\Support\Str::limit($item->resumen, 50) }}
                                </td>
                                <td class="d-none d-sm-table-cell">
                                    @if($item->imagen_destacada)
                                        <img src="{{ asset('storage/' . $item->imagen_destacada) }}" alt=""
                                            class="rounded" style="width: 50px; height: 50px; object-fit: cover;">
                                    @else
                                        <div class="rounded bg-light d-flex align-items-center justify-content-center" style="width:50px;height:50px;">
                                            <i class="bx bx-image text-muted"></i>
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    @if ($item->publicado == 1)
                                        <span class="badge bg-success">Publicado</span>
                                    @else
                                        <span class="badge bg-secondary">Borrador</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex justify-content-center gap-1">
                                        <a href="{{ auth()->user()->isPeriodista() ? route('admin.mynews.edit', $item->id) : route('admin.news.edit', $item->id) }}" class="btn btn-sm btn-outline-primary" title="Editar">
                                            <i class="bx bx-edit"></i>
                                        </a>
                                        <button type="button" class="btn btn-sm btn-outline-info" title="Ver"
                                            onclick="verNoticia('{{ route('admin.news.show', $item->id) }}')">
                                            <i class="bx bx-show"></i>
                                        </button>
                                        <form action="{{ auth()->user()->isPeriodista() ? route('admin.mynews.destroy', $item->id) : route('admin.news.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Eliminar esta noticia?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" title="Eliminar">
                                                <i class="bx bx-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="{{ auth()->user()->isAdmin() ? 7 : 6 }}" class="text-center text-muted py-4">No hay noticias registradas</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        function verNoticia(url) {
            fetch(url)
                .then(response => response.json())
                .then(data => {
                    Swal.fire({
                        title: `<strong>${data.titulo}</strong>`,
                        html: `
                            <img src="/storage/${data.imagen_destacada}" style="width: 100%; max-width: 450px; height: auto; max-height: 300px; object-fit: cover; margin-bottom: 10px; border-radius: 8px;">
                            <p style="text-align:left;"><strong>Resumen:</strong> ${data.resumen}</p>
                            <p style="text-align:left;"><strong>Autor:</strong> ${data.autor ?? 'No registrado'}</p>
                            <p style="text-align:left;"><strong>Fuente:</strong> ${data.fuente ?? 'No registrada'}</p>
                        `,
                        showCloseButton: true,
                        confirmButtonText: 'Cerrar',
                        width: '600px'
                    });
                })
                .catch(() => Swal.fire('Error', 'No se pudo cargar la noticia', 'error'));
        }
    </script>
</x-layouts.app>
