<?php
use App\Http\Controllers\Admin\CategoriaController;
use App\Http\Controllers\Admin\InstitucionController;
use App\Http\Controllers\Admin\NegocioController;
use App\Http\Controllers\Admin\NewController;
use App\Http\Controllers\Admin\PagoController;
use App\Http\Controllers\Admin\ProfesionalController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SubcategoriaController;
use App\Http\Controllers\Admin\TouristController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware(['role:admin'])->group(function () {
    Route::resource('news', NewController::class);
    Route::resource('users', UserController::class)->except(['show']);
    Route::resource('categorias', CategoriaController::class);
    Route::resource('subcategorias', SubcategoriaController::class);
    Route::resource('negocios', NegocioController::class);
    Route::resource('tourists', TouristController::class);
    Route::resource('instituciones', InstitucionController::class)->except(['show']);
    Route::get('activity-logs', [\App\Http\Controllers\Admin\ActivityLogController::class, 'index'])->name('activity-logs.index');
    Route::get('backups', [\App\Http\Controllers\Admin\BackupController::class, 'index'])->name('backups.index');
    Route::post('backups/create', [\App\Http\Controllers\Admin\BackupController::class, 'create'])->name('backups.create');
    Route::post('backups/restore', [\App\Http\Controllers\Admin\BackupController::class, 'restore'])->name('backups.restore');
    Route::get('backups/{filename}/download', [\App\Http\Controllers\Admin\BackupController::class, 'download'])->name('backups.download');
    Route::delete('backups/{filename}', [\App\Http\Controllers\Admin\BackupController::class, 'destroy'])->name('backups.destroy');
    Route::delete('news/imagen/{imagen}', [NewController::class, 'destroyImagen'])->name('news.imagen.destroy');
    Route::delete('tourists/imagen/{imagen}', [TouristController::class, 'destroyImagen'])->name('tourists.imagen.destroy');
    Route::delete('negocios/imagen/{imagen}', [NegocioController::class, 'destroyImagen'])->name('negocios.imagen.destroy');
    Route::get('pagos', [PagoController::class, 'index'])->name('pagos.index');
    Route::get('pagos/crear', [PagoController::class, 'create'])->name('pagos.create');
    Route::get('pagos/{pago}/editar', [PagoController::class, 'edit'])->name('pagos.edit');
    Route::put('pagos/{pago}', [PagoController::class, 'update'])->name('pagos.update');
    Route::post('pagos', [PagoController::class, 'store'])->name('pagos.store');
    Route::post('pagos/{pago}/aprobar', [PagoController::class, 'aprobar'])->name('pagos.aprobar');
    Route::post('pagos/{pago}/rechazar', [PagoController::class, 'rechazar'])->name('pagos.rechazar');
    Route::delete('pagos/{pago}', [PagoController::class, 'destroy'])->name('pagos.destroy');
    Route::put('profile/{profile}', [ProfileController::class, 'update'])->name('profile.update');
});

Route::middleware(['role:admin,rrhh'])->group(function () {
    Route::resource('profesionales', ProfesionalController::class)->parameters(['profesionales' => 'profesional']);
});

Route::middleware(['role:rrhh'])->group(function () {
    Route::get('panel-rrhh', function () {
        return view('admin.rrhh.dashboard');
    })->name('rrhh.dashboard');
});

Route::middleware(['role:periodista'])->group(function () {
    Route::get('panel-periodista', function () {
        return view('periodista.dashboard');
    })->name('periodista.dashboard');
    Route::get('mis-noticias', [NewController::class, 'index'])->name('mynews.index');
    Route::get('mis-noticias/create', [NewController::class, 'create'])->name('mynews.create');
    Route::post('mis-noticias', [NewController::class, 'store'])->name('mynews.store');
    Route::get('mis-noticias/{news}/edit', [NewController::class, 'edit'])->name('mynews.edit');
    Route::put('mis-noticias/{news}', [NewController::class, 'update'])->name('mynews.update');
    Route::delete('mis-noticias/{news}', [NewController::class, 'destroy'])->name('mynews.destroy');
    Route::delete('mis-noticias/imagen/{imagen}', [NewController::class, 'destroyImagen'])->name('mynews.imagen.destroy');
});
