<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Escuela;
use Illuminate\Database\Seeder;

class EscuelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Escuela::insert([
            ['escuela' => 'Escuela de ingeniería de sistemas e informática' , 'facultad_id' => 1 , 'usercreacion' => 'SEEDER' , 'created_at' => now() , 'updated_at' => now()],
            ['escuela' => 'Arquitectura y Urbanismo' , 'facultad_id' => 3 , 'usercreacion' => 'SEEDER' , 'created_at' => now() , 'updated_at' => now()],
            ['escuela' => 'Ingeniería Agrícola' , 'facultad_id' => 11 , 'usercreacion' => 'SEEDER' , 'created_at' => now() , 'updated_at' => now()],
            ['escuela' => 'Ingeniería Agronómica' , 'facultad_id' => 11 , 'usercreacion' => 'SEEDER' , 'created_at' => now() , 'updated_at' => now()],
            ['escuela' => 'Ingeniería Ambiental' , 'facultad_id' => 7 , 'usercreacion' => 'SEEDER' , 'created_at' => now() , 'updated_at' => now()],
            ['escuela' => 'Ingeniería Civil' , 'facultad_id' => 3 , 'usercreacion' => 'SEEDER' , 'created_at' => now() , 'updated_at' => now()],
            ['escuela' => 'Estadística e Informática' , 'facultad_id' => 1 , 'usercreacion' => 'SEEDER' , 'created_at' => now() , 'updated_at' => now()],
            ['escuela' => 'Ingeniería Industrial' , 'facultad_id' => 6 , 'usercreacion' => 'SEEDER' , 'created_at' => now() , 'updated_at' => now()],
            ['escuela' => 'Ingería de Infustrias Alimentarias' , 'facultad_id' => 6 , 'usercreacion' => 'SEEDER' , 'created_at' => now() , 'updated_at' => now()],
            ['escuela' => 'Matemática' , 'facultad_id' => 1 , 'usercreacion' => 'SEEDER' , 'created_at' => now() , 'updated_at' => now()],
            ['escuela' => 'Enfermería' , 'facultad_id' => 2 , 'usercreacion' => 'SEEDER' , 'created_at' => now() , 'updated_at' => now()],
            ['escuela' => 'Obstetrícia' , 'facultad_id' => 2 , 'usercreacion' => 'SEEDER' , 'created_at' => now() , 'updated_at' => now()],
            ['escuela' => 'Ingenería Sanitaria' , 'facultad_id' => 7 , 'usercreacion' => 'SEEDER' , 'created_at' => now() , 'updated_at' => now()],
            ['escuela' => 'Administración' , 'facultad_id' => 9 , 'usercreacion' => 'SEEDER' , 'created_at' => now() , 'updated_at' => now()],
            ['escuela' => 'Contabilidad' , 'facultad_id' => 10 , 'usercreacion' => 'SEEDER' , 'created_at' => now() , 'updated_at' => now()],
            ['escuela' => 'Arquelogia' , 'facultad_id' => 8 , 'usercreacion' => 'SEEDER' , 'created_at' => now() , 'updated_at' => now()],
            ['escuela' => 'Ciencias de la Comunicación' , 'facultad_id' => 8 , 'usercreacion' => 'SEEDER' , 'created_at' => now() , 'updated_at' => now()],
            ['escuela' => 'Comunicación Lingüistica y Literatura' , 'facultad_id' => 8 , 'usercreacion' => 'SEEDER' , 'created_at' => now() , 'updated_at' => now()],
            ['escuela' => 'Derecho y Ciencias Políticas' , 'facultad_id' => 5 , 'usercreacion' => 'SEEDER' , 'created_at' => now() , 'updated_at' => now()],
            ['escuela' => 'Educación: Primaria y Educación Bilingüe Intercurtural' , 'facultad_id' => 8 , 'usercreacion' => 'SEEDER' , 'created_at' => now() , 'updated_at' => now()],
            ['escuela' => 'Lengua Extranjera: Ingles' , 'facultad_id' => 8 , 'usercreacion' => 'SEEDER' , 'created_at' => now() , 'updated_at' => now()],
            ['escuela' => 'Matemática e Informática' , 'facultad_id' => 1 , 'usercreacion' => 'SEEDER' , 'created_at' => now() , 'updated_at' => now()],
            ['escuela' => 'Medicina Humana' , 'facultad_id' => 12 , 'usercreacion' => 'SEEDER' , 'created_at' => now() , 'updated_at' => now()],
        ]);
    }
}
