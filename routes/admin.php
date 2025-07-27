<?php

use App\Http\Controllers\Admin\NewController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\StorieController;
use App\Http\Controllers\Admin\TouristsitesController;
use Illuminate\Support\Facades\Route;

Route::resource('news',NewController::class);
Route::resource('stories',StorieController::class);
Route::resource('tourists',TouristsitesController::class);
Route::resource('profile',ProfileController::class);