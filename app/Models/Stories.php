<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stories extends Model
{
    /** @use HasFactory<\Database\Factories\StoriesFactory> */
    use HasFactory;
    protected $fillable = [
        'titulo',
        'año_ocurrido',
        'personajes',
        'resumen',
        'publicado',
        'imagen_destacada',
    ];
}
