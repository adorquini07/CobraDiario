@extends('layouts.main')
@section('title', 'Cobros de Hoy')
@section('contenidossss')
<div class="container"><br>
    <div class="row justify-content-center">
        <div class="col-md-10 col-lg-8">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-success text-white">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-calendar-day me-2"></i>
                        <h5 class="mb-0">Personas a cobrar hoy</h5>
                    </div>
                </div>
                <div class="card-body p-4">
                    @if ($cobrarHoy->count())
                    <!-- Vista de escritorio (tabla) -->
                    <div class="d-none d-lg-block">
                        <div class="table-responsive">
                            <table class="table table-bordered table-sm">
                                <thead>
                                    <tr class="text-center">
                                        <th>Persona</th>
                                        <th>Celular</th>
                                        <th>Dirección</th>
                                        <th>Cuota</th>
                                        <th>Estado</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cobrarHoy as $prestamo)
                                    <tr class="text-center">
                                        <td>{{ $prestamo->persona->nombre }} {{ $prestamo->persona->apellido }}</td>
                                        <td>{{ $prestamo->persona->telefono }}</td>
                                        <td>{{ $prestamo->persona->direccion }}</td>
                                        <td>${{ number_format($prestamo->cuota, 0, ',', '.') }}</td>
                                        <td>
                                            <span class="badge {{ $prestamo->estado ? 'bg-success' : 'bg-secondary' }}">
                                                {{ $prestamo->estado ? 'Activo' : 'Pagado' }}
                                            </span>
                                        </td>
                                        <td>
                                            <a href="{{ route('prestamos.show', $prestamo->id) }}" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                                            @if ($prestamo->estado && !$prestamo->getPagoHoy())
                                            <a href="{{ route('pagos.create', $prestamo->id) }}" class="btn btn-success btn-sm"><i class="fas fa-money-bill-wave"></i></a>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- Vista móvil (cards) -->
                    <div class="d-lg-none">
                        @foreach ($cobrarHoy as $prestamo)
                        <div class="card mb-3 border-success">
                            <div class="card-header bg-success text-white">
                                <h6 class="mb-0">{{ $prestamo->persona->nombre }} {{ $prestamo->persona->apellido }}</h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <small class="text-muted">Celular:</small>
                                        <div class="fw-bold">{{ $prestamo->persona->telefono }}</div>
                                    </div>
                                    <div class="col-6">
                                        <small class="text-muted">Dirección:</small>
                                        <div class="fw-bold">{{ $prestamo->persona->direccion }}</div>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-6">
                                        <small class="text-muted">Cuota:</small>
                                        <div class="fw-bold">${{ number_format($prestamo->cuota, 0, ',', '.') }}</div>
                                    </div>
                                    <div class="col-6">
                                        <small class="text-muted">Estado:</small>
                                        <div>
                                            <span class="badge {{ $prestamo->estado ? 'bg-success' : 'bg-secondary' }}">
                                                {{ $prestamo->estado ? 'Activo' : 'Pagado' }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-3 d-grid gap-2 d-md-flex">
                                    <a href="{{ route('prestamos.show', $prestamo->id) }}" class="btn btn-info btn-sm flex-fill">
                                        <i class="fas fa-eye"></i> Detalle
                                    </a>
                                    @if ($prestamo->estado && !$prestamo->getPagoHoy())
                                    <a href="{{ route('pagos.create', $prestamo->id) }}" class="btn btn-success btn-sm flex-fill">
                                        <i class="fas fa-money-bill-wave"></i> Abonar
                                    </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <div class="text-center py-4">
                        <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                        <p class="text-muted">No hay personas a cobrar hoy</p>
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