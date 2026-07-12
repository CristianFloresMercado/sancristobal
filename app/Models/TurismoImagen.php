<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class TurismoImagen extends Model
{
    protected $table = 'turismo_imagenes';
    protected $fillable = ['tourist_id', 'imagen', 'orden'];
    public function turismo()
    {
        return $this->belongsTo(Tourist::class, 'tourist_id');
    }
}
