<?php

namespace App\Services\ValidacionFoto;

use App\Services\ValidacionFoto\Reglas\{
    PesoRule,
    DimensionRule,
    FormatoRule,
    FondoRule,
    OjosBocaRule
};

class ValidadorFoto
{
    protected array $reglas;

    public function __construct()
    {
        $this->reglas = [
            new FormatoRule(),
            new PesoRule(),
            new DimensionRule(),
            new FondoRule(),
            new OjosBocaRule(),
        ];
    }

    public function validar(string $path): array
    {
        $resultados = [];

        foreach ($this->reglas as $regla) {
            $res = $regla->check($path);
            $resultados[] = $res;

            if (! $res['ok']) {
                break; // validación paso a paso
            }
        }

        return $resultados;
    }
}
