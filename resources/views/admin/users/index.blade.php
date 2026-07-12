<x-layouts.app>
    <div class="container-fluid">
        <div class="page-header mb-4">
            <div class="page-title d-flex align-items-center justify-content-between flex-wrap gap-2">
                <div>
                    <h4>Gestión de Usuarios</h4>
                    <p class="text-muted mb-0">Administrar usuarios del sistema</p>
                </div>
                <a href="{{ route('admin.users.create') }}" class="btn btn-primary" wire:navigate>
                    <i class="bx bx-plus me-1"></i>Nuevo Usuario
                </a>
            </div>
        </div>

        <!-- Filtros -->
        <div class="card border-0 shadow-sm mb-3">
            <div class="card-body py-2">
                <form method="GET" class="d-flex flex-wrap gap-2 align-items-center">
                    <div class="flex-grow-1" style="min-width: 200px;">
                        <input type="text" name="buscar" class="form-control form-control-sm" placeholder="Buscar por nombre, email o rol..." value="{{ request('buscar') }}">
                    </div>
                    <select name="role" class="form-select form-select-sm" style="width: auto;">
                        <option value="">Todos los roles</option>
                        <option value="admin" {{ request('role') === 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="periodista" {{ request('role') === 'periodista' ? 'selected' : '' }}>Periodista</option>
                    </select>
                    <button type="submit" class="btn btn-sm btn-outline-primary"><i class="bx bx-search"></i></button>
                </form>
            </div>
        </div>

        <!-- Tabla -->
        <div class="card border-0 shadow-sm">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Usuario</th>
                            <th>Email</th>
                            <th>Rol</th>
                            <th>Creado</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="rounded-circle bg-primary d-flex align-items-center justify-content-center text-white fw-bold" style="width:36px;height:36px;font-size:0.8rem;">
                                            {{ $user->initials() }}
                                        </div>
                                        <span class="fw-semibold">{{ $user->name }}</span>
                                    </div>
                                </td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <span class="badge {{ $user->role === 'admin' ? 'bg-primary' : 'bg-info' }}">
                                        {{ ucfirst($user->role) }}
                                    </span>
                                </td>
                                <td><small class="text-muted">{{ $user->created_at->diffForHumans() }}</small></td>
                                <td class="text-center">
                                    <div class="d-flex gap-1 justify-content-center">
                                        <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-sm btn-outline-primary" wire:navigate title="Editar">
                                            <i class="bx bx-edit"></i>
                                        </a>
                                        @if($user->id !== auth()->id())
                                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Eliminar este usuario?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger" title="Eliminar">
                                                    <i class="bx bx-trash"></i>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">No se encontraron usuarios</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="card-footer bg-transparent border-0">
                {{ $users->withQueryString()->links() }}
            </div>
        </div>
    </div>
</x-layouts.app>
