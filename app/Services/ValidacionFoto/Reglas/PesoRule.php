<?php

namespace App\Services\ValidacionFoto\Reglas;

class PesoRule
{
    protected int $maxBytes = 2 * 1024 * 1024; // 2MB

    public function key(): string
    {
        return 'peso';
    }

    public function check(string $path): array
    {
        $peso = filesize($path);
        $ok = $peso <= $this->maxBytes;

        return [
            'key' => 'peso',
            'label' => 'Peso del archivo',
            'ok' => $ok,
            'mensaje' => $ok
                ? null
                : 'La imagen supera el peso máximo permitido (2MB)',
            'detalle' => 'Peso detectado: ' . round($peso / 1024, 2) . ' KB',
        ];
    }
}
