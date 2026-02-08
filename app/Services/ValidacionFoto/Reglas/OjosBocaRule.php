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

        // Zona donde debe estar el rostro
        $x1 = (int)($width * 0.30);
        $x2 = (int)($width * 0.70);
        $y1 = (int)($height * 0.18);
        $y2 = (int)($height * 0.80);

        $total = 0;
        $contraste = 0;

        $left = 0;
        $right = 0;

        $zonaOjos = 0;
        $zonaBoca = 0;

        for ($x = $x1; $x < $x2; $x += 6) {
            for ($y = $y1; $y < $y2; $y += 6) {
                $rgb = imagecolorat($img, $x, $y);
                $r = ($rgb >> 16) & 0xFF;
                $g = ($rgb >> 8) & 0xFF;
                $b = $rgb & 0xFF;

                // luminancia perceptual
                $lum = 0.299 * $r + 0.587 * $g + 0.114 * $b;

                if ($lum < 215) {
                    $contraste++;

                    if ($x < $width / 2) $left++;
                    else $right++;

                    if ($y < $height * 0.45) $zonaOjos++;
                    if ($y > $height * 0.55 && $y < $height * 0.75) $zonaBoca++;
                }

                $total++;
            }
        }

        imagedestroy($img);

        $ratio = $contraste / $total;
        $simetria = min($left, $right) / max($left, $right, 1);

        $ok =
            $ratio >= 0.18 &&        // hay rostro
            $ratio <= 0.60 &&        // no es fondo dominante
            $simetria >= 0.65 &&     // rostro centrado
            $zonaOjos > 30 &&        // ojos presentes
            $zonaBoca > 25;          // boca presente

        return [
            'key' => 'ojos_boca',
            'label' => 'Rostro visible (ojos y boca)',
            'ok' => $ok,
            'mensaje' => $ok
                ? null
                : $this->mensaje($ratio, $simetria, $zonaOjos, $zonaBoca),
        ];
    }

    protected function mensaje($ratio, $simetria, $ojos, $boca): string
    {
        if ($ratio < 0.18) {
            return 'No se detecta suficiente contraste facial';
        }

        if ($simetria < 0.65) {
            return 'El rostro no está centrado';
        }

        if ($ojos < 30) {
            return 'No se detecta claramente la zona de los ojos';
        }

        if ($boca < 25) {
            return 'No se detecta claramente la boca';
        }

        return 'El rostro no cumple las condiciones requeridas';
    }
}
