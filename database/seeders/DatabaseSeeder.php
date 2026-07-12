<?php

namespace Database\Seeders;

use App\Models\News;
use App\Models\Profile;
use App\Models\Stories;
use App\Models\Tourist;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {


        Storage::makeDirectory('news');
        Storage::makeDirectory('stories');
        Storage::makeDirectory('touristsites');
        $user = User::factory()->create([
            'name' => 'Cristian',
            'email' => 'Cristianfloresmer@gmail.com',
            'password' => bcrypt('sancrisadmin2025'),
        ]);
        Profile::create([
            'nombre_comunidad'     => 'San Cristóbal',
            'descripcion'          => 'Comunidad minera con gran riqueza cultural.',
            'alcalde'              => 'Juan Pérez',
            'telefono_municipal'   => '591-2620000',
            'direccion_municipal'  => 'Av. Principal N° 123',
            'hospital_principal'   => 'Hospital San Cristóbal',
            'direccion_hospital'   => 'Calle Salud N° 456',
            'telefono_hospital'    => '591-2620011',
            'telefono_bomberos'    => '591-2620022',
            'telefono_policia'     => '591-2620033',
            'telefono_emergencia'  => '911',
            'horarios_atencion'    => 'Lunes a Viernes de 08:00 a 16:00',
            'enlaces_utiles'       => 'https://techserviseweb.com',
            'user_id'              => $user->id,
        ]);
        News::factory()->count(4)->create();
        Tourist::factory()->count(1)->create();
        $this->call([
            CategoriaSeeder::class,
            SubcategoriaSeeder::class,
        ]);
    }
}
