<?php

use App\Models\News;
use App\Models\Negocio;
use App\Models\Profesional;
use App\Models\Profile;
use App\Models\Tourist;
use App\Models\User;

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::get('/', function () {
    $comunidad = Profile::first();
    $instituciones = \App\Models\Institucion::where('publicado', true)->orderBy('orden')->get();
    return view('welcome', compact('comunidad', 'instituciones'));
})->name('home');

Route::get('/news', function () {
    $query = News::where('publicado', 1)->orderBy('created_at', 'desc');
    if (request('buscar')) {
        $buscar = request('buscar');
        $query->where(function ($q) use ($buscar) {
            $q->where('titulo', 'like', "%{$buscar}%")
              ->orWhere('resumen', 'like', "%{$buscar}%")
              ->orWhere('autor', 'like', "%{$buscar}%");
        });
    }
    $new = $query->get();
    return view('new', compact('new'));
})->name('noticias');

Route::get('/tourists', function () {
    $query = Tourist::where('publicado', 1)->orderBy('created_at', 'desc');
    if (request('buscar')) {
        $buscar = request('buscar');
        $query->where(function ($q) use ($buscar) {
            $q->where('titulo', 'like', "%{$buscar}%")
              ->orWhere('ubicacion', 'like', "%{$buscar}%");
        });
    }
    $touristsites = $query->get();
    return view('tourists', compact('touristsites'));
})->name('turismo');

Route::get('/negocios', function () {
    $negocios = \App\Models\Negocio::with(['categoria', 'subcategoria', 'imagenes'])
        ->where('publicado', true)
        ->get()
        ->filter(fn($n) => $n->estaActivo());
    $categorias = \App\Models\Categoria::all();
    return view('negocios', compact('negocios', 'categorias'));
})->name('negocios');

Route::get('/dashboard', function () {
    if (auth()->user()->isPeriodista()) {
        return redirect()->route('admin.periodista.dashboard');
    }
    if (auth()->user()->isRrhh()) {
        return redirect()->route('admin.rrhh.dashboard');
    }

    $totalNews = News::count();
    $totalTourists = Tourist::count();
    $totalNegocios = Negocio::count();
    $totalProfesionales = Profesional::count();
    $totalUsers = User::count();
    $newsRecientes = News::latest()->take(5)->get();
    $negociosRecientes = Negocio::latest()->take(5)->get();
    $profesionalesRecientes = Profesional::latest()->take(5)->get();

    $negociosMapa = Negocio::where('publicado', true)
        ->select('nombre', 'latitud', 'longitud', 'direccion')
        ->get();

    $comunidad = Profile::first();

    return view('dashboard', compact(
        'totalNews', 'totalTourists', 'totalNegocios', 'totalProfesionales',
        'totalUsers', 'newsRecientes', 'negociosRecientes',
        'profesionalesRecientes', 'negociosMapa', 'comunidad'
    ));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/comunidad', function () {
    $comunidad = Profile::first();
    return view('comunidad', compact('comunidad'));
})->middleware(['auth', 'verified'])->name('comunidad');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');
    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__.'/auth.php';
