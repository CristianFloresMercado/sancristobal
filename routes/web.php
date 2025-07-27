<?php

use App\Models\News;
use App\Models\Profile;
use App\Models\Stories;
use App\Models\Touristsites;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;



Route::get('/', function () {
    $comunidad = Profile::first();

    return view('welcome', compact('comunidad'));
})->name('home');

Route::get('/news', function () {
    $new = News::where('publicado', 1)
               ->orderBy('created_at', 'desc')
               ->get();
    return view('new', compact('new'));
})->name('noticias');

Route::get('/tourists', function () {
    $touristsites = Touristsites::where('publicado', 1)
                                ->orderBy('created_at', 'desc')
                                ->get();
    return view('tourists', compact('touristsites'));
})->name('turismo');

Route::get('/history', function () {
    $stories = Stories::where('publicado', 1)
                        ->orderBy('created_at', 'desc')
                        ->get();
    return view('story', compact('stories'));
})->name('historia');


Route::get('/dashboard', function () {
    $comunidad = Profile::first(); // Obtiene la primera fila (y la única)
    return view('dashboard', compact('comunidad'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});


require __DIR__.'/auth.php';
