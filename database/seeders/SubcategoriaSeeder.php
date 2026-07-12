<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Subcategoria;
use App\Models\Categoria;

class SubcategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subcategorias = [

            // Comida
            ['categoria' => 'Comida', 'nombre' => 'Restaurante'],
            ['categoria' => 'Comida', 'nombre' => 'Pollería'],
            ['categoria' => 'Comida', 'nombre' => 'Snack'],
            ['categoria' => 'Comida', 'nombre' => 'Cafetería'],

            // Hospedaje
            ['categoria' => 'Hospedaje', 'nombre' => 'Hotel'],
            ['categoria' => 'Hospedaje', 'nombre' => 'Hostal'],
            ['categoria' => 'Hospedaje', 'nombre' => 'Residencial'],

            // Turismo
            ['categoria' => 'Turismo', 'nombre' => 'Lugar turístico'],
            ['categoria' => 'Turismo', 'nombre' => 'Agencia turística'],

            // Salud
            ['categoria' => 'Salud', 'nombre' => 'Farmacia'],
            ['categoria' => 'Salud', 'nombre' => 'Clínica'],

            // Belleza
            ['categoria' => 'Belleza', 'nombre' => 'Peluquería'],
            ['categoria' => 'Belleza', 'nombre' => 'Barbería'],

            // Tiendas
            ['categoria' => 'Tiendas', 'nombre' => 'Minimarket'],
            ['categoria' => 'Tiendas', 'nombre' => 'Librería'],

            // Tecnología
            ['categoria' => 'Tecnología', 'nombre' => 'Soporte técnico'],
            ['categoria' => 'Tecnología', 'nombre' => 'Internet'],
            ['categoria' => 'Tecnología', 'nombre' => 'Cámaras de seguridad'],
        ];

        foreach ($subcategorias as $item) {

            $categoria = Categoria::where('nombre', $item['categoria'])->first();

            if ($categoria) {
                Subcategoria::create([
                    'categoria_id' => $categoria->id,
                    'nombre' => $item['nombre']
                ]);
            }
        }
    }
}