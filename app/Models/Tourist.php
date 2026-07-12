<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Tourist extends Model
{
    use HasFactory;
    protected $table = 'tourists';
    protected $fillable = [
        'titulo', 'ubicacion', 'coordenadas', 'horario', 'resumen',
        'publicado', 'imagen_destacada', 'user_id', 'latitud', 'longitud',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function imagenes()
    {
        return $this->hasMany(TurismoImagen::class, 'tourist_id');
    }
}
