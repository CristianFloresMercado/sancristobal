<x-layouts.app>
    <div class="mb-8 flex justify-between items-center">
        <flux:breadcrumbs>
            <flux:breadcrumbs.item :href="route('dashboard')">Dashboard</flux:breadcrumbs.item>
            <flux:breadcrumbs.item>Sitios turísticos</flux:breadcrumbs.item>
        </flux:breadcrumbs>
        <a href="{{ route('admin.tourists.create') }}" class="btn btn-primary rounded-lg">Nuevo sitio</a>
    </div>

    <div class="table-responsive">
        <table class="table table-hover table-bordered align-middle text-center">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Resumen</th>
                    <th>Imagen</th>
                    <th>Estado</th>
                    <th>Ubicación</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($touristSites as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td class="fw-semibold">{{ $item->titulo }}</td>

                        <td class="text-truncate" style="max-width: 250px;" title="{{ $item->resumen }}">
                            {{ \Illuminate\Support\Str::limit($item->resumen, 50) }}
                        </td>

                        <td>
                            @if ($item->imagen_destacada)
                                <img src="{{ Storage::url($item->imagen_destacada) }}" alt="Imagen"
                                     class="rounded border border-2 border-secondary"
                                     style="width: 60px; height: 60px; object-fit: cover;">
                            @else
                                <span class="text-muted">Sin imagen</span>
                            @endif
                        </td>

                        <td>
                            @if ($item->publicado)
                                <span class="badge bg-success"><i class="bx bx-check-circle me-1"></i>Publicado</span>
                            @else
                                <span class="badge bg-danger"><i class="bx bx-x-circle me-1"></i>No publicado</span>
                            @endif
                        </td>

                        <td>{{ $item->ubicacion }}</td>

                        <td>
                            <div class="d-flex justify-content-center gap-2">
                                <a href="{{ route('admin.tourists.edit', $item->id) }}" class="btn btn-sm btn-primary">
                                    <i class="bx bx-edit-alt"></i>
                                </a>

                                <button type="button" class="btn btn-sm btn-info"
                                        onclick="verSitio('{{ route('admin.tourists.show', $item->id) }}')">
                                    <i class="bx bx-show"></i>
                                </button>

                                <button type="button" class="btn btn-sm btn-danger"
                                        onclick="confirmarEliminacion({{ $item->id }})">
                                    <i class="bx bx-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script>
        function verSitio(url) {
            fetch(url)
                .then(response => response.json())
                .then(data => {
                    Swal.fire({
                        title: `<strong>${data.titulo}</strong>`,
                        html: `
                            <img src="/storage/${data.imagen_destacada}" style="width: 450px; height: 350px; object-fit: cover; margin-bottom: 10px;">
                            <p><strong>Resumen:</strong> ${data.resumen}</p>
                            <p><strong>Publicado:</strong> ${data.publicado ? 'Sí' : 'No'}</p>
                            <p><strong>Ubicación:</strong> ${data.ubicacion}</p>
                            <p><strong>Coordenadas:</strong> ${data.coordenadas ?? '-'}</p>
                            <p><strong>Horario:</strong> ${data.horario ?? '-'}</p>
                        `,
                        showCloseButton: true,
                        confirmButtonText: 'Cerrar'
                    });
                })
                .catch(error => {
                    Swal.fire('Error', 'No se pudo cargar el sitio turístico', 'error');
                });
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
            .catch(err => {
                Swal.fire('Error', 'No se pudo eliminar', 'error');
            });
        }
    </script>

</x-layouts.app>
