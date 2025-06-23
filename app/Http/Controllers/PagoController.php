<?php

namespace App\Http\Controllers;

use App\Models\Pago;
use App\Models\Prestamo;
use App\Http\Requests\PagoRequest;

class PagoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(int $id_prestamo)
    {
        $prestamo = Prestamo::findOrFail($id_prestamo);
        return view('pagos.create', compact('prestamo'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PagoRequest $request)
    {
        $validated = $request->validated();
        Prestamo::crearPago($validated);
        return redirect()->route('prestamos.index')->with('success', 'Pago creado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $cobrarHoy = Prestamo::CobrarHoy();
        return view('pagos.show', compact('cobrarHoy'));
    }

    public function showResumen()
    {
        $abonadoHoy = Pago::getAbonadoHoy();
        $recogerHoy = Prestamo::RecogerHoy();
        $cobrarHoy = Prestamo::CobrarHoy();

        return view('pagos.resumen', compact('abonadoHoy', 'recogerHoy', 'cobrarHoy'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pago $pago)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PagoRequest $request, Pago $pago)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pago $pago)
    {
        //
    }
}
