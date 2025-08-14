@extends('layouts.main')
@section('title', 'Detalle del Préstamo')
@section('contenidossss')
<div class="container"><br>
    <div class="row justify-content-center">
        <div class="col-md-10 col-lg-8">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-info text-white">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-eye me-2"></i>
                        <h5 class="mb-0">Detalle del Préstamo</h5>
                    </div>
                </div>
                <div class="card-body p-4">
                    <div class="mb-3">
                        <h6 class="fw-bold mb-1">Persona:</h6>
                        <div>{{ $prestamo->persona->nombre }} {{ $prestamo->persona->apellido }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-6 col-md-4">
                            <small class="text-muted">Monto Prestado:</small>
                            <div class="fw-bold">${{ number_format($prestamo->monto_prestado, 0, ',', '.') }}</div>
                        </div>
                        <div class="col-6 col-md-4">
                            <small class="text-muted">Monto a Pagar:</small>
                            <div class="fw-bold">${{ number_format($prestamo->monto_apagar, 0, ',', '.') }}</div>
                        </div>
                        <div class="col-6 col-md-4 mt-3 mt-md-0">
                            <small class="text-muted">Abonado:</small>
                            <div class="fw-bold">${{ number_format($prestamo->abonado, 0, ',', '.') }}</div>
                        </div>
                        <div class="col-6 col-md-4 mt-3">
                            <small class="text-muted">Cuota:</small>
                            <div class="fw-bold">${{ number_format($prestamo->cuota, 0, ',', '.') }}</div>
                        </div>
                        <div class="col-6 col-md-4 mt-3">
                            <small class="text-muted">Fecha de Préstamo:</small>
                            <div class="fw-bold">{{ $prestamo->fecha_prestamo }}</div>
                        </div>
                        <div class="col-6 col-md-4 mt-3">
                            <small class="text-muted">Dirección:</small>
                            <div class="fw-bold">{{ $prestamo->direccion }}</div>
                        </div>
                        <div class="col-6 col-md-4 mt-3">
                            <small class="text-muted">Barrio:</small>
                            <div class="fw-bold">{{ $prestamo->barrio }}</div>
                        </div>
                        <div class="col-6 col-md-4 mt-3">
                            <small class="text-muted">Días a Pagar:</small>
                            <div class="fw-bold">{{ $prestamo->diasApagar() }}</div>
                        </div>
                        <div class="col-6 col-md-4 mt-3">
                            <small class="text-muted">Estado:</small>
                            <div>
                                <span class="badge {{ $prestamo->estado ? 'bg-success' : 'bg-secondary' }}">
                                    {{ $prestamo->estado ? 'Activo' : 'Pagado' }}
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex gap-2 flex-wrap mt-3">
                        @if ($prestamo->estado && !$prestamo->getPagoHoy())
                        <a href="{{ route('pagos.create', $prestamo->id) }}" class="btn btn-success btn-sm">
                            <i class="fas fa-money-bill-wave"></i> Abonar
                        </a>
                        @endif
                        <a href="{{ route('prestamos.edit', $prestamo->id) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i> Editar
                        </a>
                        <a href="{{ route('prestamos.index') }}" class="btn btn-outline-secondary btn-sm">
                            <i class="fas fa-arrow-left"></i> Volver
                        </a>
                    </div>
                </div>
            </div>

            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-list me-2"></i>
                        <h6 class="mb-0">Pagos realizados</h6>
                    </div>
                </div>
                <div class="card-body p-4">
                    @if ($prestamo->pagos->count())
                    <!-- Vista de escritorio -->
                    <div class="d-none d-lg-block">
                        <div class="table-responsive">
                            <table class="table table-bordered table-sm">
                                <thead>
                                    <tr class="text-center">
                                        <th>#</th>
                                        <th>Monto Pagado</th>
                                        <th>Fecha de Pago</th>
                                        <th>Registrado</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($prestamo->pagos as $i => $pago)
                                    <tr class="text-center {{ $pago->monto_pagado == 0 ? 'bg-danger text-white' : 'bg-success text-white' }}">
                                        <td>{{ $i + 1 }}</td>
                                        <td>${{ number_format($pago->monto_pagado, 0, ',', '.') }}</td>
                                        <td>{{ $pago->fecha_pago }}</td>
                                        <td>{{ $pago->created_at->format('d/m/Y H:i') }}</td>
                                        <td>
                                            <div class="btn-group btn-group-sm" role="group">
                                                <a href="{{ route('pagos.edit', $pago->id) }}"
                                                    class="btn btn-warning btn-sm"
                                                    title="Editar pago">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('pagos.destroy', $pago->id) }}"
                                                    method="POST"
                                                    class="d-inline"
                                                    onsubmit="return confirm('¿Estás seguro de que quieres eliminar este pago?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="btn btn-danger btn-sm"
                                                        title="Eliminar pago">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- Vista móvil -->
                    <div class="d-lg-none">
                        @foreach ($prestamo->pagos as $i => $pago)
                        <div class="card mb-2 border-primary {{ $pago->monto_pagado == 0 ? 'border-danger' : 'border-success' }}">
                            <div class="card-body p-2">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="fw-bold">Pago #{{ $i + 1 }}</span>
                                    <span class="badge bg-primary">${{ number_format($pago->monto_pagado, 0, ',', '.') }}</span>
                                </div>
                                <div class="mt-2">
                                    <small class="text-muted">Fecha de Pago:</small>
                                    <div>{{ $pago->fecha_pago }}</div>
                                </div>
                                <div>
                                    <small class="text-muted">Registrado:</small>
                                    <div>{{ $pago->created_at->format('d/m/Y H:i') }}</div>
                                </div>
                                <!-- Acciones móviles -->
                                <div class="mt-3 d-flex gap-2">
                                    <a href="{{ route('pagos.edit', $pago->id) }}"
                                        class="btn btn-warning btn-sm flex-fill">
                                        <i class="fas fa-edit me-1"></i>Editar
                                    </a>
                                    <form action="{{ route('pagos.destroy', $pago->id) }}"
                                        method="POST"
                                        class="flex-fill"
                                        onsubmit="return confirm('¿Estás seguro de que quieres eliminar este pago?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm w-100">
                                            <i class="fas fa-trash me-1"></i>Eliminar
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <div class="text-center py-4">
                        <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                        <p class="text-muted">No hay pagos registrados para este préstamo</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    @media (max-width: 768px) {
        .container {
            padding-left: 15px;
            padding-right: 15px;
        }

        .card-body {
            padding: 20px !important;
        }

        .form-label {
            font-weight: 600;
            margin-bottom: 8px;
        }

        .btn {
            padding: 12px 20px;
            font-size: 16px;
        }

        .d-grid.gap-2.d-md-flex {
            grid-template-columns: 1fr 1fr;
            gap: 10px !important;
        }
    }

    @media (min-width: 769px) {
        .card {
            border-radius: 10px;
        }

        .btn:hover {
            transform: translateY(-1px);
            transition: transform 0.2s ease;
        }
    }

    .card-header {
        border-radius: 10px 10px 0 0 !important;
    }

    .btn {
        border-radius: 8px;
        font-weight: 500;
        transition: all 0.3s ease;
    }
</style>
@endsection