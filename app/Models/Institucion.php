<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Institucion extends Model
{
    use HasFactory;
    protected $table = 'instituciones';
    protected $fillable = [
        'nombre', 'tipo', 'telefono', 'direccion', 'horario',
        'contacto', 'descripcion', 'imagen', 'publicado', 'orden',
    ];
    protected $casts = [
        'publicado' => 'boolean',
    ];
}
