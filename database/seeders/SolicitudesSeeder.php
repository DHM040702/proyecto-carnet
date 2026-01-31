<?php

namespace Database\Seeders;

use App\Models\Solicitud;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SolicitudesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Solicitud::insert([
            ['numero_solicitud' => 1 , 'estudiantes_id' => 4 , 'fecha_solicitud' => now() , 'estados_id' => 1 , 'vouchers_id' => 1 , 'fotos_id' => 1 , 'semestres_id' => 1 , 'usercreacion' => 'SEEDER' , 'created_at' => now() , 'updated_at' => now()],
            ['numero_solicitud' => 2 , 'estudiantes_id' => 1 , 'fecha_solicitud' => now() , 'estados_id' => 1 , 'vouchers_id' => 2 , 'fotos_id' => 2 , 'semestres_id' => 1 , 'usercreacion' => 'SEEDER' , 'created_at' => now() , 'updated_at' => now()]
        ]);
    }
}
