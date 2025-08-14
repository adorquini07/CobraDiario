<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePersonaRequest;
use App\Models\Persona;
use Illuminate\Http\Request;

class PersonaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Persona::query();
        
        // Filtros dinámicos
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nombre', 'LIKE', "%{$search}%")
                  ->orWhere('apellido', 'LIKE', "%{$search}%")
                  ->orWhere('nuip', 'LIKE', "%{$search}%")
                  ->orWhere('telefono', 'LIKE', "%{$search}%")
                  ->orWhere('direccion', 'LIKE', "%{$search}%")
                  ->orWhere('barrio', 'LIKE', "%{$search}%");
            });
        }
        
        // Filtros específicos
        if ($request->filled('nombre')) {
            $query->where('nombre', 'LIKE', "%{$request->nombre}%");
        }
        
        if ($request->filled('apellido')) {
            $query->where('apellido', 'LIKE', "%{$request->apellido}%");
        }
        
        if ($request->filled('nuip')) {
            $query->where('nuip', 'LIKE', "%{$request->nuip}%");
        }
        
        if ($request->filled('telefono')) {
            $query->where('telefono', 'LIKE', "%{$request->telefono}%");
        }
        
        if ($request->filled('barrio')) {
            $query->where('barrio', 'LIKE', "%{$request->barrio}%");
        }
        
        // Ordenamiento
        $sortBy = $request->get('sort_by', 'nombre');
        $sortOrder = $request->get('sort_order', 'asc');
        $query->orderBy($sortBy, $sortOrder);
        
        $personas = $query->paginate(15);
        
        // Obtener barrios únicos para el filtro
        $barrios = Persona::distinct()->pluck('barrio')->sort()->filter();
        
        return view('personas.index', compact('personas', 'barrios'));
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
        $model->barrio = mb_strtoupper($model->barrio);
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
        $persona->barrio = mb_strtoupper($persona->barrio);
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
