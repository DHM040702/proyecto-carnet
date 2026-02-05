<?php

namespace App\Services\ValidacionFoto\Reglas;

use App\Services\ValidacionFoto\Helpers\ImageDpiReader;

class DimensionRule
{
    protected int $ancho = 240;
    protected int $alto = 288;
    protected int $dpiEsperado = 300;
    protected int $toleranciaPx = 2;

    public function key(): string
    {
        return 'dimensiones';
    }

    public function check(string $path): array
    {
        [$width, $height] = getimagesize($path);

        $okDimensiones =
            abs($width - $this->ancho) <= $this->toleranciaPx &&
            abs($height - $this->alto) <= $this->toleranciaPx;

        // 🔹 DPI
        $dpi = ImageDpiReader::getDpi($path);
        $okDpi = $dpi === 300;


        $ok = $okDimensiones && $okDpi;

        return [
            'key' => 'dimensiones',
            'label' => 'Dimensiones y resolución (240x288 @300 DPI)',
            'ok' => $ok,
            'mensaje' => $ok
                ? null
                : $this->buildMensaje($width, $height, $dpi),
        ];
    }

    protected function getDpi(string $path): ?int
    {
        // 1️⃣ EXIF
        if (function_exists('exif_read_data')) {
            $exif = @exif_read_data($path);
            if ($exif && !empty($exif['XResolution'])) {
                $xRes = $exif['XResolution'];

                if (is_string($xRes) && str_contains($xRes, '/')) {
                    [$num, $den] = array_map('intval', explode('/', $xRes));
                    if ($den > 0) return (int) round($num / $den);
                }

                if (is_array($xRes) && count($xRes) === 2 && $xRes[1] > 0) {
                    return (int) round($xRes[0] / $xRes[1]);
                }

                if (is_numeric($xRes)) {
                    return (int) round($xRes);
                }
            }
        }

        // 2️⃣ JFIF (fallback)
        $info = @getimagesize($path, $details);
        if (!empty($details['jfif_unit']) && !empty($details['jfif_density'])) {
            $unit = $details['jfif_unit'];
            [$dx, $dy] = $details['jfif_density'];

            // unidad 1 = DPI, unidad 2 = DPCM
            if ($unit === 1) {
                return (int) round($dx);
            }

            if ($unit === 2) {
                return (int) round($dx * 2.54);
            }
        }

        return null;
    }

    protected function buildMensaje(int $w, int $h, ?int $dpi): string
    {
        $errores = [];

        if ($w !== $this->ancho || $h !== $this->alto) {
            $errores[] = "Dimensiones inválidas: {$w}x{$h}px";
        }

        if ($dpi === null) {
            $errores[] = 'Resolución no detectada (DPI no definido)';
        } elseif ($dpi !== $this->dpiEsperado) {
            $errores[] = "Resolución inválida: {$dpi} DPI";
        }

        return implode(' | ', $errores);
    }
}
