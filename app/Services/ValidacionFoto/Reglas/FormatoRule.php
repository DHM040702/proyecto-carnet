<?php

namespace App\Services\ValidacionFoto\Reglas;

class FormatoRule
{
    public function key(): string
    {
        return 'formato';
    }

    public function check(string $path): array
    {
        if (! file_exists($path)) {
            return [
                'key' => 'formato',
                'label' => 'Formato JPG',
                'ok' => false,
                'mensaje' => 'El archivo no pudo ser leído por el sistema',
            ];
        }

        $mime = mime_content_type($path);

        return [
            'key' => 'formato',
            'label' => 'Formato JPG',
            'ok' => in_array($mime, ['image/jpeg']),
            'mensaje' => $mime !== 'image/jpeg'
                ? 'La imagen no está en formato JPG'
                : null,
        ];
    }
}
