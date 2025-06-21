@extends('layouts.main')
@section('title', 'Prestamos')
@section('contenidossss')
<div class="container"><br>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                        <h5 class="mb-0">Listado de Prestamos</h5>
                        <div class="d-flex justify-content-end gap-2 flex-wrap">
                            <a href="{{ route('prestamos.create') }}" class="btn btn-success btn-sm">Crear Prestamo</a>
                            <a href="{{ route('personas.index') }}" class="btn btn-primary btn-sm">Personas</a>
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
                                        <th>Persona</th>
                                        <th>Monto Prestado</th>
                                        <th>Monto a Pagar</th>
                                        <th>Cuota</th>
                                        <th>Abonado</th>
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
                                        <td>{{ number_format($prestamo->abonado, 0, ',', '.') }}</td>
                                        <td>{{ $prestamo->fecha_prestamo }}</td>
                                        <td>{{ $prestamo->diasApagar() }}</td>
                                        <td>
                                            <span class="badge {{ $prestamo->estado ? 'bg-success' : 'bg-secondary' }}">
                                                {{ $prestamo->estado ? 'Activo' : 'Pagado' }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center gap-1 flex-wrap">
                                                <a href="{{ route('pagos.create', $prestamo->id) }}" class="btn btn-success btn-sm">Abonar</a>
                                                <a href="{{ route('prestamos.edit', $prestamo->id) }}" class="btn btn-warning btn-sm">Editar</a>
                                                <form action="{{ route('prestamos.destroy', $prestamo->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar este préstamo?')">Eliminar</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="8" class="text-center">No hay prestamos</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="d-lg-none">
                        @forelse ($prestamos as $prestamo)
                        <div class="card mb-3 border-primary">
                            <div class="card-header bg-primary text-white">
                                <h6 class="mb-0">{{ $prestamo->persona->nombre . ' ' . $prestamo->persona->apellido }}</h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <small class="text-muted">Monto Prestado:</small>
                                        <div class="fw-bold">${{ number_format($prestamo->monto_prestado, 0, ',', '.') }}</div>
                                    </div>
                                    <div class="col-6">
                                        <small class="text-muted">Monto a Pagar:</small>
                                        <div class="fw-bold">${{ number_format($prestamo->monto_apagar, 0, ',', '.') }}</div>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-6">
                                        <small class="text-muted">Cuota:</small>
                                        <div class="fw-bold">${{ number_format($prestamo->cuota, 0, ',', '.') }}</div>
                                    </div>
                                    <div class="col-6">
                                        <small class="text-muted">Abonado:</small>
                                        <div class="fw-bold">${{ number_format($prestamo->abonado, 0, ',', '.') }}</div>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-6">
                                        <small class="text-muted">Días a Pagar:</small>
                                        <div class="fw-bold">{{ $prestamo->diasApagar() }}</div>
                                    </div>
                                    <div class="col-6">
                                        <small class="text-muted">Fecha:</small>
                                        <div class="fw-bold">{{ $prestamo->fecha_prestamo }}</div>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-6">
                                        <small class="text-muted">Estado:</small>
                                        <div>
                                            <span class="badge {{ $prestamo->estado ? 'bg-success' : 'bg-secondary' }}">
                                                {{ $prestamo->estado ? 'Activo' : 'Pagado' }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <div class="d-grid gap-2 d-md-flex">
                                        <a href="{{ route('pagos.create', $prestamo->id) }}" class="btn btn-success btn-sm flex-fill">
                                            <i class="fas fa-money-bill-wave"></i> Abonar
                                        </a>
                                        <a href="{{ route('prestamos.edit', $prestamo->id) }}" class="btn btn-warning btn-sm flex-fill">
                                            <i class="fas fa-edit"></i> Editar
                                        </a>
                                        <form action="{{ route('prestamos.destroy', $prestamo->id) }}" method="POST" class="flex-fill">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger btn-sm w-100" onclick="return confirm('¿Estás seguro de eliminar este préstamo?')">
                                                <i class="fas fa-trash"></i> Eliminar
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="text-center py-4">
                            <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                            <p class="text-muted">No hay prestamos registrados</p>
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