<?php

namespace Database\Factories;

use App\Models\Tourist;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Touristsites>
 */
class TouristFactory extends Factory
{
    protected $model = Tourist::class;

    public function definition()
    {
        $originalPath = public_path('image/sancris/turismo/iglesia.jpg');

        // Carpeta destino en public/storage/sitios
        $destinationFolder = public_path('storage/sitios');

        // Crear carpeta si no existe
        if (!File::exists($destinationFolder)) {
            File::makeDirectory($destinationFolder, 0755, true);
        }

        // Nombre único para la imagen
        $fileName = 'iglesia_' . uniqid() . '.jpg';

        // Copiar la imagen
        File::copy($originalPath, $destinationFolder . '/' . $fileName);

        return [
            'titulo' => 'Iglesia de San Cristóbal',
            'resumen' => 'Un vistazo a la historia y la importancia cultural de la Iglesia de San Cristóbal.',
            'imagen_destacada' => 'sitios/' . $fileName, // Ruta relativa
            'user_id' => 1,
            'publicado' => '1',
            'direccion' => 'Calle Bolivar entre Comercio y Sucre',
            'ubicacion' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1106.2445851089612!2d-67.16505663523924!3d-21.154450726549726!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94000f97e4c56fd9%3A0x318dc5f50da54c04!2sIglesia%20San%20Cristobal!5e0!3m2!1ses!2sbo!4v1755536685039!5m2!1ses!2sbo',
            'horario' => 'Lunes a Viernes de 08:00 a 18:00',
        ];
    }
}
