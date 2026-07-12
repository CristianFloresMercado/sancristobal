<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Categoria;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categorias = [
            [
                'nombre' => 'Comida',
                'descripcion' => 'Restaurantes, snacks y lugares gastronómicos.'
            ],
            [
                'nombre' => 'Hospedaje',
                'descripcion' => 'Hoteles, alojamientos y residenciales.'
            ],
            [
                'nombre' => 'Turismo',
                'descripcion' => 'Lugares turísticos y agencias.'
            ],
            [
                'nombre' => 'Salud',
                'descripcion' => 'Farmacias, clínicas y centros médicos.'
            ],
            [
                'nombre' => 'Belleza',
                'descripcion' => 'Peluquerías, barberías y estética.'
            ],
            [
                'nombre' => 'Tiendas',
                'descripcion' => 'Minimarkets y comercios.'
            ],
            [
                'nombre' => 'Tecnología',
                'descripcion' => 'Soporte técnico, internet y computación.'
            ],
        ];

        foreach ($categorias as $categoria) {
            Categoria::create($categoria);
        }
    }
}