@extends('layouts.main')
@section('title', 'Personas')
@section('contenidossss')
<div class="container"><br>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        Listado de Personas
                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('personas.create') }}" class="btn btn-success btn-sm float-end">Crear Persona</a>
                            <a href="{{ route('prestamos.index') }}" class="btn btn-primary btn-sm float-end">Prestamos</a>
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
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Cédula</th>
                                <th>Celular</th>
                                <th>Dirección</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($personas as $persona)
                            <tr class="text-center">
                                <td>{{ $persona->nombre }}</td>
                                <td>{{ $persona->apellido }}</td>
                                <td>{{ $persona->nuip }}</td>
                                <td>{{ $persona->telefono }}</td>
                                <td>{{ $persona->direccion }}</td>
                                <td class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('personas.edit', $persona->id) }}" class="btn btn-warning btn-sm">Editar</a>
                                    <form action="{{ route('personas.destroy', $persona->id) }}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center">No hay personas</td>
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