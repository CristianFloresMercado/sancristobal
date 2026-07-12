<x-layouts.app>
    <div class="container-fluid">
        <div class="page-header mb-4">
            <div class="page-title d-flex align-items-center justify-content-between flex-wrap gap-2">
                <div>
                    <h4>Editar Pago</h4>
                    <p class="text-muted mb-0">Editar pago #{{ $pago->id }}</p>
                </div>
                <a href="{{ route('admin.pagos.index') }}" class="btn btn-outline-secondary" wire:navigate>
                    <i class="bx bx-arrow-back me-1"></i>Volver
                </a>
            </div>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <form action="{{ route('admin.pagos.update', $pago) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Negocio *</label>
                            <select name="negocio_id" class="form-select @error('negocio_id') is-invalid @enderror" required>
                                <option value="">Seleccione un negocio</option>
                                @foreach ($negocios as $negocio)
                                    <option value="{{ $negocio->id }}" {{ old('negocio_id', $pago->negocio_id) == $negocio->id ? 'selected' : '' }}>
                                        {{ $negocio->nombre }}
                                    </option>
                                @endforeach
                            </select>
                            @error('negocio_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Tipo de Plan *</label>
                            <div class="d-flex gap-4 mt-2">
                                <div class="form-check">
                                    <input class="form-check-input @error('tipo_plan') is-invalid @enderror" type="radio"
                                        name="tipo_plan" id="tipoMensual" value="mensual"
                                        {{ old('tipo_plan', $pago->tipo_plan) === 'mensual' ? 'checked' : '' }} required>
                                    <label class="form-check-label" for="tipoMensual">Mensual</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input @error('tipo_plan') is-invalid @enderror" type="radio"
                                        name="tipo_plan" id="tipoAnual" value="anual"
                                        {{ old('tipo_plan', $pago->tipo_plan) === 'anual' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="tipoAnual">Anual</label>
                                </div>
                            </div>
                            @error('tipo_plan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Monto (Bs.) *</label>
                            <input type="number" step="0.01" min="0"
                                class="form-control @error('monto') is-invalid @enderror"
                                name="monto" value="{{ old('monto', $pago->monto) }}" required>
                            @error('monto') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Fecha de Pago *</label>
                            <input type="date"
                                class="form-control @error('fecha_pago') is-invalid @enderror"
                                name="fecha_pago" value="{{ old('fecha_pago', $pago->fecha_pago instanceof \Carbon\Carbon ? $pago->fecha_pago->format('Y-m-d') : $pago->fecha_pago) }}" required>
                            @error('fecha_pago') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Estado *</label>
                            <select name="estado" class="form-select @error('estado') is-invalid @enderror" required>
                                <option value="pendiente" {{ old('estado', $pago->estado) === 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                                <option value="aprobado" {{ old('estado', $pago->estado) === 'aprobado' ? 'selected' : '' }}>Aprobado</option>
                                <option value="rechazado" {{ old('estado', $pago->estado) === 'rechazado' ? 'selected' : '' }}>Rechazado</option>
                            </select>
                            @error('estado') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Comprobante de Pago</label>
                            <input type="file"
                                class="form-control @error('comprobante') is-invalid @enderror"
                                name="comprobante" accept="image/*,.pdf">
                            <small class="text-muted">Formatos aceptados: imágenes o PDF</small>
                            @if ($pago->comprobante)
                                <div class="mt-2">
                                    <a href="{{ asset('storage/' . $pago->comprobante) }}" target="_blank" class="text-primary">
                                        <i class="bx bx-file me-1"></i>Ver comprobante actual
                                    </a>
                                </div>
                            @endif
                            @error('comprobante') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-semibold">Observaciones</label>
                            <textarea name="observaciones" rows="3"
                                class="form-control @error('observaciones') is-invalid @enderror">{{ old('observaciones', $pago->observaciones) }}</textarea>
                            @error('observaciones') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="text-end mt-4">
                        <a href="{{ route('admin.pagos.index') }}" class="btn btn-outline-secondary me-2" wire:navigate>Cancelar</a>
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="bx bx-save me-1"></i>Actualizar Pago
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layouts.app>
