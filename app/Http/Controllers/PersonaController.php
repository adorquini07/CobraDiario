<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePersonaRequest;
use App\Models\Persona;

class PersonaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $personas = Persona::all();
        return view('personas.index', compact('personas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('personas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePersonaRequest $request)
    {
        $validated = $request->validated();
        $model = new Persona();
        $model->fill($validated);
        assert($model->save());
        return redirect()->route('personas.index')->with('info', 'Persona creada exitosamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $persona = Persona::findOrFail($id);
        return view('personas.edit', compact('persona'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StorePersonaRequest $request, int $id)
    {
        $validated = $request->validated();
        $persona = Persona::findOrFail($id);
        $persona->fill($validated);
        assert($persona->save());
        return redirect()->route('personas.index')->with('info', 'Persona actualizada exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $persona = Persona::findOrFail($id);
        assert($persona->delete());
        return redirect()->route('personas.index')->with('info', 'Persona eliminada exitosamente');
    }
}
