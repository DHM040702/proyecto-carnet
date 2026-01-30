<?php

namespace Database\Seeders;

use App\Models\Persona;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PersonasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Persona::insert([
            ['dni' => '72279092' , 'nombres' => 'Diego Sebastian', 'apellido_pat' => 'Huaman' , 'apellido_mat' => 'Moreno' , 'telefono' => '943904242' , 'usercreacion' => 'SEEDER' , 'created_at' => now() , 'updated_at' => now()], // 1
            ['dni' => '71289991' , 'nombres' => 'Jamil Sean', 'apellido_pat' => 'Urbano' , 'apellido_mat' => 'Macedo' , 'telefono' => '' , 'usercreacion' => 'SEEDER' , 'created_at' => now() , 'updated_at' => now()], // 2
            ['dni' => '71750860' , 'nombres' => 'Wilder Rodrigo', 'apellido_pat' => 'Bravo' , 'apellido_mat' => 'Moreno' , 'telefono' => '' , 'usercreacion' => 'SEEDER' , 'created_at' => now() , 'updated_at' => now()], // 3
            ['dni' => '71347303' , 'nombres' => 'Brayan Jefferson', 'apellido_pat' => 'Rubina' , 'apellido_mat' => 'Leiva' , 'telefono' => '' , 'usercreacion' => 'SEEDER' , 'created_at' => now() , 'updated_at' => now()], // 4
            ['dni' => '75840049' , 'nombres' => 'Angel Rolando', 'apellido_pat' => 'Rosales' , 'apellido_mat' => 'Silvestre' , 'telefono' => '' , 'usercreacion' => 'SEEDER' , 'created_at' => now() , 'updated_at' => now()], //5
        ]);
    }
}
