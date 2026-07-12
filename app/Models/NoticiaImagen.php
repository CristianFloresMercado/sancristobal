<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class NoticiaImagen extends Model
{
    protected $table = 'noticia_imagenes';
    protected $fillable = ['news_id', 'imagen', 'orden'];
    public function noticia()
    {
        return $this->belongsTo(News::class, 'news_id');
    }
}
