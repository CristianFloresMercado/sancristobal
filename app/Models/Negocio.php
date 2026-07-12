<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class Negocio extends Model
{
    protected $fillable = [
        'categoria_id', 'subcategoria_id', 'nombre', 'slug', 'descripcion',
        'logo', 'foto_principal', 'direccion', 'latitud', 'longitud',
        'telefono', 'whatsapp', 'correo', 'sitio_web', 'facebook',
        'instagram', 'tiktok', 'horario', 'plan', 'plan_estado', 'plan_fecha_fin', 'publicado',
    ];
    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }
    public function subcategoria()
    {
        return $this->belongsTo(Subcategoria::class);
    }
    public function imagenes()
    {
        return $this->hasMany(NegocioImagen::class);
    }
    public function pagos()
    {
        return $this->hasMany(Pago::class);
    }
    public function estaActivo(): bool
    {
        if ($this->plan === 'none' || $this->plan === null) {
            return false;
        }
        if ($this->plan_estado !== 'activo') {
            return false;
        }
        if ($this->plan_fecha_fin && Carbon::parse($this->plan_fecha_fin)->isPast()) {
            return false;
        }
        return true;
    }
}
