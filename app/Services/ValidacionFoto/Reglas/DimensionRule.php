<?php

namespace App\Services\ValidacionFoto\Reglas;

use App\Services\ValidacionFoto\Helpers\ImageDpiReader;
class DimensionRule
{
    protected int $ancho = 240;
    protected int $alto = 288;

    // tamaño físico esperado en cm
    protected float $anchoCm = 2.03;
    protected float $altoCm  = 2.44;

    protected int $dpiEsperado = 300;
    protected int $toleranciaPx = 2;
    protected int $toleranciaDpi = 10;

    public function check(string $path): array
    {
        [$width, $height] = getimagesize($path);

        $okDimensiones =
            abs($width - $this->ancho) <= $this->toleranciaPx &&
            abs($height - $this->alto) <= $this->toleranciaPx;

        // DPI calculado (NO leído)
        $dpiX = $this->calcularDpi($width, $this->anchoCm);
        $dpiY = $this->calcularDpi($height, $this->altoCm);

        $okDpi =
            abs($dpiX - $this->dpiEsperado) <= $this->toleranciaDpi &&
            abs($dpiY - $this->dpiEsperado) <= $this->toleranciaDpi;

        $ok = $okDimensiones && $okDpi;

        return [
            'key' => 'dimensiones',
            'label' => 'Dimensiones y resolución (240x288 ≈300 DPI)',
            'ok' => $ok,
            'mensaje' => $ok
                ? null
                : $this->buildMensaje($width, $height, $dpiX, $dpiY),
        ];
    }

    protected function calcularDpi(int $px, float $cm): int
    {
        return (int) round(($px / $cm) * 2.54);
    }

    protected function buildMensaje(int $w, int $h, int $dpiX, int $dpiY): string
    {
        $errores = [];

        if ($w !== $this->ancho || $h !== $this->alto) {
            $errores[] = "Dimensiones inválidas: {$w}x{$h}px";
        }

        if (
            abs($dpiX - $this->dpiEsperado) > $this->toleranciaDpi ||
            abs($dpiY - $this->dpiEsperado) > $this->toleranciaDpi
        ) {
            $errores[] = "Resolución inválida: {$dpiX}x{$dpiY} DPI";
        }

        return implode(' | ', $errores);
    }
}