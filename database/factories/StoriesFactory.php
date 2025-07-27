<?php

namespace Database\Factories;

use App\Models\Stories;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Stories>
 */
class StoriesFactory extends Factory
{
     protected $model = Stories::class;

    // Datos precargados para usar aleatoriamente
    protected $titulos = [
        'El Descubrimiento de San Cristóbal',
        'La Fundación de Nuestra Comunidad',
        'La Minería que Transformó la Región',
        'Historias de los Pioneros Locales',
        'La Evolución de la Cultura Regional',
        'El Rol de los Personajes Legendarios',
        'Un Viaje al Pasado Minero',
        'La Lucha por el Desarrollo Sostenible',
        'Anécdotas de la Época Colonial',
        'Transformaciones Sociales Recientes'
    ];

    protected $resumenes = [
        'En este relato detallamos el descubrimiento de San Cristóbal y cómo influyó en la historia local y regional.',
        'Una historia sobre los primeros habitantes y la fundación oficial de la comunidad con datos históricos relevantes.',
        'La minería jugó un papel crucial en el desarrollo económico y social, cambiando el paisaje para siempre.',
        'Relatos de los primeros pioneros que con esfuerzo y dedicación sentaron las bases de la comunidad actual.',
        'Se exploran las raíces culturales y la evolución de las tradiciones que hacen única a San Cristóbal.',
        'Personajes que marcaron la historia local con su liderazgo, valentía y compromiso con el pueblo.',
        'Un recorrido por los eventos más importantes que definieron la minería en la región.',
        'La lucha constante de la comunidad por un desarrollo que proteja los recursos naturales y mejore la calidad de vida.',
        'Anécdotas y testimonios que reflejan la vida cotidiana durante la época colonial en San Cristóbal.',
        'Los cambios sociales más significativos que han ocurrido en las últimas décadas y su impacto actual.'
    ];

    protected $personajes = [
        'Don José Martínez, María López',
        'Juan Pérez, Ana Gómez',
        'Pedro Fernández, Lucia Rodríguez',
        'Carlos Díaz, Carmen Sánchez',
        'Miguel Torres, Rosa Jiménez',
        'Luis Herrera, Paula Mendoza',
        'Jorge Ramírez, Elena Castro',
        'Ricardo Morales, Teresa Vargas',
        'Alberto Navarro, Sofía Flores',
        'Felipe Cruz, Gabriela Castillo'
    ];

    public function definition(): array
    {
        $index = $this->faker->numberBetween(0, count($this->titulos) - 1);

        return [
            'titulo' => $this->titulos[$index],
            'resumen' => $this->resumenes[$index],
            'imagen_destacada' => $this->faker->image('public/storage/stories', 450, 350, null, false),
            'user_id' => 1,
            'publicado' => $this->faker->boolean(90),
            'año_ocurrido' => $this->faker->year(1900, 2023),
            'personajes' => $this->personajes[$index],
        ];
    }
}
