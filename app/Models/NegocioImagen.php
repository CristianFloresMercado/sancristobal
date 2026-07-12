<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NegocioImagen extends Model
{
    protected $table = 'negocio_imagenes';
    protected $fillable = [
        'negocio_id',
        'imagen'
    ];

    public function negocio()
    {
        return $this->belongsTo(Negocio::class);
    }
}