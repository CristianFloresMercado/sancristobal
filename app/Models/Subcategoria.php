<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subcategoria extends Model
{
    protected $fillable = [
        'categoria_id',
        'nombre'
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function negocios()
    {
        return $this->hasMany(Negocio::class);
    }
}