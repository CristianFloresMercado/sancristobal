<x-layouts.app>
    <div class="container-fluid">
        <div class="page-header mb-4">
            <div class="page-title d-flex align-items-center justify-content-between flex-wrap gap-2">
                <div>
                    <h4>Gestión de Pagos</h4>
                    <p class="text-muted mb-0">Administrar pagos de negocios</p>
                </div>
                <a href="{{ route('admin.pagos.create') }}" class="btn btn-primary" wire:navigate>
                    <i class="bx bx-plus me-1"></i>Nuevo Pago
                </a>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="card border-0 shadow-sm mb-3">
            <div class="card-body py-2">
                <form method="GET" class="d-flex flex-wrap gap-2 align-items-center">
                    <select name="estado" class="form-select form-select-sm" style="width: auto;">
                        <option value="">Todos los estados</option>
                        <option value="pendiente" {{ request('estado') === 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                        <option value="aprobado" {{ request('estado') === 'aprobado' ? 'selected' : '' }}>Aprobado</option>
                        <option value="rechazado" {{ request('estado') === 'rechazado' ? 'selected' : '' }}>Rechazado</option>
                    </select>
                    <button type="submit" class="btn btn-sm btn-outline-primary"><i class="bx bx-search"></i></button>
                </form>
            </div>
        </div>

        <div class="card border-0 shadow-sm">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Negocio</th>
                            <th>Tipo Plan</th>
                            <th>Monto</th>
                            <th>Fecha Pago</th>
                            <th>Fecha Fin</th>
                            <th>Estado</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pagos as $pago)
                            <tr>
                                <td class="fw-semibold">{{ $pago->negocio->nombre ?? 'N/A' }}</td>
                                <td>{{ ucfirst($pago->tipo_plan) }}</td>
                                <td>Bs. {{ number_format($pago->monto, 2) }}</td>
                                <td><small class="text-muted">{{ $pago->fecha_pago ? \Carbon\Carbon::parse($pago->fecha_pago)->format('d/m/Y') : '-' }}</small></td>
                                <td><small class="text-muted">{{ $pago->fecha_fin ? \Carbon\Carbon::parse($pago->fecha_fin)->format('d/m/Y') : '-' }}</small></td>
                                <td>
                                    @if($pago->estado === 'pendiente')
                                        <span class="badge bg-warning text-dark">Pendiente</span>
                                    @elseif($pago->estado === 'aprobado')
                                        <span class="badge bg-success">Aprobado</span>
                                    @else
                                        <span class="badge bg-danger">Rechazado</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="d-flex gap-1 justify-content-center">
                                        <a href="{{ route('admin.pagos.edit', $pago) }}" class="btn btn-sm btn-outline-primary" title="Editar">
                                            <i class="bx bx-edit"></i>
                                        </a>
                                        @if($pago->estado === 'pendiente')
                                            <button type="button" class="btn btn-sm btn-outline-success" title="Aprobar"
                                                onclick="confirmarAccion({{ $pago->id }}, 'aprobar')">
                                                <i class="bx bx-check"></i>
                                            </button>
                                            <button type="button" class="btn btn-sm btn-outline-danger" title="Rechazar"
                                                onclick="confirmarAccion({{ $pago->id }}, 'rechazar')">
                                                <i class="bx bx-x"></i>
                                            </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">No se encontraron pagos</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="card-footer bg-transparent border-0">
                {{ $pagos->withQueryString()->links() }}
            </div>
        </div>
    </div>

    <script>
        function confirmarAccion(id, accion) {
            const texto = accion === 'aprobar' ? '¿Aprobar este pago?' : '¿Rechazar este pago?';
            const botonColor = accion === 'aprobar' ? '#28a745' : '#d33';

            Swal.fire({
                title: texto,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: botonColor,
                cancelButtonColor: '#6c757d',
                confirmButtonText: accion === 'aprobar' ? 'Sí, aprobar' : 'Sí, rechazar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    ejecutarAccion(id, accion);
                }
            });
        }

        function ejecutarAccion(id, accion) {
            fetch(`/admin/pagos/${id}/${accion}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                }
            })
            .then(res => {
                if (!res.ok) throw new Error('HTTP ' + res.status);
                return res.json();
            })
            .then(data => {
                Swal.fire('Procesado', data.message, 'success')
                    .then(() => location.reload());
            })
            .catch(() => {
                Swal.fire('Error', 'No se pudo procesar la acción', 'error');
            });
        }
    </script>
</x-layouts.app>
