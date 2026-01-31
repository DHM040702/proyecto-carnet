<?php

namespace Database\Seeders;

use App\Models\Semestre;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SemestresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Semestre::insert([
            ['semestre' => '2025-1' , 'fecha_inicio' => '2025-03-15' , 'fecha_fin' => '2025-07-18' , 'fecha_inicio_solicitud' => '2025-04-12' , 'fecha_fin_solicitud' => '2025-05-30' , 'usercreacion' => 'SEEDER' , 'created_at' => now() , 'updated_at' => now()],
            ['semestre' => '2025-2' , 'fecha_inicio' => '2025-08-25' , 'fecha_fin' => '2025-12-12' , 'fecha_inicio_solicitud' => '2025-09-08' , 'fecha_fin_solicitud' => '2025-10-28' , 'usercreacion' => 'SEEDER' , 'created_at' => now() , 'updated_at' => now()],
            ['semestre' => '2024-1' , 'fecha_inicio' => '2024-03-15' , 'fecha_fin' => '2024-07-18' , 'fecha_inicio_solicitud' => '2024-04-15' , 'fecha_fin_solicitud' => '2024-05-30' , 'usercreacion' => 'SEEDER' , 'created_at' => now() , 'updated_at' => now()],
            ['semestre' => '2024-2' , 'fecha_inicio' => '2024-08-25' , 'fecha_fin' => '2024-12-12' , 'fecha_inicio_solicitud' => '2024-09-05' , 'fecha_fin_solicitud' => '2024-10-24' , 'usercreacion' => 'SEEDER' , 'created_at' => now() , 'updated_at' => now()],
            ['semestre' => '2023-1' , 'fecha_inicio' => '2023-03-15' , 'fecha_fin' => '2023-07-18' , 'fecha_inicio_solicitud' => '2023-04-12' , 'fecha_fin_solicitud' => '2023-05-27' , 'usercreacion' => 'SEEDER' , 'created_at' => now() , 'updated_at' => now()],
            ['semestre' => '2023-2' , 'fecha_inicio' => '2023-08-25' , 'fecha_fin' => '2023-12-12' , 'fecha_inicio_solicitud' => '2023-09-04' , 'fecha_fin_solicitud' => '2023-10-25' , 'usercreacion' => 'SEEDER' , 'created_at' => now() , 'updated_at' => now()],
            ['semestre' => '2022-1' , 'fecha_inicio' => '2022-03-15' , 'fecha_fin' => '2022-07-18' , 'fecha_inicio_solicitud' => '2022-04-11' , 'fecha_fin_solicitud' => '2022-11-01' , 'usercreacion' => 'SEEDER' , 'created_at' => now() , 'updated_at' => now()],
            ['semestre' => '2022-2' , 'fecha_inicio' => '2022-08-25' , 'fecha_fin' => '2022-12-12' , 'fecha_inicio_solicitud' => '2022-08-28' , 'fecha_fin_solicitud' => '2022-09-30' , 'usercreacion' => 'SEEDER' , 'created_at' => now() , 'updated_at' => now()],
            ['semestre' => '2021-1' , 'fecha_inicio' => '2021-03-15' , 'fecha_fin' => '2021-07-18' , 'fecha_inicio_solicitud' => '2021-04-22' , 'fecha_fin_solicitud' => '2021-11-20' , 'usercreacion' => 'SEEDER' , 'created_at' => now() , 'updated_at' => now()],
            ['semestre' => '2021-2' , 'fecha_inicio' => '2021-08-25' , 'fecha_fin' => '2021-12-12' , 'fecha_inicio_solicitud' => '2021-09-06' , 'fecha_fin_solicitud' => '2021-10-15' , 'usercreacion' => 'SEEDER' , 'created_at' => now() , 'updated_at' => now()],
            ['semestre' => '2026-1' , 'fecha_inicio' => '2026-03-23' , 'fecha_fin' => '' , 'fecha_inicio_solicitud' => '2026-04-10' , 'fecha_fin_solicitud' => '' , 'usercreacion' => 'SEEDER' , 'created_at' => now() , 'updated_at' => now()]
        ]);
    }
}
