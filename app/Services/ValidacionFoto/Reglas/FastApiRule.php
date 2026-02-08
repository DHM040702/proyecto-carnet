<?php

namespace App\Services\ValidacionFoto\Reglas;

use Illuminate\Support\Facades\Http;

class FastApiRule
{
    public function check(string $path): array
    {
        
        try {
            $response = Http::timeout(120)
                ->attach(
                    'file',
                    fopen($path, 'r'),
                    basename($path)
                )
                ->post(
                    'http://127.0.0.1:9000/validacion/foto'
                );

            if ($response->failed()) {
                return [
                    'key' => 'fastapi',
                    'label' => 'Validación facial',
                    'ok' => false,
                    'detalle' => null,
                    'mensaje' => 'Servicio de reconocimiento no disponible'
                ];
            }

            // FastAPI ya devuelve exactamente el formato que usas
            return $response->json();

        } catch (\Throwable $e) {
            return [
                'key' => 'fastapi',
                'label' => 'Validación facial',
                'ok' => false,
                'detalle' => null,
                'mensaje' => 'Error conectando con FastAPI'
            ];
        }
    }
}