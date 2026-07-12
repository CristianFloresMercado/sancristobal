<?php

namespace Database\Factories;

use App\Models\Stories;
use Illuminate\Database\Eloquent\Factories\Factory;

class StoriesFactory extends Factory
{
    protected $model = Stories::class;
    protected static $index = 0;

    public function definition()
    {
        return [
            'titulo' => 'Iglesia de San Cristóbal',
            'resumen' => 'Un vistazo a la historia y la importancia cultural de la Iglesia de San Cristóbal.',
            'imagen_destacada' => $this->faker->imageUrl(450, 350, 'people', true, 'Historia'),
            'user_id' => 1,
            'publicado' => '12/12/25',
            'año_ocurrido' => $this->faker->numberBetween(1500, 2023),
        ];
    }
};
