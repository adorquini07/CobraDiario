@extends('layouts.main')
@section('contenidossss')
<div class="container"><br>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Listado de Personas
                    <a href="{{ route('personas.create') }}" class="btn btn-success btn-sm float-end">Crear Persona</a>
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
                            @foreach ($personas as $persona)
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
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    Bienbenido {{ Auth::user()->name }}
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm float-end">Cerrar sesión</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection