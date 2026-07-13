<?php

namespace Database\Seeders;

use App\Models\News;
use App\Models\Profile;
use App\Models\Tourist;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Storage::makeDirectory('news');
        Storage::makeDirectory('touristsites');

        $admin = User::create([
            'name' => 'Cristian',
            'email' => 'Cristianfloresmer@gmail.com',
            'password' => Hash::make('sancrisadmin2025'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'RRHH',
            'email' => 'rrhh@sancristobal.com',
            'password' => Hash::make('rrhh2025'),
            'role' => 'rrhh',
        ]);

        User::create([
            'name' => 'Periodista',
            'email' => 'periodista@sancristobal.com',
            'password' => Hash::make('periodista2025'),
            'role' => 'periodista',
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
            'user_id'              => $admin->id,
        ]);

        News::insert([
            [
                'titulo' => 'San Cristóbal celebra el 150º aniversario de su fundación',
                'resumen' => 'Con un acto solemne, la población conmemora los 150 años de historia y progreso de San Cristóbal.',
                'user_id' => $admin->id,
                'publicado' => 1,
                'autor' => 'Redacción Diario Potosí',
                'fuente' => 'Diario Potosí',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'titulo' => 'Inician las fiestas patronales en honor a San Cristóbal',
                'resumen' => 'Durante dos semanas, la comunidad se une en festejos religiosos y culturales en honor al santo patrón.',
                'user_id' => $admin->id,
                'publicado' => 1,
                'autor' => 'Equipo Cultural San Cristóbal',
                'fuente' => 'Oficina de Cultura San Cristóbal',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'titulo' => 'Nuevo programa educativo impulsa la enseñanza bilingüe',
                'resumen' => 'El gobierno local implementa un programa para fortalecer la educación en quechua y español.',
                'user_id' => $admin->id,
                'publicado' => 1,
                'autor' => 'Ministerio de Educación',
                'fuente' => 'Ministerio de Educación Nacional',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'titulo' => 'La comunidad minera recibe nuevas inversiones para el desarrollo',
                'resumen' => 'Importantes empresas invierten en modernizar la infraestructura minera y generar empleo local.',
                'user_id' => $admin->id,
                'publicado' => 1,
                'autor' => 'Corporación Minera de Bolivia',
                'fuente' => 'Corporación Minera de Bolivia (COMIBOL)',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        Tourist::create([
            'titulo' => 'Iglesia de San Cristóbal',
            'resumen' => 'Un vistazo a la historia y la importancia cultural de la Iglesia de San Cristóbal.',
            'user_id' => $admin->id,
            'publicado' => '1',
            'direccion' => 'Calle Bolivar entre Comercio y Sucre',
            'ubicacion' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1106.2445851089612!2d-67.16505663523924!3d-21.154450726549726!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94000f97e4c56fd9%3A0x318dc5f50da54c04!2sIglesia%20San%20Cristobal!5e0!3m2!1ses!2sbo!4v1755536685039!5m2!1ses!2sbo',
            'horario' => 'Lunes a Viernes de 08:00 a 18:00',
        ]);

        $this->call([
            CategoriaSeeder::class,
            SubcategoriaSeeder::class,
        ]);
    }
}
