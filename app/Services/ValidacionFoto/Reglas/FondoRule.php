<?php

namespace App\Services\ValidacionFoto\Reglas;

class FondoRule
{
    protected int $borde = 30;
    protected int $step = 10;

    // Umbrales calibrados
    protected float $minBrillo = 0.72;
    protected float $maxSaturacion = 0.30;

    protected float $maxVarianzaLum = 420;
    protected float $maxEdgeRatio = 0.12;

    public function key(): string
    {
        return 'fondo';
    }

    public function check(string $path): array
    {
        $img = imagecreatefromjpeg($path);
        $w = imagesx($img);
        $h = imagesy($img);

        $pixels = [];
        $lums = [];

        // 🔹 Muestreo de bordes
        for ($x = $this->borde; $x < $w - $this->borde; $x += $this->step) {
            $this->sample($img, $x, 25, $pixels, $lums);
            $this->sample($img, $x, 45, $pixels, $lums);
        }

        for ($y = $this->borde; $y < $h * 0.45; $y += $this->step) {
            $this->sample($img, 25, $y, $pixels, $lums);
            $this->sample($img, $w - 25, $y, $pixels, $lums);
        }

        imagedestroy($img);

        if (count($pixels) < 20) {
            return $this->fail('No se pudo evaluar el fondo');
        }

        // 1️⃣ Claridad
        $claros = array_filter($pixels, fn($p) => $p['v'] >= $this->minBrillo);
        $ratioClaro = count($claros) / count($pixels);

        // 2️⃣ Saturación
        $neutros = array_filter($pixels, fn($p) => $p['s'] <= $this->maxSaturacion);
        $ratioNeutro = count($neutros) / count($pixels);

        // 3️⃣ Varianza real
        $avgLum = array_sum($lums) / count($lums);
        $varLum = array_sum(array_map(
            fn($v) => pow($v - $avgLum, 2),
            $lums
        )) / count($lums);

        // 4️⃣ Bordes (gradiente simple)
        $edges = 0;
        for ($i = 1; $i < count($lums); $i++) {
            if (abs($lums[$i] - $lums[$i - 1]) > 55) {
                $edges++;
            }
        }
        $edgeRatio = $edges / count($lums);

        // 🧠 Decisión por consenso
        $pasa = 0;
        if ($ratioClaro >= 0.85) $pasa++;
        if ($ratioNeutro >= 0.85) $pasa++;
        if ($varLum <= $this->maxVarianzaLum) $pasa++;
        if ($edgeRatio <= $this->maxEdgeRatio) $pasa++;

        $ok = $pasa >= 3;

        return [
            'key' => 'fondo',
            'label' => 'Fondo claro, neutro y uniforme',
            'ok' => $ok,
            'mensaje' => $ok ? null : $this->mensaje($ratioClaro, $ratioNeutro, $varLum, $edgeRatio),
        ];
    }

    protected function sample($img, int $x, int $y, array &$pixels, array &$lums): void
    {
        $rgb = imagecolorat($img, $x, $y);
        $r = ($rgb >> 16) & 0xFF;
        $g = ($rgb >> 8) & 0xFF;
        $b = $rgb & 0xFF;

        [, $s, $v] = $this->rgbToHsv($r, $g, $b);
        $lum = 0.299 * $r + 0.587 * $g + 0.114 * $b;

        $pixels[] = compact('s', 'v');
        $lums[] = $lum;
    }

    protected function rgbToHsv(int $r, int $g, int $b): array
    {
        $r /= 255; $g /= 255; $b /= 255;
        $max = max($r, $g, $b);
        $min = min($r, $g, $b);
        $delta = $max - $min;

        $h = 0;
        if ($delta > 0) {
            if ($max === $r) $h = 60 * fmod((($g - $b) / $delta), 6);
            elseif ($max === $g) $h = 60 * ((($b - $r) / $delta) + 2);
            else $h = 60 * ((($r - $g) / $delta) + 4);
        }
        if ($h < 0) $h += 360;

        $s = $max == 0 ? 0 : $delta / $max;
        $v = $max;

        return [$h, $s, $v];
    }

    protected function fail(string $msg): array
    {
        return [
            'key' => 'fondo',
            'label' => 'Fondo',
            'ok' => false,
            'mensaje' => $msg,
        ];
    }

    protected function mensaje($c, $n, $v, $e): string
    {
        return sprintf(
            'Fondo inválido (claridad %.0f%%, neutralidad %.0f%%, varianza %.0f, bordes %.0f%%)',
            $c * 100,
            $n * 100,
            $v,
            $e * 100
        );
    }
}