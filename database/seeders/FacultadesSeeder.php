<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Facultad;
use Illuminate\Database\Seeder;

class FacultadesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Facultad::insert([
            ['facultad' => 'Facultad de Ciencias' , 'usercreacion' => 'SEEDER'],
            ['facultad' => 'Facultad de Ciencias Médicas' , 'usercreacion' => 'SEEDER'],
            ['facultad' => 'Facultad de Ingeniería Civil' , 'usercreacion' => 'SEEDER'],
            ['facultad' => 'Facultad de Ingeniería Minas, Geología y Metalúrgia' , 'usercreacion' => 'SEEDER'],
            ['facultad' => 'Facultad de Ciencias Póliticas' , 'usercreacion' => 'SEEDER'],
            ['facultad' => 'Facultad de Ingeniería de Industrias Alimentarias' , 'usercreacion' => 'SEEDER'],
            ['facultad' => 'Facultad de Ciencias del Ambiente' , 'usercreacion' => 'SEEDER'],
            ['facultad' => 'Facultad de Ciencias, Sociales Educación y de la Comunicación' , 'usercreacion' => 'SEEDER'],
            ['facultad' => 'Facultad de Administración y Turismo' , 'usercreacion' => 'SEEDER'],
            ['facultad' => 'Facultad de Economía y Contabilidad' , 'usercreacion' => 'SEEDER'],
            ['facultad' => 'Facultad de Ciencias Agrarias' , 'usercreacion' => 'SEEDER'],
            ['facultad' => 'Facultad de Medicina Humana' , 'usercreacion' => 'SEEDER'],
        ]);
    }
}
