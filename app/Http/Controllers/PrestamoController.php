<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use App\Models\Prestamo;
use App\Http\Requests\PrestamoRequest;
use Illuminate\Http\Request;

class PrestamoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Prestamo::with('persona');


        // Filtros específicos
        if ($request->filled('persona')) {
            $query->whereHas('persona', function ($q) use ($request) {
                $q->where('nombre', 'LIKE', "%{$request->persona}%")
                    ->orWhere('apellido', 'LIKE', "%{$request->persona}%");
            });
        }

        if ($request->filled('barrio')) {
            $query->where('barrio', 'LIKE', "%{$request->barrio}%");
        }

        if ($request->filled('estado')) {
            $estado = $request->estado === 'activo' ? true : false;
            $query->where('estado', $estado);
        }

        if ($request->filled('monto_min')) {
            $query->where('monto_prestado', '>=', $request->monto_min);
        }

        if ($request->filled('monto_max')) {
            $query->where('monto_prestado', '<=', $request->monto_max);
        }

        // Ordenamiento
        $sortBy = $request->get('sort_by', 'numeracion');
        $sortOrder = $request->get('sort_order', 'asc');
        $query->orderBy($sortBy, $sortOrder);

        $prestamos = $query->paginate(15);

        // Obtener barrios únicos para el filtro
        $barrios = Prestamo::distinct()->pluck('barrio')->sort()->filter();

        return view('prestamos.index', compact('prestamos', 'barrios'));
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
        $model->actualizarConNuevoMonto($validated);
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
