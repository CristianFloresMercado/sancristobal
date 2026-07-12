<x-layouts.app>
    <div class="container-fluid">
        <div class="page-header mb-4">
            <div class="page-title d-flex align-items-center justify-content-between flex-wrap gap-2">
                <div>
                    <h4>Backups</h4>
                    <p class="text-muted mb-0">Copia de seguridad de la base de datos</p>
                </div>
                <div class="d-flex gap-2">
                    <form action="{{ route('admin.backups.create') }}" method="POST" id="backupForm">
                        @csrf
                        <button type="submit" class="btn btn-primary" id="backupBtn">
                            <i class="bx bx-download me-1"></i>Crear Backup
                        </button>
                    </form>
                    <button type="button" class="btn btn-success" id="toggleRestoreBtn">
                        <i class="bx bx-upload me-1"></i>Cargar Backup
                    </button>
                </div>
            </div>
        </div>

        @error('backup')
            <div class="alert alert-danger alert-dismissible fade show">
                {{ $message }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @enderror

        @error('backup_file')
            <div class="alert alert-danger alert-dismissible fade show">
                {{ $message }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @enderror

        <div id="restorePanel" class="card border-0 shadow-sm mb-4" style="display:none;">
            <div class="card-body">
                <h6 class="mb-1">Restaurar Backup</h6>
                <p class="text-muted small mb-3">Seleccione un archivo .sql o .zip para restaurar la base de datos.</p>
                <form action="{{ route('admin.backups.restore') }}" method="POST" enctype="multipart/form-data" id="restoreForm">
                    @csrf
                    <div class="row align-items-end g-3">
                        <div class="col-md-6">
                            <label for="backup_file" class="form-label">Archivo de backup</label>
                            <input type="file" class="form-control" id="backup_file" name="backup_file" accept=".sql,.zip" required>
                        </div>
                        <div class="col-md-3">
                            <button type="submit" class="btn btn-success w-100" id="restoreBtn">
                                <i class="bx bx-upload me-1"></i>Restaurar
                            </button>
                        </div>
                        <div class="col-md-3">
                            <button type="button" class="btn btn-outline-secondary w-100" id="cancelRestoreBtn">
                                Cancelar
                            </button>
                        </div>
                    </div>
                    <div id="filePreview" class="mt-2" style="display:none;">
                        <small class="text-info"><i class="bx bx-info-circle me-1"></i><span id="fileInfo"></span></small>
                    </div>
                </form>
            </div>
        </div>

        <div class="card border-0 shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Nombre</th>
                                <th>Tamaño</th>
                                <th>Fecha</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($backups as $backup)
                                <tr>
                                    <td class="fw-semibold">
                                        <i class="bx bx-file text-primary me-1"></i>{{ $backup['name'] }}
                                    </td>
                                    <td>{{ $backup['size'] }}</td>
                                    <td>{{ \Carbon\Carbon::createFromTimestamp($backup['date'])->format('d/m/Y H:i:s') }}</td>
                                    <td>
                                        <div class="d-flex justify-content-center gap-1">
                                            <a href="{{ route('admin.backups.download', $backup['name']) }}" class="btn btn-sm btn-outline-success" title="Descargar">
                                                <i class="bx bx-download"></i>
                                            </a>
                                            <form action="{{ route('admin.backups.destroy', $backup['name']) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Eliminar este backup?')">
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
                                    <td colspan="4" class="text-center text-muted py-4">
                                        <i class="bx bx-folder-open fs-1 d-block mb-2" style="color:#bbdefb;"></i>
                                        No hay backups creados
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('toggleRestoreBtn').addEventListener('click', function() {
            var panel = document.getElementById('restorePanel');
            if (panel.style.display === 'none') {
                panel.style.display = 'block';
                document.getElementById('backup_file').focus();
            } else {
                panel.style.display = 'none';
            }
        });

        document.getElementById('cancelRestoreBtn').addEventListener('click', function() {
            document.getElementById('restorePanel').style.display = 'none';
            document.getElementById('restoreForm').reset();
            document.getElementById('filePreview').style.display = 'none';
        });

        document.getElementById('backupForm').addEventListener('submit', function() {
            var btn = document.getElementById('backupBtn');
            btn.disabled = true;
            btn.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span>Creando backup...';
        });

        document.getElementById('restoreForm').addEventListener('submit', function() {
            var btn = document.getElementById('restoreBtn');
            btn.disabled = true;
            btn.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span>Restaurando...';
        });

        document.getElementById('backup_file').addEventListener('change', function() {
            var preview = document.getElementById('filePreview');
            var info = document.getElementById('fileInfo');
            if (this.files.length > 0) {
                var file = this.files[0];
                var size = file.size < 1024 * 1024
                    ? (file.size / 1024).toFixed(1) + ' KB'
                    : (file.size / (1024 * 1024)).toFixed(1) + ' MB';
                info.textContent = file.name + ' (' + size + ')';
                preview.style.display = 'block';
            } else {
                preview.style.display = 'none';
            }
        });
    </script>
</x-layouts.app>
