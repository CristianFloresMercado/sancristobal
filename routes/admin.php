<?php

use App\Http\Controllers\Admin\NewController;
use Illuminate\Support\Facades\Route;

Route::resource('news',NewController::class);


