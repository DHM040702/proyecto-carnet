<?php

namespace Database\Seeders;

use App\Models\Foto;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Seeder;

class FotosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        //Rutas de origen de las fotos
        $origen_1 = database_path('seeders\files\perfil\72279092.jpg');
        $origen_4 = database_path('seeders\files\perfil\75840049.jpg');

        //Ruta de destino en las carpetas
        $rutaDestino_1 = 'fotos\perfil\1_72279092.jpg';
        $rutaDestino_4 = 'fotos\perfil\1_75840049.jpg';

        //Copia de archivo en las carpetas
        Storage::disk('public')->put(
            $rutaDestino_4,
            file_get_contents($origen_4)
        );
        Storage::disk('public')->put(
            $rutaDestino_1,
            file_get_contents($origen_1)
        );

        //Inserción del seeder
        Foto::insert([
            ['foto' => 1 , 'ubicacion' => $rutaDestino_1 , 'usercreacion' => 'SEEDER' , 'created_at' => now() , 'updated_at' => now()],
            ['foto' => 1 , 'ubicacion' => $rutaDestino_4 , 'usercreacion' => 'SEEDER' , 'created_at' => now() , 'updated_at' => now()]
        ]);
    }
}
