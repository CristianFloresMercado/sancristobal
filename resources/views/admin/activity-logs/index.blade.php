<x-layouts.app>
    <div class="container-fluid">
        <div class="page-header mb-4">
            <div class="page-title">
                <h4>Registro de Actividad</h4>
                <p class="text-muted mb-0">Historial de acciones en noticias</p>
            </div>
        </div>

        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body">
                <form method="GET" action="{{ route('admin.activity-logs.index') }}" class="row g-2 align-items-end">
                    <div class="col-md-4">
                        <label class="form-label fw-semibold small">Usuario</label>
                        <select name="user_id" class="form-select">
                            <option value="">Todos</option>
                            @foreach(\App\Models\User::where('role', 'periodista')->orWhere('role', 'admin')->get() as $u)
                                <option value="{{ $u->id }}" {{ request('user_id') == $u->id ? 'selected' : '' }}>{{ $u->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-semibold small">Acción</label>
                        <select name="accion" class="form-select">
                            <option value="">Todas</option>
                            <option value="crear" {{ request('accion') == 'crear' ? 'selected' : '' }}>Crear</option>
                            <option value="editar" {{ request('accion') == 'editar' ? 'selected' : '' }}>Editar</option>
                            <option value="eliminar" {{ request('accion') == 'eliminar' ? 'selected' : '' }}>Eliminar</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary w-100"><i class="bx bx-search me-1"></i>Filtrar</button>
                    </div>
                    <div class="col-md-2">
                        <a href="{{ route('admin.activity-logs.index') }}" class="btn btn-outline-secondary w-100">Limpiar</a>
                    </div>
                </form>
            </div>
        </div>

        <div class="card border-0 shadow-sm">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Fecha</th>
                            <th>Usuario</th>
                            <th>Acción</th>
                            <th>Detalle</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($logs as $log)
                            <tr>
                                <td class="text-nowrap">{{ $log->created_at->format('d/m/Y H:i') }}</td>
                                <td class="fw-semibold">{{ $log->user->name ?? 'N/A' }}</td>
                                <td>
                                    @if($log->accion === 'crear')
                                        <span class="badge bg-success">Crear</span>
                                    @elseif($log->accion === 'editar')
                                        <span class="badge bg-warning text-dark">Editar</span>
                                    @elseif($log->accion === 'eliminar')
                                        <span class="badge bg-danger">Eliminar</span>
                                    @else
                                        <span class="badge bg-secondary">{{ $log->accion }}</span>
                                    @endif
                                </td>
                                <td>{{ $log->detalle }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted py-4">Sin registros de actividad</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="card-footer bg-transparent">
                {{ $logs->links() }}
            </div>
        </div>
    </div>
</x-layouts.app>
