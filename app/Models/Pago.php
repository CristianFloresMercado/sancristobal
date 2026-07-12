<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Pago extends Model
{
    protected $fillable = [
        'negocio_id', 'tipo_plan', 'monto', 'fecha_pago',
        'fecha_inicio', 'fecha_fin', 'estado', 'comprobante', 'observaciones',
    ];
    protected $casts = [
        'monto' => 'decimal:2',
        'fecha_pago' => 'date',
        'fecha_inicio' => 'date',
        'fecha_fin' => 'date',
    ];
    public function negocio()
    {
        return $this->belongsTo(Negocio::class);
    }
}
