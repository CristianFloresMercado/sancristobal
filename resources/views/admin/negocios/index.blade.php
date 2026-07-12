<x-layouts.app>
    <div class="container-fluid">
        <div class="page-header mb-4">
            <div class="page-title d-flex align-items-center justify-content-between flex-wrap gap-2">
                <div>
                    <h4>Negocios</h4>
                    <p class="text-muted mb-0">Administra los negocios del portal</p>
                </div>
                <a href="{{ route('admin.negocios.create') }}" class="btn btn-primary" wire:navigate>
                    <i class="bx bx-plus me-1"></i>Nuevo Negocio
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
                            <th class="d-none d-sm-table-cell">Logo</th>
                            <th>Nombre</th>
                            <th class="d-none d-lg-table-cell">Categoría</th>
                            <th class="d-none d-lg-table-cell">Subcategoría</th>
                            <th class="d-none d-md-table-cell">Plan</th>
                            <th>Estado</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($negocios as $negocio)
                            <tr>
                                <td class="d-none d-md-table-cell">{{ $negocio->id }}</td>
                                <td class="d-none d-sm-table-cell">
                                    @if($negocio->logo)
                                        <img src="{{ asset('storage/' . $negocio->logo) }}" alt=""
                                            class="rounded" style="width: 50px; height: 50px; object-fit: cover;">
                                    @else
                                        <div class="rounded bg-light d-flex align-items-center justify-content-center" style="width:50px;height:50px;">
                                            <i class="bx bx-image text-muted"></i>
                                        </div>
                                    @endif
                                </td>
                                <td class="fw-semibold">{{ \Illuminate\Support\Str::limit($negocio->nombre, 30) }}</td>
                                <td class="d-none d-lg-table-cell">{{ $negocio->categoria->nombre ?? 'Sin categoría' }}</td>
                                <td class="d-none d-lg-table-cell">{{ $negocio->subcategoria->nombre ?? 'Sin subcategoría' }}</td>
                                <td class="d-none d-md-table-cell">
                                    @if ($negocio->plan == 'mensual')
                                        <span class="badge bg-primary">Mensual</span>
                                    @elseif ($negocio->plan == 'anual')
                                        <span class="badge bg-success">Anual</span>
                                    @else
                                        <span class="badge bg-secondary">Sin plan</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($negocio->publicado)
                                        <span class="badge bg-success">Publicado</span>
                                    @else
                                        <span class="badge bg-secondary">Borrador</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex justify-content-center gap-1">
                                        <a href="{{ route('admin.negocios.edit', $negocio->id) }}" class="btn btn-sm btn-outline-primary" title="Editar">
                                            <i class="bx bx-edit"></i>
                                        </a>
                                        <button type="button" class="btn btn-sm btn-outline-info" title="Ver"
                                            onclick="verNegocio('{{ route('admin.negocios.show', $negocio->id) }}')">
                                            <i class="bx bx-show"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-outline-danger" title="Eliminar"
                                            onclick="confirmarEliminacion({{ $negocio->id }})">
                                            <i class="bx bx-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted py-4">No hay negocios registrados</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        function verNegocio(url) {
            fetch(url)
                .then(response => response.json())
                .then(data => {
                    Swal.fire({
                        title: `<strong>${data.nombre}</strong>`,
                        html: `
                            ${data.foto_principal ? `<img src="/storage/${data.foto_principal}" style="width: 100%; max-width: 600px; max-height: 300px; object-fit: cover; margin-bottom: 15px; border-radius: 10px;">` : ''}
                            <p style="text-align:left;"><strong>Categoría:</strong> ${data.categoria?.nombre ?? 'Sin categoría'}</p>
                            <p style="text-align:left;"><strong>Subcategoría:</strong> ${data.subcategoria?.nombre ?? 'Sin subcategoría'}</p>
                            <p style="text-align:left;"><strong>Dirección:</strong> ${data.direccion ?? 'No registrada'}</p>
                            <p style="text-align:left;"><strong>Teléfono:</strong> ${data.telefono ?? 'No registrado'}</p>
                            <p style="text-align:left;"><strong>WhatsApp:</strong> ${data.whatsapp ?? 'No registrado'}</p>
                            <p style="text-align:left;"><strong>Descripción:</strong><br>${data.descripcion ?? 'Sin descripción'}</p>
                        `,
                        width: 700,
                        showCloseButton: true,
                        confirmButtonText: 'Cerrar'
                    });
                })
                .catch(() => Swal.fire('Error', 'No se pudo cargar el negocio', 'error'));
        }

        function confirmarEliminacion(id) {
            Swal.fire({
                title: '¿Eliminar negocio?',
                text: 'Esta acción no se puede deshacer.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    eliminarNegocio(id);
                }
            });
        }

        function eliminarNegocio(id) {
            fetch(`/admin/negocios/${id}`, {
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
