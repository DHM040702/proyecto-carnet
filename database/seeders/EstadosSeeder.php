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
            ['nombre_descripción' => 'PENDIENTE' , 'descripcion' => 'N/N' , 'usercreacion' => 'SEEDER'],
            ['nombre_descripción' => 'APROBADO' , 'descripcion' => 'N/N', 'usercreacion' => 'SEEDER'],
            ['nombre_descripción' => 'RECHAZADO' , 'descripcion' => 'N/N', 'usercreacion' => 'SEEDER']
        ]);
    }
}
