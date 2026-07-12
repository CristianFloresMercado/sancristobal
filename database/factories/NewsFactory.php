<?php

namespace Database\Factories;

use App\Models\News;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\Factories\Factory;

class NewsFactory extends Factory
{
    protected $model = News::class;

    protected $titulos = [
        'San Cristóbal celebra el 150º aniversario de su fundación',
        'Inician las fiestas patronales en honor a San Cristóbal',
        'Nuevo programa educativo impulsa la enseñanza bilingüe',
        'La comunidad minera recibe nuevas inversiones para el desarrollo',
        'Campaña de vacunación masiva beneficia a cientos de vecinos',
        'Avanzan obras de mejoramiento vial en la provincia Nor Lípez',
        'Festival cultural reúne a artistas y artesanos locales',
        'Bolivia celebra su aniversario con actos cívicos en San Cristóbal',
        'Proyecto de energías renovables avanza en la región de Potosí',
        'Escuelas promueven actividades de educación ambiental y reciclaje'
    ];

    protected $resumenes = [
        'Con un acto solemne, la población conmemora los 150 años de historia y progreso de San Cristóbal.',
        'Durante dos semanas, la comunidad se une en festejos religiosos y culturales en honor al santo patrón.',
        'El gobierno local implementa un programa para fortalecer la educación en quechua y español.',
        'Importantes empresas invierten en modernizar la infraestructura minera y generar empleo local.',
        'La jornada sanitaria incluye vacunación contra la influenza y chequeos médicos gratuitos.',
        'Se están construyendo nuevas vías para mejorar la conectividad y el comercio regional.',
        'Artesanos y músicos participan en el evento que resalta la riqueza cultural de la zona.',
        'Actos patrios incluyen desfiles, discursos y actividades educativas en colegios y plazas públicas.',
        'Se inauguran paneles solares y parques eólicos para contribuir al desarrollo sostenible.',
        'Los centros educativos promueven talleres y campañas para el cuidado del medio ambiente.'
    ];

    protected $autores = [
        'Redacción Diario Potosí',
        'Equipo Cultural San Cristóbal',
        'Ministerio de Educación',
        'Corporación Minera de Bolivia',
        'Secretaría de Salud Pública',
        'Gobierno Municipal Nor Lípez',
        'Fundación Arte y Cultura',
        'Instituto Nacional de Historia',
        'Agencia de Energías Renovables',
        'Programa Ambiental Escolar'
    ];

    protected $fuentes = [
        'Diario Potosí',
        'Oficina de Cultura San Cristóbal',
        'Ministerio de Educación Nacional',
        'Corporación Minera de Bolivia (COMIBOL)',
        'Secretaría Municipal de Salud',
        'Gobierno Autónomo Municipal de Nor Lípez',
        'Fundación Arte y Cultura Local',
        'Instituto Nacional de Historia de Bolivia',
        'Agencia Nacional de Energía Renovable',
        'Programa Ambiental Escolar Nacional'
    ];




    // Variable estática para índice secuencial
    protected static $index = 0;
    


    public function definition()
    {
        $originalPath = public_path('image/sancris/turismo/iglesia.jpg');

        // Carpeta destino en public/storage/news
        $destinationFolder = public_path('storage/news');

        // Crear carpeta si no existe
        if (!File::exists($destinationFolder)) {
            File::makeDirectory($destinationFolder, 0755, true);
        }

        // Nombre único para la imagen
        $fileName = 'Noticias_' . uniqid() . '.jpg';

        // Copiar la imagen
        File::copy($originalPath, $destinationFolder . '/' . $fileName);


        $i = self::$index % count($this->titulos);
        self::$index++;

        return [
            'titulo' => $this->titulos[$i],
            'resumen' => $this->resumenes[$i],
            'imagen_destacada' => 'news/' . $fileName, // Ruta relativa
            'user_id' => 1,
            'publicado' => $this->faker->boolean(90),
            'autor' => $this->autores[$i],
            'fuente' => $this->fuentes[$i],
        ];
    }
}
