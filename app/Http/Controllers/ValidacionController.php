<?php

namespace App\Http\Controllers;

use App\Http\Requests\Validacion\ValidacionFotoRequest;
use App\Services\ValidacionFoto\ValidadorFoto;
use Illuminate\Support\Facades\Storage;

class ValidacionController extends Controller
{
    public function validarFoto(ValidacionFotoRequest $request)
    {
        $path = $request->file('foto')->store('tmp/validaciones');

        $absolutePath = Storage::path($path);

        $validador = new ValidadorFoto();
        $resultados = $validador->validar($absolutePath);

        $aprobado = collect($resultados)->every(fn ($r) => $r['ok']);

        if ($aprobado) {
            Storage::move($path, 'fotos/' . basename($path));
        }

        return back()->with([
            'validacion' => [
                'aprobado' => $aprobado,
                'resultados' => $resultados,
            ],
        ]);
    }
}