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
        //Ruta de origen de la foto
        $origen_4 = database_path('seeders\files\perfil\75840049.jpg');

        //Ruta de destino en las carpetas
        $rutaDestino_4 = 'fotos\perfil\1_75840049.jpg';

        //Copia de archivo en las carpetas
        Storage::disk('public')->put(
            $rutaDestino_4,
            file_get_contents($origen_4)
        );

        //Inserción del seeder
        Foto::insert([
            ['foto' => 1 , 'ubicacion' => $rutaDestino_4 , 'usercreacion' => 'SEEDER' , 'created_at' => now() , 'updated_at' => now()]
        ]);
    }
}
