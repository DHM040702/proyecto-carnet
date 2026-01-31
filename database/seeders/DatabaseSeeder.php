<?php

namespace Database\Seeders;

use App\Models\Estudiante;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */


    public function run()
    {
        $this->call([
            FacultadesSeeder::class,
            EscuelasSeeder::class,
            PersonasSeeder::class,
            MatriculasSeeder::class,
            SemestresSeeder::class,
            EstadosSeeder::class,
            EstudiantesSeeder::class
        ]);
    }
}
