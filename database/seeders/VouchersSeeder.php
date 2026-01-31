<?php

namespace Database\Seeders;

use App\Models\Voucher;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Seeder;

class VouchersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Ruta de origen de la foto
        $origen_1 = database_path('seeders\files\vouchers\voucher_1.jpg');
        $origen_4 = database_path('seeders\files\vouchers\voucher_4.jpg');

        //Ruta de destino en las carpetas
        $rutaDestino_1 = 'fotos\perfil\voucher_1.jpg';
        $rutaDestino_4 = 'fotos\perfil\voucher_4.jpg';

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
        Voucher::insert([
            ['voucher' => 1 , 'numero_voucher' => '000001' , 'ubicacion' => $rutaDestino_1 , 'usercreacion' => 'SEEDER' , 'created_at' => now() , 'updated_at' => now()],
            ['voucher' => 2 , 'numero_voucher' => '000001' , 'ubicacion' => $rutaDestino_4 , 'usercreacion' => 'SEEDER' , 'created_at' => now() , 'updated_at' => now()]
        ]);
    }
}
