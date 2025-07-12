<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function(){
    return "hola admin";
})->name('hola');

Route::get('/cursos', function(){
    return "hola cursos";
})->name('cursos');


