<?php

namespace App\Http\Controllers;

use App\Models\Escuela;
use Illuminate\Http\Request;
use Inertia\Inertia;

class EscuelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filters = $request->only('search');

        $escuelas = Escuela::query()
            ->with('Facultad')
            ->when($filters['search'] ?? null, function ($q, $search) {
                $q->where('escuela', 'like', "%{$search}%");
            })
            ->orderBy('escuela', 'asc')
            ->paginate(5)
            ->withQueryString();

        return Inertia::render('admin/escuela/EscuelaIndex', [
            'escuelas' => $escuelas,
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
    public function store(Request $request)
    {
        $data = $request->validate([
            'escuela' => 'required|string|max:255',
            'facultad_id' => 'required|exists:facultades,id',
        ]);

        $data['usercreacion'] = auth()->id();

        Escuela::create($data);

        return back()->with([
            'success' => 'Escuela creada correctamente',
            'toast_id' => now()->timestamp,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Escuela $escuela)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Escuela $escuela)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Escuela $escuela)
    {
        $data = $request->validate([
            'escuela' => 'required|string|max:255',
            'facultad_id' => 'required|exists:facultades,id',
        ]);

        $escuela->update($data);

        return back()->with([
            'success' => 'Escuela actualizada correctamente',
            'toast_id' => now()->timestamp,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Escuela $escuela)
    {
        $escuela->delete();

        return back()->with([
            'success' => 'Escuela eliminada correctamente',
            'toast_id' => now()->timestamp,
        ]);
    }
}
