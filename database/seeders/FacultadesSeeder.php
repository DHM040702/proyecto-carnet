<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Facultad;

class FacultadesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Facultad::insert([
            ['facultad' => 'Facultad de Ciencias' , 'abreviatura' => 'FC' , 'usercreacion' => 'SEEDER' , 'created_at' => now() , 'updated_at' => now()],
            ['facultad' => 'Facultad de Ciencias Médicas' , 'abreviatura' => 'FCM'  , 'usercreacion' => 'SEEDER' , 'created_at' => now() , 'updated_at' => now()],
            ['facultad' => 'Facultad de Ingeniería Civil' , 'abreviatura' => 'FIC'  , 'usercreacion' => 'SEEDER' , 'created_at' => now() , 'updated_at' => now()],
            ['facultad' => 'Facultad de Ingeniería Minas, Geología y Metalúrgia' , 'abreviatura' => 'FIMGM'  , 'usercreacion' => 'SEEDER' , 'created_at' => now() , 'updated_at' => now()],
            ['facultad' => 'Facultad de Ciencias Póliticas' , 'abreviatura' => 'FCCPP'  , 'usercreacion' => 'SEEDER' , 'created_at' => now() , 'updated_at' => now()],
            ['facultad' => 'Facultad de Ingeniería de Industrias Alimentarias' , 'abreviatura' => 'FIIA'  , 'usercreacion' => 'SEEDER' , 'created_at' => now() , 'updated_at' => now()],
            ['facultad' => 'Facultad de Ciencias del Ambiente' , 'abreviatura' => 'FCAM'  , 'usercreacion' => 'SEEDER' , 'created_at' => now() , 'updated_at' => now()],
            ['facultad' => 'Facultad de Ciencias, Sociales Educación y de la Comunicación' , 'abreviatura' => 'FECSEC'  , 'usercreacion' => 'SEEDER' , 'created_at' => now() , 'updated_at' => now()],
            ['facultad' => 'Facultad de Administración y Turismo' , 'abreviatura' => 'FAT'  , 'usercreacion' => 'SEEDER' , 'created_at' => now() , 'updated_at' => now()],
            ['facultad' => 'Facultad de Economía y Contabilidad' , 'abreviatura' => 'FEC'  , 'usercreacion' => 'SEEDER' , 'created_at' => now() , 'updated_at' => now()],
            ['facultad' => 'Facultad de Ciencias Agrarias' , 'abreviatura' => 'FCA'  , 'usercreacion' => 'SEEDER' , 'created_at' => now() , 'updated_at' => now()],
            ['facultad' => 'Facultad de Medicina Humana' , 'abreviatura' => 'FMH'  , 'usercreacion' => 'SEEDER' , 'created_at' => now() , 'updated_at' => now()],
        ]);
    }
}
