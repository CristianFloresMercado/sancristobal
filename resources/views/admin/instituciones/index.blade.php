<x-layouts.app>
    <div class="container-fluid">
        <div class="page-header mb-4">
            <div class="page-title d-flex align-items-center justify-content-between flex-wrap gap-2">
                <div>
                    <h4>Instituciones</h4>
                    <p class="text-muted mb-0">Administra las instituciones del portal</p>
                </div>
                <a href="{{ route('admin.instituciones.create') }}" class="btn btn-primary" wire:navigate>
                    <i class="bx bx-plus me-1"></i>Nueva Institución
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
            <div class="card-body border-bottom">
                <form method="GET" action="{{ route('admin.instituciones.index') }}" class="row g-2 align-items-end">
                    <div class="col-md-4">
                        <input type="text" name="buscar" class="form-control" placeholder="Buscar institución..." value="{{ request('buscar') }}">
                    </div>
                    <div class="col-md-3">
                        <select name="tipo" class="form-select">
                            <option value="">Todos los tipos</option>
                            @foreach(['Hospital', 'Policía', 'Bomberos', 'Mercado', 'Municipalidad', 'Escuela', 'Colegio', 'Banco', 'Otro'] as $tipo)
                                <option value="{{ $tipo }}" {{ request('tipo') == $tipo ? 'selected' : '' }}>{{ $tipo }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-outline-primary w-100">
                            <i class="bx bx-search me-1"></i>Buscar
                        </button>
                    </div>
                </form>
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="d-none d-md-table-cell">ID</th>
                            <th>Nombre</th>
                            <th class="d-none d-sm-table-cell">Tipo</th>
                            <th class="d-none d-md-table-cell">Teléfono</th>
                            <th class="d-none d-lg-table-cell">Horario</th>
                            <th>Estado</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($instituciones as $institucion)
                            <tr>
                                <td class="d-none d-md-table-cell">{{ $institucion->id }}</td>
                                <td class="fw-semibold">{{ \Illuminate\Support\Str::limit($institucion->nombre, 30) }}</td>
                                <td class="d-none d-sm-table-cell">
                                    <span class="badge bg-info text-dark">{{ $institucion->tipo }}</span>
                                </td>
                                <td class="d-none d-md-table-cell">{{ $institucion->telefono ?? '—' }}</td>
                                <td class="d-none d-lg-table-cell">{{ \Illuminate\Support\Str::limit($institucion->horario, 30) ?? '—' }}</td>
                                <td>
                                    @if($institucion->publicado)
                                        <span class="badge bg-success">Publicado</span>
                                    @else
                                        <span class="badge bg-secondary">Borrador</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex justify-content-center gap-1">
                                        <a href="{{ route('admin.instituciones.edit', $institucion->id) }}" class="btn btn-sm btn-outline-primary" title="Editar">
                                            <i class="bx bx-edit"></i>
                                        </a>
                                        <button type="button" class="btn btn-sm btn-outline-danger" title="Eliminar"
                                            onclick="confirmarEliminacion({{ $institucion->id }})">
                                            <i class="bx bx-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">No hay instituciones registradas</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($instituciones->hasPages())
                <div class="card-body border-top">
                    {{ $instituciones->links() }}
                </div>
            @endif
        </div>
    </div>

    <script>
        function confirmarEliminacion(id) {
            Swal.fire({
                title: '¿Eliminar institución?',
                text: 'Esta acción no se puede deshacer.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    eliminarInstitucion(id);
                }
            });
        }

        function eliminarInstitucion(id) {
            fetch(`/admin/instituciones/${id}`, {
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
