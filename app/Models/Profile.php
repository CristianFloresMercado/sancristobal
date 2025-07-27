<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    /** @use HasFactory<\Database\Factories\ProfileFactory> */
    use HasFactory;
    protected $fillable = [
        'nombre_comunidad',
        'descripcion',
        'alcalde',
        'telefono_municipal',
        'direccion_municipal',
        'hospital_principal',
        'direccion_hospital',
        'telefono_hospital',
        'telefono_bomberos',
        'telefono_policia',
        'telefono_emergencia',
        'horarios_atencion',
        'enlaces_utiles',
        'user_id',  // Si usas user_id y quieres asignarlo en masa
    ];
}
