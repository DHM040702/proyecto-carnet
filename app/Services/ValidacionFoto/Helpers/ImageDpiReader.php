<?php

namespace App\Services\ValidacionFoto\Helpers;

class ImageDpiReader
{
    
    protected function getDpiFromJfif(string $path): ?int
    {
        $fp = @fopen($path, 'rb');
        if (!$fp) {
            return null;
        }

        // Leer primeros 20 bytes (suficiente para APP0)
        $data = fread($fp, 20);
        fclose($fp);

        if (strlen($data) < 14) {
            return null;
        }

        // Buscar marcador JFIF
        if (substr($data, 6, 5) !== "JFIF\0") {
            return null;
        }

        // Byte de unidad
        $unit = ord($data[11]);

        // Densidades (big endian)
        $xDensity = unpack('n', substr($data, 12, 2))[1];
        $yDensity = unpack('n', substr($data, 14, 2))[1];

        if ($xDensity === 0) {
            return null;
        }

        // Unidad 1 = DPI
        if ($unit === 1) {
            return $xDensity;
        }

        // Unidad 2 = DPCM → convertir a DPI
        if ($unit === 2) {
            return (int) round($xDensity * 2.54);
        }

        return null;
    }


    public static function getDpi(string $path): ?int
    {
        $fp = @fopen($path, 'rb');
        if (!$fp) {
            return null;
        }

        // Saltar SOI (FF D8)
        fread($fp, 2);

        // Leer marcador APP0
        $marker = fread($fp, 2);
        if ($marker !== "\xFF\xE0") {
            fclose($fp);
            return null;
        }

        // Longitud del segmento
        $lengthData = fread($fp, 2);
        $length = unpack('n', $lengthData)[1];

        // Leer contenido APP0
        $data = fread($fp, $length - 2);
        fclose($fp);

        // Validar JFIF
        if (substr($data, 0, 5) !== "JFIF\0") {
            return null;
        }

        // Offset CORRECTO
        $unit = ord($data[7]);

        $xDensity = unpack('n', substr($data, 8, 2))[1];
        $yDensity = unpack('n', substr($data, 10, 2))[1];

        if ($xDensity === 0) {
            return null;
        }

        // Unidad 1 = DPI
        if ($unit === 1) {
            return $xDensity;
        }

        // Unidad 2 = DPCM → DPI
        if ($unit === 2) {
            return (int) round($xDensity * 2.54);
        }

        return null;
    }

    protected static function fromExif(string $path): ?int
    {
        if (!function_exists('exif_read_data')) {
            return null;
        }

        $exif = @exif_read_data($path);
        if (!$exif || empty($exif['XResolution'])) {
            return null;
        }

        $xRes = $exif['XResolution'];

        // Formato "300/1"
        if (is_string($xRes) && str_contains($xRes, '/')) {
            [$num, $den] = array_map('intval', explode('/', $xRes));
            return $den > 0 ? (int) round($num / $den) : null;
        }

        // Formato [300,1]
        if (is_array($xRes) && count($xRes) === 2 && $xRes[1] > 0) {
            return (int) round($xRes[0] / $xRes[1]);
        }

        // Numérico directo
        return is_numeric($xRes) ? (int) round($xRes) : null;
    }

    protected static function fromJfif(string $path): ?int
    {
        $info = @getimagesize($path, $details);
        if (!$info || empty($details['jfif_unit']) || empty($details['jfif_density'])) {
            return null;
        }

        [$dx, $dy] = $details['jfif_density'];

        // Unidad: 1 = DPI
        if ($details['jfif_unit'] === 1) {
            return (int) round($dx);
        }

        // Unidad: 2 = DPCM → convertir a DPI
        if ($details['jfif_unit'] === 2) {
            return (int) round($dx * 2.54);
        }

        return null;
    }
}
