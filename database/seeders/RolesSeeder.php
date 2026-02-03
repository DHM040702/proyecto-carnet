<?php

namespace Database\Seeders;

use App\Models\Rol;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Rol::insert([
            ['rol' => 'administrador' , 'usercreacion' => 'SEEDER' , 'created_at' => now() , 'updated_at' => now()],
            ['rol' => 'usuario' , 'usercreacion' => 'SEEDER' , 'created_at' => now() , 'updated_at' => now()],
            ['rol' => 'alumno' , 'usercreacion' => 'SEEDER' , 'created_at' => now() , 'updated_at' => now()]
        ]);
    }
}
