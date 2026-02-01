<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Estado;
use Illuminate\Database\Seeder;

class EstadosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Estado::insert([
            ['estado' => 'PENDIENTE' , 'descripcion' => 'N/N' , 'usercreacion' => 'SEEDER' , 'created_at' => now() , 'updated_at' => now()],
            ['estado' => 'APROBADO' , 'descripcion' => 'N/N', 'usercreacion' => 'SEEDER' , 'created_at' => now() , 'updated_at' => now()],
            ['estado' => 'RECHAZADO' , 'descripcion' => 'N/N', 'usercreacion' => 'SEEDER' , 'created_at' => now() , 'updated_at' => now()]
        ]);
    }
}
