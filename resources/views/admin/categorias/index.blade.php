<x-layouts.app>
    <div class="container-fluid">
        <div class="page-header mb-4">
            <div class="page-title d-flex align-items-center justify-content-between flex-wrap gap-2">
                <div>
                    <h4>Categorías</h4>
                    <p class="text-muted mb-0">Administra las categorías del portal</p>
                </div>
                <a href="{{ route('admin.categorias.create') }}" class="btn btn-primary" wire:navigate>
                    <i class="bx bx-plus me-1"></i>Nueva Categoría
                </a>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="card border-0 shadow-sm">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="d-none d-md-table-cell">ID</th>
                            <th>Nombre</th>
                            <th class="d-none d-sm-table-cell">Descripción</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($categorias as $categoria)
                            <tr>
                                <td class="d-none d-md-table-cell">{{ $categoria->id }}</td>
                                <td class="fw-semibold">{{ $categoria->nombre }}</td>
                                <td class="d-none d-sm-table-cell text-truncate" style="max-width: 300px;" title="{{ $categoria->descripcion }}">
                                    {{ \Illuminate\Support\Str::limit($categoria->descripcion, 50) }}
                                </td>
                                <td>
                                    <div class="d-flex justify-content-center gap-1">
                                        <a href="{{ route('admin.categorias.edit', $categoria->id) }}" class="btn btn-sm btn-outline-primary" title="Editar">
                                            <i class="bx bx-edit"></i>
                                        </a>
                                        <button type="button" class="btn btn-sm btn-outline-danger" title="Eliminar"
                                            onclick="confirmarEliminacion({{ $categoria->id }})">
                                            <i class="bx bx-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted py-4">No hay categorías registradas</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        function confirmarEliminacion(id) {
            Swal.fire({
                title: '¿Eliminar categoría?',
                text: 'Esta acción no se puede deshacer.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    eliminarCategoria(id);
                }
            });
        }

        function eliminarCategoria(id) {
            fetch(`/admin/categorias/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    }
                })
                .then(res => res.json())
                .then(data => {
                    Swal.fire('Eliminado', data.message, 'success')
                        .then(() => location.reload());
                })
                .catch(() => {
                    Swal.fire('Error', 'No se pudo eliminar', 'error');
                });
        }
    </script>
</x-layouts.app>
