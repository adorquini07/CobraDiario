<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use App\Models\Prestamo;
use App\Http\Requests\PrestamoRequest;

class PrestamoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $prestamos = Prestamo::orderBy('id', 'desc')->get();
        return view('prestamos.index', compact('prestamos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $personas = Persona::all();
        return view('prestamos.create', compact('personas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PrestamoRequest $request)
    {
        $validated = $request->validated();
        $model = new Prestamo();
        $model->fill($validated);
        assert($model->guardarPrestamo());
        return redirect()->route('prestamos.index')->with('info', 'Prestamo creado exitosamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $prestamo = Prestamo::findOrFail($id);
        return view('prestamos.show', compact('prestamo'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $prestamo = Prestamo::findOrFail($id);
        return view('prestamos.edit', compact('prestamo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PrestamoRequest $request, int $id)
    {
        $validated = $request->validated();
        $model = Prestamo::findOrFail($id);
        $model->fill($validated);
        assert($model->guardarPrestamo());
        return redirect()->route('prestamos.index')->with('info', 'Prestamo actualizado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $model = Prestamo::findOrFail($id);
        assert($model->delete());
        return redirect()->route('prestamos.index')->with('info', 'Prestamo eliminado exitosamente');
    }
}
