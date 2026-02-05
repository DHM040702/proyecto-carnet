<?php

namespace App\Services\ValidacionFoto\Reglas;

class OjosBocaRule
{
    public function key(): string
    {
        return 'ojos_boca';
    }

    public function check(string $path): array
    {
        $img = imagecreatefromjpeg($path);
        $width = imagesx($img);
        $height = imagesy($img);

        // Zona central donde DEBE estar el rostro
        $x1 = (int)($width * 0.25);
        $x2 = (int)($width * 0.75);
        $y1 = (int)($height * 0.15);
        $y2 = (int)($height * 0.85);

        $pixelesOscuros = 0;
        $total = 0;

        // muestreo de la zona central
        for ($x = $x1; $x < $x2; $x += 5) {
            for ($y = $y1; $y < $y2; $y += 5) {
                $rgb = imagecolorat($img, $x, $y);

                $r = ($rgb >> 16) & 0xFF;
                $g = ($rgb >> 8) & 0xFF;
                $b = $rgb & 0xFF;

                $luminosidad = ($r + $g + $b) / 3;

                // piel / cabello / ojos ≠ fondo claro
                if ($luminosidad < 200) {
                    $pixelesOscuros++;
                }

                $total++;
            }
        }

        imagedestroy($img);

        $ratio = $pixelesOscuros / $total;

        // umbral empírico
        $ok = $ratio >= 0.15 && $ratio <= 0.45;

        return [
            'key' => 'ojos_boca',
            'label' => 'Rostro visible (ojos y boca)',
            'ok' => false,
            'mensaje' => 'El rostro no está centrado o está parcialmente oculto',
            'detalle' => 'Contraste facial insuficiente',
        ];
    }
}
