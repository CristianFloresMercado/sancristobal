<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    /** @use HasFactory<\Database\Factories\NewsFactory> */
    use HasFactory;
    protected $fillable = [
        'titulo',
        'resumen',
        'autor',
        'fuente',
        'imagen_destacada',
        'publicado',
        'user_id',
        
    ];
}
