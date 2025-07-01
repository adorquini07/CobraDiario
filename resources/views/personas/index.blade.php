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
                            <table class="table table-hover table-bordered align-middle shadow-sm">
                                <thead class="table-primary">
                                    <tr class="text-center align-middle">
                                        <th><i class="fas fa-user"></i> Nombre</th>
                                        <th><i class="fas fa-user-tag"></i> Apellido</th>
                                        <th><i class="fas fa-id-card"></i> Cédula</th>
                                        <th><i class="fas fa-mobile-alt"></i> Celular</th>
                                        <th><i class="fas fa-map-marker-alt"></i> Dirección</th>
                                        <th><i class="fas fa-map-marker-alt"></i> Barrio</th>
                                        <th><i class="fas fa-cogs"></i> Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($personas as $persona)
                                    <tr class="text-center align-middle">
                                        <td class="fw-bold text-primary">{{ $persona->nombre }}</td>
                                        <td>{{ $persona->apellido }}</td>
                                        <td><span class="badge bg-info text-dark">{{ $persona->nuip }}</span></td>
                                        <td><a href="tel:{{ $persona->telefono }}" class="text-decoration-none text-success"><i class="fas fa-phone-alt"></i> {{ $persona->telefono }}</a></td>
                                        <td><span class="text-secondary">{{ $persona->direccion }}</span></td>
                                        <td><span class="text-secondary">{{ $persona->barrio }}</span></td>
                                        <td>
                                            <div class="d-flex justify-content-center gap-1 flex-wrap">
                                                <a href="{{ route('personas.edit', $persona->id) }}" class="btn btn-warning btn-sm" title="Editar"><i class="fas fa-pencil-alt"></i></a>
                                                <form action="{{ route('personas.destroy', $persona->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar esta persona?')" title="Eliminar"><i class="fas fa-trash-alt"></i></button>
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
                                <div class="row">
                                    <div class="col-6">
                                        <small class="text-muted">Dirección:</small>
                                        <div class="fw-bold">{{ $persona->direccion }}</div>
                                    </div>
                                    <div class="col-6">
                                        <small class="text-muted">Barrio:</small>
                                        <div class="fw-bold">{{ $persona->barrio }}</div>
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
            </div>
        </div>
    </div>
</div>
@endsection