@extends('layouts.main')
@section('title', 'Prestamos')
@section('contenidossss')
<div class="container"><br>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        Listado de Prestamos
                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('prestamos.create') }}" class="btn btn-success btn-sm float-end">Crear Prestamo</a>
                            <a href="{{ route('personas.index') }}" class="btn btn-primary btn-sm float-end">Personas</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @if (session('info'))
                    <div class="alert alert-success">
                        {{ session('info') }}
                    </div>
                    @endif
                    <table class="table table-bordered table-sm">
                        <thead>
                            <tr class="text-center">
                                <th>Persona</th>
                                <th>Monto Prestado</th>
                                <th>Monto a Pagar</th>
                                <th>Cuota</th>
                                <th>Fecha de Prestamo</th>
                                <th>Días a Pagar</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($prestamos as $prestamo)
                            <tr class="text-center">
                                <td>{{ $prestamo->persona->nombre . ' ' . $prestamo->persona->apellido  }}</td>
                                <td>{{ number_format($prestamo->monto_prestado, 0, ',', '.') }}</td>
                                <td>{{ number_format($prestamo->monto_apagar, 0, ',', '.') }}</td>
                                <td>{{ number_format($prestamo->cuota, 0, ',', '.') }}</td>
                                <td>{{ $prestamo->fecha_prestamo }}</td>
                                <td>{{ $prestamo->diasApagar() }}</td>
                                <td>{{ $prestamo->estado ? 'Activo' : 'Inactivo' }}</td>
                                <td class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('prestamos.edit', $prestamo->id) }}" class="btn btn-warning btn-sm">Editar</a>
                                    <form action="{{ route('prestamos.destroy', $prestamo->id) }}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center">No hay prestamos</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    <iv class="d-flex justify-content-between">
                        Bienvenido {{ Auth::user()->name }}
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm float-end">Cerrar sesión</button>
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection