<?php

namespace Database\Factories;

use App\Models\Touristsites;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Touristsites>
 */
class TouristsitesFactory extends Factory
{
    protected $model = Touristsites::class;

    protected $titulos = [
        'Cerro Rico de Potosí',
        'Iglesia de San Lorenzo',
        'Laguna Colorada',
        'Salar de Uyuni',
        'Museo Minero de San Cristóbal',
        'Cascada de Chururuma',
        'Mirador de Huari',
        'Plaza Central de San Cristóbal',
        'Catedral de San Pedro',
        'Reserva Natural de Toro Toro'
    ];

    protected $resumenes = [
        'Famoso cerro rico que marcó la historia minera de la región, un sitio lleno de historia y leyendas.',
        'Iglesia colonial del siglo XVII, reconocida por su arquitectura y arte religioso.',
        'Laguna de aguas rojizas ubicada en la región andina, hogar de flamencos y paisajes espectaculares.',
        'El salar más grande del mundo, destino turístico obligado para viajeros y fotógrafos.',
        'Museo dedicado a la historia minera, con exposiciones de herramientas y relatos de la comunidad.',
        'Cascada natural rodeada de vegetación, perfecta para caminatas y fotografía.',
        'Mirador panorámico con vistas impresionantes del valle y montañas circundantes.',
        'Plaza principal donde se realizan eventos culturales y ferias comunitarias.',
        'Catedral emblemática que mezcla estilos arquitectónicos y es centro espiritual del pueblo.',
        'Reserva natural con senderos, cuevas y pinturas rupestres, ideal para ecoturismo.'
    ];

    protected $ubicaciones = [
        'San Cristóbal',
        'San Cristóbal',
        'Altiplano Andino',
        'Potosí',
        'San Cristóbal',
        'Cercanías de San Cristóbal',
        'San Cristóbal',
        'San Cristóbal',
        'San Cristóbal',
        'Toro Toro'
    ];

    protected $coordenadas = [
        '-19.5889,-65.7531',
        '-19.5931,-65.7578',
        '-21.4061,-67.8583',
        '-20.1338,-67.4891',
        '-19.5905,-65.7564',
        '-19.6000,-65.7600',
        '-19.5850,-65.7550',
        '-19.5899,-65.7540',
        '-19.5915,-65.7580',
        '-18.9752,-66.5878'
    ];

    protected $horarios = [
        'Lunes a Domingo: 08:00 - 18:00',
        'Lunes a Domingo: 09:00 - 17:00',
        'Solo visitas guiadas, horario variable',
        'Abierto todo el día, mejor visitar al amanecer o atardecer',
        'Martes a Domingo: 10:00 - 16:00',
        'Mejor visitar en temporada seca, 08:00 - 17:00',
        'Abierto todos los días, 07:00 - 19:00',
        'Centro de actividades y ferias los fines de semana',
        'Lunes a Sábado: 07:30 - 20:00',
        'Visitas guiadas con reserva previa'
    ];

    public function definition()
    {
        $index = $this->faker->numberBetween(0, count($this->titulos) - 1);

        return [
            'titulo' => $this->titulos[$index],
            'resumen' => $this->resumenes[$index],
            'imagen_destacada' => $this->faker->imageUrl(450, 350, 'nature', true, 'Turismo'),
            'user_id' => 1,
            'publicado' => $this->faker->boolean(85),
            'ubicacion' => $this->ubicaciones[$index],
            'coordenadas' => $this->coordenadas[$index],
            'horario' => $this->horarios[$index],
        ];
    }
}
