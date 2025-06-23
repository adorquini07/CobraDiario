@extends('layouts.main')
@section('title', 'Personas')
@section('contenidossss')
<div class="container"><br>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                        <h5 class="mb-0">Listado de Personas</h5>
                        <div class="d-flex justify-content-end gap-2 flex-wrap">
                            <a href="{{ route('personas.create') }}" class="btn btn-success btn-sm">Crear Persona</a>
                            <a href="{{ route('prestamos.index') }}" class="btn btn-primary btn-sm">Prestamos</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @if (session('info'))
                    <div class="alert alert-success">
                        {{ session('info') }}
                    </div>
                    @endif

                    <!-- Vista de escritorio (tabla) -->
                    <div class="d-none d-lg-block">
                        <div class="table-responsive">
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
                                        <td>
                                            <div class="d-flex justify-content-center gap-1 flex-wrap">
                                                <a href="{{ route('personas.edit', $persona->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-pencil-alt"></i></a>
                                                <form action="{{ route('personas.destroy', $persona->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar esta persona?')"><i class="fas fa-trash-alt"></i></button>
                                                </form>
                                            </div>
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
                    </div>

                    <!-- Vista móvil (cards) -->
                    <div class="d-lg-none">
                        @forelse ($personas as $persona)
                        <div class="card mb-3 border-primary">
                            <div class="card-header bg-primary text-white">
                                <h6 class="mb-0">{{ $persona->nombre . ' ' . $persona->apellido }}</h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <small class="text-muted">Cédula:</small>
                                        <div class="fw-bold">{{ $persona->nuip }}</div>
                                    </div>
                                    <div class="col-6">
                                        <small class="text-muted">Celular:</small>
                                        <div class="fw-bold">{{ $persona->telefono }}</div>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-12">
                                        <small class="text-muted">Dirección:</small>
                                        <div class="fw-bold">{{ $persona->direccion }}</div>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <div class="d-grid gap-2 d-md-flex">
                                        <a href="{{ route('personas.edit', $persona->id) }}" class="btn btn-warning btn-sm flex-fill">
                                            <i class="fas fa-edit"></i> Editar
                                        </a>
                                        <form action="{{ route('personas.destroy', $persona->id) }}" method="POST" class="flex-fill">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger btn-sm w-100" onclick="return confirm('¿Estás seguro de eliminar esta persona?')">
                                                <i class="fas fa-trash"></i> Eliminar
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="text-center py-4">
                            <i class="fas fa-users fa-3x text-muted mb-3"></i>
                            <p class="text-muted">No hay personas registradas</p>
                        </div>
                        @endforelse
                    </div>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                        <small class="text-muted">Bienvenido {{ Auth::user()->name }}</small>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm">Cerrar sesión</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection