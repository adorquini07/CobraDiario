<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePersonaRequest;
use App\Http\Requests\UpdatePersonaRequest;
use App\Models\Persona;
use App\Models\Prestamo;
use Illuminate\Http\Request;

class PersonaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Persona::query();

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

        if ($request->filled('estado')) {
            $query->where('estado', $request->estado);
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
        $model->estado = 1; // Siempre activo en creación
        $model->observaciones = null; // Siempre null en creación
        
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
        $prestamosActivos = Prestamo::where('id_persona', $persona->id)
                                   ->where('estado', 1)
                                   ->count();
        return view('personas.edit', compact('persona', 'prestamosActivos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePersonaRequest $request, int $id)
    {
        $validated = $request->validated();
        $persona = Persona::findOrFail($id);
        
        // Guardar el estado anterior para comparar
        $estadoAnterior = $persona->estado;
        
        $persona->fill($validated);
        $persona->barrio = mb_strtoupper($persona->barrio);
        
        // Si el estado es activo, limpiar las observaciones
        if ($validated['estado'] == 1) {
            $persona->observaciones = null;
        }
        
        // Si la persona se está inactivando (cambiando de activo a inactivo)
        if ($estadoAnterior == 1 && $validated['estado'] == 0) {
            // Inactivar todos los préstamos de la persona
            Prestamo::where('id_persona', $persona->id)
                   ->where('estado', 1) // Solo los préstamos activos
                   ->update(['estado' => 0]);
        }
        
        assert($persona->save());
        
        $mensaje = 'Persona actualizada exitosamente';
        if ($estadoAnterior == 1 && $validated['estado'] == 0) {
            $mensaje .= ' y todos sus préstamos han sido inactivados';
        }
        
        return redirect()->route('personas.index')->with('info', $mensaje);
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
