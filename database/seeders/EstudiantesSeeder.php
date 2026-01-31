<?php

namespace Database\Seeders;

use App\Models\Estudiante;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use function Symfony\Component\Clock\now;

class EstudiantesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Estudiante::insert([
            ['codigo_estudiante' => '201.2503.013' , 'fecha_creacion' => now() , 'correo' => 'shuamanm@unasam.edu.pe' , 'personas_id' => 1 , 'escuelas_id' => 1 , 'matriculas_id' => 14 , 'usercreacion' => 'SEEDER' , 'created_at' => now() , 'updated_at' => now()],
            ['codigo_estudiante' => '181.2503.071' , 'fecha_creacion' => now() , 'correo' => 'jurbanom@unasam.edu.pe' , 'personas_id' => 2 , 'escuelas_id' => 1 , 'matriculas_id' => 17 , 'usercreacion' => 'SEEDER' , 'created_at' => now() , 'updated_at' => now()],
            ['codigo_estudiante' => '191.2503.048' , 'fecha_creacion' => now() , 'correo' => 'wbravom@unasam.edu.pe' , 'personas_id' => 3 , 'escuelas_id' => 1 , 'matriculas_id' => 16 , 'usercreacion' => 'SEEDER' , 'created_at' => now() , 'updated_at' => now()],
            ['codigo_estudiante' => '051.2503.' , 'fecha_creacion' => now() , 'correo' => 'arosaless@unasam.edu.pe' , 'personas_id' => 4 , 'escuelas_id' => 1 , 'matriculas_id' => 18 , 'usercreacion' => 'SEEDER' , 'created_at' => now() , 'updated_at' => now()],
            ['codigo_estudiante' => '201.2503.' , 'fecha_creacion' => now() , 'correo' => 'brubina@unasam.edu.pel' , 'personas_id' => 5 , 'escuela_id' => 1 , 'matriculas_id' => 14 , 'usercreacion' => 'SEEDER' , 'created_at' => now() , 'updated_at' => now()]
        ]);
    }
}
