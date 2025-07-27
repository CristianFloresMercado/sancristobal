<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Touristsites extends Model
{
    /** @use HasFactory<\Database\Factories\TouristsitesFactory> */
    use HasFactory;
        
       protected $fillable = [
        'titulo',
        'ubicacion',
        'coordenadas',
        'horario',
        'resumen',
        'publicado',
        'imagen_destacada',
    ];

 
}
