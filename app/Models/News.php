<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class News extends Model
{
    use HasFactory;
    protected $fillable = [
        'titulo', 'resumen', 'autor', 'fuente', 'video_link',
        'imagen_destacada', 'publicado', 'user_id',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function imagenes()
    {
        return $this->hasMany(NoticiaImagen::class, 'news_id');
    }
}
