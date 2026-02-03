<?php

namespace Database\Seeders;

use App\Models\Administrador;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdministradoresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Administrador::insert([
            ['nombre' => 'admin' , 'user' => 'admin' , 'password' => Hash::make('admin1234') , 'roles_id' => 1 , 'usercreacion' => 'SEEDER' , 'created_at' => now() , 'updated_at' => now()],
            ['nombre' => 'Diego' , 'user' => 'diego' , 'password' => Hash::make('diego1234') , 'roles_id' => 1 , 'usercreacion' => 'SEEDER' , 'created_at' => now() , 'updated_at' => now()]
        ]);
    }
}
