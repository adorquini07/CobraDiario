@extends('layouts.main')
@section('title', 'Resumen de Cobranzas')
@section('contenidossss')

<div class="container"><br>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <!-- Tarjetas de Resumen -->
            <div class="row mb-4">
                <div class="col-md-4 mb-3">
                    <div class="card shadow-sm border-primary">
                        <div class="card-header bg-primary text-white">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-money-bill-wave me-2"></i>
                                <h6 class="mb-0">A Recoger Hoy</h6>
                            </div>
                        </div>
                        <div class="card-body text-center">
                            <h3 class="text-primary fw-bold">${{ number_format($recogerHoy, 0, ',', '.') }}</h3>
                            <small class="text-muted">{{ count($cobrarHoy) }} préstamos por cobrar</small>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4 mb-3">
                    <div class="card shadow-sm border-success">
                        <div class="card-header bg-success text-white">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-check-circle me-2"></i>
                                <h6 class="mb-0">Recaudado Hoy</h6>
                            </div>
                        </div>
                        <div class="card-body text-center">
                            <h3 class="text-success fw-bold">${{ number_format($abonadoHoy, 0, ',', '.') }}</h3>
                            <small class="text-muted">
                                @if($recogerHoy > 0)
                                    {{ number_format(($abonadoHoy / $recogerHoy) * 100, 1) }}% del objetivo
                                @else
                                    Meta cumplida
                                @endif
                            </small>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4 mb-3">
                    <div class="card shadow-sm border-warning">
                        <div class="card-header bg-warning text-dark">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-clock me-2"></i>
                                <h6 class="mb-0">Pendiente</h6>
                            </div>
                        </div>
                        <div class="card-body text-center">
                            <h3 class="text-warning fw-bold">${{ number_format($recogerHoy - $abonadoHoy, 0, ',', '.') }}</h3>
                            <small class="text-muted">
                                @if($recogerHoy > 0)
                                    {{ count($cobrarHoy) - $cobrarHoy->filter(function($prestamo) { return $prestamo->getPagoHoy(); })->count() }} préstamos pendientes
                                @else
                                    Sin pendientes
                                @endif
                            </small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Préstamos por cobrar hoy -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-info text-white">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-list me-2"></i>
                        <h5 class="mb-0">Préstamos por Cobrar Hoy</h5>
                    </div>
                </div>
                <div class="card-body p-4">
                    @if(count($cobrarHoy) > 0)
                        <!-- Vista de escritorio -->
                        <div class="d-none d-lg-block">
                            <div class="table-responsive">
                                <table class="table table-bordered table-sm">
                                    <thead>
                                        <tr class="text-center">
                                            <th>Cliente</th>
                                            <th>Monto Prestado</th>
                                            <th>Cuota</th>
                                            <th>Abonado</th>
                                            <th>Debe</th>
                                            <th>Dirección</th>
                                            <th>Barrio</th>
                                            <th>Estado</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($cobrarHoy as $prestamo)
                                        <tr class="text-center">
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 35px; height: 35px;">
                                                        {{ strtoupper(substr($prestamo->persona->nombre, 0, 1)) }}
                                                    </div>
                                                    <div>
                                                        <div class="fw-bold">{{ $prestamo->persona->nombre }}</div>
                                                        <small class="text-muted">{{ $prestamo->persona->telefono }}</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>${{ number_format($prestamo->monto_prestado, 0, ',', '.') }}</td>
                                            <td>${{ number_format($prestamo->cuota, 0, ',', '.') }}</td>
                                            <td>${{ number_format($prestamo->abonado, 0, ',', '.') }}</td>
                                            <td>${{ number_format($prestamo->monto_apagar - $prestamo->abonado, 0, ',', '.') }}</td>
                                            <td>{{ $prestamo->direccion }}</td>
                                            <td>{{ $prestamo->barrio }}</td>
                                            <td>
                                                @if($prestamo->getPagoHoy())
                                                    <span class="badge bg-success">
                                                        <i class="fas fa-check me-1"></i>Pagado
                                                    </span>
                                                @else
                                                    <span class="badge bg-warning text-dark">
                                                        <i class="fas fa-clock me-1"></i>Pendiente
                                                    </span>
                                                @endif
                                            </td>
                                            <td>
                                                @if(!$prestamo->getPagoHoy())
                                                    <a href="{{ route('pagos.create', $prestamo->id) }}" class="btn btn-success btn-sm">
                                                        <i class="fas fa-money-bill-wave"></i> Registrar Pago
                                                    </a>
                                                @else
                                                    <span class="text-muted">Ya pagado</span>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        
                        <!-- Vista móvil -->
                        <div class="d-lg-none">
                            @foreach($cobrarHoy as $prestamo)
                            <div class="card mb-3 border-info">
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-2">
                                        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 40px; height: 40px;">
                                            {{ strtoupper(substr($prestamo->persona->nombre, 0, 1)) }}
                                        </div>
                                        <div>
                                            <div class="fw-bold">{{ $prestamo->persona->nombre }}</div>
                                            <small class="text-muted">{{ $prestamo->persona->telefono }}</small>
                                        </div>
                                    </div>
                                    
                                    <div class="row text-center">
                                        <div class="col-6">
                                            <small class="text-muted">Monto Prestado:</small>
                                            <div class="fw-bold">${{ number_format($prestamo->monto_prestado, 0, ',', '.') }}</div>
                                        </div>
                                        <div class="col-6">
                                            <small class="text-muted">Cuota:</small>
                                            <div class="fw-bold">${{ number_format($prestamo->cuota, 0, ',', '.') }}</div>
                                        </div>
                                        <div class="col-6 mt-2">
                                            <small class="text-muted">Abonado:</small>
                                            <div class="fw-bold">${{ number_format($prestamo->abonado, 0, ',', '.') }}</div>
                                        </div>
                                        <div class="col-6 mt-2">
                                            <small class="text-muted">Debe:</small>
                                            <div class="fw-bold">${{ number_format($prestamo->monto_apagar - $prestamo->abonado, 0, ',', '.') }}</div>
                                        </div>
                                        <div class="col-6 mt-2">
                                            <small class="text-muted">Dirección:</small>
                                            <div class="fw-bold">{{ $prestamo->direccion }}</div>
                                        </div>
                                        <div class="col-6 mt-2">
                                            <small class="text-muted">Barrio:</small>
                                            <div class="fw-bold">{{ $prestamo->barrio }}</div>
                                        </div>
                                        <div class="col-6 mt-2">
                                            <small class="text-muted">Estado:</small>
                                            <div>
                                                @if($prestamo->getPagoHoy())
                                                    <span class="badge bg-success">
                                                        <i class="fas fa-check me-1"></i>Pagado
                                                    </span>
                                                @else
                                                    <span class="badge bg-warning text-dark">
                                                        <i class="fas fa-clock me-1"></i>Pendiente
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    
                                    @if(!$prestamo->getPagoHoy())
                                    <div class="text-center mt-3">
                                        <a href="{{ route('pagos.create', $prestamo->id) }}" class="btn btn-success btn-sm">
                                            <i class="fas fa-money-bill-wave"></i> Registrar Pago
                                        </a>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-check-circle fa-3x text-success mb-3"></i>
                            <h5 class="text-success">¡Excelente!</h5>
                            <p class="text-muted">No hay préstamos por cobrar hoy. Todos los pagos están al día.</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Pagos realizados hoy -->
            <div class="card shadow-sm">
                <div class="card-header bg-success text-white">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-history me-2"></i>
                        <h5 class="mb-0">Pagos Realizados Hoy</h5>
                    </div>
                </div>
                <div class="card-body p-4">
                    @php
                        $pagosHoy = \App\Models\Pago::where('fecha_pago', date('Y-m-d'))->with(['persona', 'prestamo'])->get();
                    @endphp
                    
                    @if(count($pagosHoy) > 0)
                        <!-- Vista de escritorio -->
                        <div class="d-none d-lg-block">
                            <div class="table-responsive">
                                <table class="table table-bordered table-sm">
                                    <thead>
                                        <tr class="text-center">
                                            <th>Cliente</th>
                                            <th>Monto Pagado</th>
                                            <th>Hora</th>
                                            <th>Préstamo</th>
                                            <th>Debe</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($pagosHoy as $pago)
                                        <tr class="text-center">
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 35px; height: 35px;">
                                                        {{ strtoupper(substr($pago->persona->nombre, 0, 1)) }}
                                                    </div>
                                                    <div>
                                                        <div class="fw-bold">{{ $pago->persona->nombre }}</div>
                                                        <small class="text-muted">{{ $pago->persona->telefono }}</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="fw-bold text-success">${{ number_format($pago->monto_pagado, 0, ',', '.') }}</td>
                                            <td>{{ \Carbon\Carbon::parse($pago->created_at)->format('H:i') }}</td>
                                            <td>${{ number_format($pago->prestamo->monto_prestado, 0, ',', '.') }}</td>
                                            <td>${{ number_format($pago->prestamo->monto_apagar - $pago->prestamo->abonado, 0, ',', '.') }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        
                        <!-- Vista móvil -->
                        <div class="d-lg-none">
                            @foreach($pagosHoy as $pago)
                            <div class="card mb-2 border-success">
                                <div class="card-body p-2">
                                    <div class="d-flex align-items-center mb-2">
                                        <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 35px; height: 35px;">
                                            {{ strtoupper(substr($pago->persona->nombre, 0, 1)) }}
                                        </div>
                                        <div>
                                            <div class="fw-bold">{{ $pago->persona->nombre }}</div>
                                            <small class="text-muted">{{ $pago->persona->telefono }}</small>
                                        </div>
                                    </div>
                                    <div class="row text-center">
                                        <div class="col-6">
                                            <small class="text-muted">Monto:</small>
                                            <div class="fw-bold text-success">${{ number_format($pago->monto_pagado, 0, ',', '.') }}</div>
                                        </div>
                                        <div class="col-6">
                                            <small class="text-muted">Hora:</small>
                                            <div>{{ \Carbon\Carbon::parse($pago->created_at)->format('H:i') }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                            <p class="text-muted">No hay pagos registrados hoy</p>
                            <small class="text-muted">Los pagos realizados aparecerán aquí</small>
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
    .btn {
        padding: 12px 20px;
        font-size: 16px;
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
