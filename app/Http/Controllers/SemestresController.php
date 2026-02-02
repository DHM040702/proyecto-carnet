<?php

namespace App\Http\Controllers;

use App\Http\Requests\Semestre\StoreSemestreRequest;
use App\Http\Requests\Semestre\UpdateSemestreRequest;
use App\Models\semestre;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SemestresController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filters = $request->only('search');

        $semestres = Semestre::query()
            ->when(
                $filters['search'] ?? null,
                fn($q, $search) =>
                $q->where('semestre', 'like', "%{$search}%")
            )
            ->orderBy('fecha_inicio', 'desc')
            ->paginate(5)
            ->withQueryString();

        return Inertia::render('admin/semestre/SemestreIndex', [
            'semestres' => $semestres,
            'filters' => $filters,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSemestreRequest  $request)
    {
        dd($request);
        Semestre::create([
            ...$request->validated(),
            'usercreacion' => auth()->id(),
        ]);

        return back()->with([
            'success' => 'Semestre creado correctamente',
            'toast_id' => now()->timestamp,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(semestre $semestres)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(semestre $semestres)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSemestreRequest  $request, Semestre $semestre)
    {
        $semestre->update($request->validated());

        return back()->with([
            'success' => 'Semestre actualizado correctamente',
            'toast_id' => now()->timestamp,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Semestre $semestre)
    {
        $semestre->delete();
        return back()->with('success', 'Semestre eliminado correctamente');
    }
}
