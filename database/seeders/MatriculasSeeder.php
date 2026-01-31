<?php

namespace Database\Seeders;

use App\Models\Matricula;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MatriculasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Matricula::insert([
            ['semestre_inicial' => '2025-2' , 'usercreacion' => 'SEEDER' , 'created_at' => now() , 'updated_at' => now()],
            ['semestre_inicial' => '2024-2' , 'usercreacion' => 'SEEDER' , 'created_at' => now() , 'updated_at' => now()],
            ['semestre_inicial' => '2023-2' , 'usercreacion' => 'SEEDER' , 'created_at' => now() , 'updated_at' => now()],
            ['semestre_inicial' => '2022-2' , 'usercreacion' => 'SEEDER' , 'created_at' => now() , 'updated_at' => now()],
            ['semestre_inicial' => '2021-2' , 'usercreacion' => 'SEEDER' , 'created_at' => now() , 'updated_at' => now()],
            ['semestre_inicial' => '2020-2' , 'usercreacion' => 'SEEDER' , 'created_at' => now() , 'updated_at' => now()],
            ['semestre_inicial' => '2019-2' , 'usercreacion' => 'SEEDER' , 'created_at' => now() , 'updated_at' => now()],
            ['semestre_inicial' => '2018-2' , 'usercreacion' => 'SEEDER' , 'created_at' => now() , 'updated_at' => now()],
            ['semestre_inicial' => '2017-2' , 'usercreacion' => 'SEEDER' , 'created_at' => now() , 'updated_at' => now()],
            ['semestre_inicial' => '2025-1' , 'usercreacion' => 'SEEDER' , 'created_at' => now() , 'updated_at' => now()],
            ['semestre_inicial' => '2024-1' , 'usercreacion' => 'SEEDER' , 'created_at' => now() , 'updated_at' => now()],
            ['semestre_inicial' => '2023-1' , 'usercreacion' => 'SEEDER' , 'created_at' => now() , 'updated_at' => now()],
            ['semestre_inicial' => '2022-1' , 'usercreacion' => 'SEEDER' , 'created_at' => now() , 'updated_at' => now()],
            ['semestre_inicial' => '2021-1' , 'usercreacion' => 'SEEDER' , 'created_at' => now() , 'updated_at' => now()],
            ['semestre_inicial' => '2020-1' , 'usercreacion' => 'SEEDER' , 'created_at' => now() , 'updated_at' => now()],
            ['semestre_inicial' => '2019-1' , 'usercreacion' => 'SEEDER' , 'created_at' => now() , 'updated_at' => now()],
            ['semestre_inicial' => '2018-1' , 'usercreacion' => 'SEEDER' , 'created_at' => now() , 'updated_at' => now()],
            ['semestre_inicial' => '2017-1' , 'usercreacion' => 'SEEDER' , 'created_at' => now() , 'updated_at' => now()]
        ]);
    }
}
