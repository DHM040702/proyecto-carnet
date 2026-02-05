<?php

namespace App\Http\Controllers;

use App\Http\Requests\Facultad\StoreFacultadRequest;
use App\Http\Requests\Facultad\UpdateFacultadRequest;
use App\Models\Facultad;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Inertia\Inertia;

class FacultadesController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filters = $request->only('search');

        $facultades = Facultad::query()
            ->when($filters['search'] ?? null, function ($q, $search) {
                $q->where('facultad', 'like', "%{$search}%")
                    ->orWhere('abreviatura', 'like', "%{$search}%");
            })
            ->orderBy('facultad', 'asc')
            ->paginate(5)
            ->withQueryString();

        return Inertia::render('admin/facultad/FacultadIndex', [
            'facultades' => $facultades,
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
    public function store(StoreFacultadRequest $request)
    {
        $data = $request->validated();

        $data['usercreacion'] = auth()->id();

        Facultad::create($data);

        return back()->with([
            'success' => 'Facultad creada correctamente',
            'toast_id' => now()->timestamp,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Facultad $facultad)
    {
        return Inertia::render('admin/facultad/FacultadShow', [
            'facultad' => $facultad,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Facultad $facultad)
    {
        return Inertia::render('admin/facultad/FacultadEdit', [
            'facultad' => $facultad,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFacultadRequest $request, Facultad $facultad)
    {
        $data = $request->validated();

        $facultad->update($data);

        return back()->with([
            'success' => 'Facultad actualizada correctamente',
            'toast_id' => now()->timestamp,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Facultad $facultad)
    {
        $facultad->delete();

        return back()->with([
            'success' => 'Facultad eliminada correctamente',
            'toast_id' => now()->timestamp,
        ]);
    }
}
