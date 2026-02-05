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

        // Zona facial realista
        $x1 = (int)($width * 0.30);
        $x2 = (int)($width * 0.70);
        $y1 = (int)($height * 0.20);
        $y2 = (int)($height * 0.65);

        $pixelesOscuros = 0;
        $total = 0;

        for ($x = $x1; $x < $x2; $x += 5) {
            for ($y = $y1; $y < $y2; $y += 5) {
                $rgb = imagecolorat($img, $x, $y);

                $r = ($rgb >> 16) & 0xFF;
                $g = ($rgb >> 8) & 0xFF;
                $b = $rgb & 0xFF;

                $lum = ($r + $g + $b) / 3;

                if ($lum < 200) {
                    $pixelesOscuros++;
                }

                $total++;
            }
        }

        imagedestroy($img);

        $ratio = $pixelesOscuros / max(1, $total);

        $ok = $ratio >= 0.10 && $ratio <= 0.50;

        return [
            'key' => 'ojos_boca',
            'label' => 'Rostro visible (ojos y boca)',
            'ok' => $ok,
            'mensaje' => $ok
                ? null
                : 'El rostro no está correctamente centrado o no es visible',
            'detalle' => $ok
                ? null
                : 'Contraste facial detectado: ' . round($ratio * 100, 1) . '%',
        ];
    }
}
