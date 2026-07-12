<x-layouts.app>
    <div class="container-fluid">
        <div class="page-header mb-4">
            <div class="page-title d-flex align-items-center justify-content-between flex-wrap gap-2">
                <div>
                    <h4>Sitios Turísticos</h4>
                    <p class="text-muted mb-0">Administra los sitios turísticos del portal</p>
                </div>
                <a href="{{ route('admin.tourists.create') }}" class="btn btn-primary" wire:navigate>
                    <i class="bx bx-plus me-1"></i>Nuevo Sitio
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
                            <th class="d-none d-lg-table-cell">Resumen</th>
                            <th class="d-none d-sm-table-cell">Imagen</th>
                            <th>Estado</th>
                            <th class="d-none d-md-table-cell">Ubicación</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($touristSites as $item)
                            <tr>
                                <td class="d-none d-md-table-cell">{{ $item->id }}</td>
                                <td class="fw-semibold">{{ \Illuminate\Support\Str::limit($item->titulo, 30) }}</td>
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
                                    @if ($item->publicado)
                                        <span class="badge bg-success">Publicado</span>
                                    @else
                                        <span class="badge bg-secondary">Borrador</span>
                                    @endif
                                </td>
                                <td class="d-none d-md-table-cell">{{ $item->ubicacion }}</td>
                                <td>
                                    <div class="d-flex justify-content-center gap-1">
                                        <a href="{{ route('admin.tourists.edit', $item->id) }}" class="btn btn-sm btn-outline-primary" title="Editar">
                                            <i class="bx bx-edit"></i>
                                        </a>
                                        <button type="button" class="btn btn-sm btn-outline-info" title="Ver"
                                            onclick="verSitio('{{ route('admin.tourists.show', $item->id) }}')">
                                            <i class="bx bx-show"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-outline-danger" title="Eliminar"
                                            onclick="confirmarEliminacion({{ $item->id }})">
                                            <i class="bx bx-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">No hay sitios turísticos registrados</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        function verSitio(url) {
            fetch(url)
                .then(response => response.json())
                .then(data => {
                    Swal.fire({
                        title: `<strong>${data.titulo}</strong>`,
                        html: `
                            <img src="/storage/${data.imagen_destacada}" style="width: 100%; max-width: 450px; height: auto; max-height: 300px; object-fit: cover; margin-bottom: 10px; border-radius: 8px;">
                            <p style="text-align:left;"><strong>Resumen:</strong> ${data.resumen}</p>
                            <p style="text-align:left;"><strong>Ubicación:</strong> ${data.ubicacion}</p>
                            <p style="text-align:left;"><strong>Coordenadas:</strong> ${data.latitud && data.longitud ? data.latitud + ', ' + data.longitud : '-'}</p>
                            <p style="text-align:left;"><strong>Horario:</strong> ${data.horario ?? '-'}</p>
                        `,
                        showCloseButton: true,
                        confirmButtonText: 'Cerrar',
                        width: '600px'
                    });
                })
                .catch(() => Swal.fire('Error', 'No se pudo cargar el sitio turístico', 'error'));
        }

        function confirmarEliminacion(id) {
            Swal.fire({
                title: '¿Eliminar este sitio turístico?',
                text: 'No podrás recuperar esta información.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    eliminarSitio(id);
                }
            });
        }

        function eliminarSitio(id) {
            fetch(`/admin/tourists/${id}`, {
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
