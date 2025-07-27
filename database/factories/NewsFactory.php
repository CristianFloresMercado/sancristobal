<?php

namespace Database\Factories;

use App\Models\News;
use App\Models\Stories;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\News>
 */
class NewsFactory extends Factory
{
    protected $model = News::class;

    protected $titulos = [
        'San Cristóbal celebra el aniversario de su fundación',
        'Nuevas inversiones impulsan la minería local',
        'Avances tecnológicos llegan a la comunidad',
        'Evento cultural reúne a toda la región',
        'Mejoras en infraestructura vial para San Cristóbal',
        'Campaña de salud pública beneficia a cientos',
        'Educación ambiental toma protagonismo en escuelas',
        'Iniciativa turística genera empleo local',
        'Proyecto de energías renovables en marcha',
        'Desarrollo social fortalece a familias vulnerables'
    ];

    protected $resumenes = [
        'La comunidad de San Cristóbal festeja con diversas actividades el aniversario que marca su historia y tradición.',
        'Importantes empresas han decidido invertir en la minería, generando nuevas oportunidades para la población.',
        'La llegada de tecnología de punta promete modernizar distintos sectores productivos y educativos.',
        'Artistas locales y visitantes se reúnen para celebrar la cultura y el arte en un festival anual.',
        'Las nuevas carreteras y caminos facilitan la movilidad y el comercio dentro y fuera de la comunidad.',
        'La campaña sanitaria ofrece vacunación y chequeos médicos para mejorar la salud pública.',
        'Programas educativos fomentan el cuidado del medio ambiente entre niños y jóvenes.',
        'El turismo sustentable se posiciona como motor económico con impacto positivo en la región.',
        'Se implementa un plan para desarrollar energía solar y eólica, contribuyendo al cuidado del planeta.',
        'Organizaciones sociales trabajan para mejorar las condiciones de vida de las familias más necesitadas.'
    ];

    protected $autores = [
        'Redacción San Cristóbal',
        'Equipo Minero Local',
        'Tecnología Hoy',
        'Cultura y Arte',
        'Infraestructura Regional',
        'Salud Comunitaria',
        'Educación Verde',
        'Turismo Sustentable',
        'Energías Renovables',
        'Desarrollo Social'
    ];

    protected $fuentes = [
        'Diario Regional',
        'Agencia Minera',
        'Noticias Tecnológicas',
        'Revista Cultural',
        'Gobierno Local',
        'Instituto de Salud',
        'Ministerio de Educación',
        'Oficina de Turismo',
        'Organización Ambiental',
        'Fundación Social'
    ];

    public function definition(): array
    {
        $index = $this->faker->numberBetween(0, count($this->titulos) - 1);

        return [
            'titulo' => $this->titulos[$index],
            'resumen' => $this->resumenes[$index],
            'imagen_destacada' => 'news/' . $this->faker->image('public/storage/news', 450, 350, null, false),
            'user_id' => 1,
            'publicado' => $this->faker->boolean(90),
            'autor' => $this->autores[$index],
            'fuente' => $this->fuentes[$index],
        ];
    }
}


