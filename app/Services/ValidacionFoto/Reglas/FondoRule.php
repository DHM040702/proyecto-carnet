<?php

namespace App\Services\ValidacionFoto\Reglas;

class FondoRule
{
    public function key(): string
    {
        return 'fondo';
    }

    public function check(string $path): array
    {
        $img = imagecreatefromjpeg($path);
        $width = imagesx($img);
        $height = imagesy($img);

        $samples = [];
        $step = 12;

        // Zonas seguras
        for ($x = 30; $x < $width - 30; $x += $step) {
            $samples[] = imagecolorat($img, $x, 25);
            $samples[] = imagecolorat($img, $x, 40);
        }

        for ($y = 30; $y < $height * 0.45; $y += $step) {
            $samples[] = imagecolorat($img, 25, $y);
            $samples[] = imagecolorat($img, $width - 25, $y);
        }

        $lums = [];

        foreach ($samples as $rgb) {
            $r = ($rgb >> 16) & 0xFF;
            $g = ($rgb >> 8) & 0xFF;
            $b = $rgb & 0xFF;

            $lums[] = 0.299 * $r + 0.587 * $g + 0.114 * $b;
        }

        imagedestroy($img);

        $count = count($lums);
        $avg = array_sum($lums) / $count;

        // desviación estándar
        $variance = array_reduce($lums, function ($carry, $v) use ($avg) {
            return $carry + pow($v - $avg, 2);
        }, 0) / $count;

        $stdDev = sqrt($variance);
        $saltos = 0;

        // cambios bruscos
        for ($i = 2; $i < $count; $i++) {
            $d1 = abs($lums[$i] - $lums[$i - 1]);
            $d2 = abs($lums[$i - 1] - $lums[$i - 2]);

            if ($d1 > 65 && $d2 > 65) {
                $saltos++;
            }
        }

        $ratioSaltos = $saltos / $count;

        $ok =
            $avg >= 185 &&        // fondo claro
            $stdDev <= 85 &&      // gradiente suave permitido
            $ratioSaltos <= 0.18; // sin sombras duras

        return [
            'key' => 'fondo',
            'label' => 'Fondo claro y uniforme',
            'ok' => $ok,
            'mensaje' => $ok
                ? null
                : $this->mensajeError($avg, $stdDev, $ratioSaltos),
        ];
    }

    protected function mensajeError($avg, $stdDev, $ratioSaltos): string
    {
        if ($avg < 185) {
            return 'El fondo no es suficientemente claro';
        }

        if ($ratioSaltos > 0.18) {
            return 'Se detectan sombras fuertes en el fondo';
        }

        if ($stdDev > 32) {
            return 'El fondo presenta ligeras variaciones de iluminación';
        }

        return 'El fondo no cumple las condiciones requeridas';
    }
}
