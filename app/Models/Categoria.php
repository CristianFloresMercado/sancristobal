<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $fillable = [
        'nombre',
        'descripcion'
    ];

    public function subcategorias()
    {
        return $this->hasMany(Subcategoria::class);
    }

    public function negocios()
    {
        return $this->hasMany(Negocio::class);
    }
}