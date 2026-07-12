<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profesional extends Model
{
    use HasFactory;

    protected $table = 'profesionales';

    protected $fillable = [
        'nombre',
        'especialidad',
        'sub_especialidad',
        'telefono',
        'email',
        'direccion',
        'horario',
        'disponibilidad',
        'experiencia_anios',
        'foto',
        'curriculum',
        'facebook',
        'instagram',
        'observaciones',
        'publicado',
        'user_id',
    ];

    protected $casts = [
        'publicado' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
