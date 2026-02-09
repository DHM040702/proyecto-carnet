<?php

namespace App\Services\ValidacionFoto\Reglas;

use Illuminate\Support\Facades\Http;

class FastApiRuleFondo
{
    public function key(): string
    {
        return 'fondo';
    }

    public function check(string $path): array
    {
        try {
            $response = Http::timeout(120)
                ->attach('file', fopen($path, 'r'), basename($path))
                ->post('http://127.0.0.1:9000/fondo/validar');

            if ($response->failed()) {
                return $this->fail('Servicio de validación de fondo no disponible');
            }

            $data = $response->json();

            return [
                'key' => 'fondo',
                'label' => 'Validación de fondo',
                'ok' => (bool) ($data['ok'] ?? false),
                'detalle' => $data['detalle'] ?? null,
                'mensaje' => $data['mensaje'] ?? null,
            ];

        } catch (\Throwable $e) {
            return $this->fail('Error conectando con FastAPI (fondo)');
        }
    }

    protected function fail(string $msg): array
    {
        return [
            'key' => 'fondo',
            'label' => 'Validación de fondo',
            'ok' => false,
            'detalle' => null,
            'mensaje' => $msg,
        ];
    }
}