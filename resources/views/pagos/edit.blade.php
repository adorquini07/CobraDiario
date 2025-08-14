@extends('layouts.main')
@section('title', 'Editar Pago')
@section('contenidossss')
<div class="container"><br>
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow-sm">
                <div class="card-header bg-warning text-dark">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-edit me-2"></i>
                        <h5 class="mb-0">Editar Pago de {{ $prestamo->persona->nombre }} {{ $prestamo->persona->apellido }}</h5>
                    </div>
                </div>
                <div class="card-body p-4">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            <strong>Por favor corrige los siguientes errores:</strong>
                        </div>
                        <ul class="mb-0 mt-2">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <!-- Información del préstamo -->
                    <div class="alert alert-info mb-4">
                        <div class="row">
                            <div class="col-md-6">
                                <small class="text-muted">Monto Prestado:</small>
                                <div class="fw-bold">${{ number_format($prestamo->monto_prestado, 0, ',', '.') }}</div>
                            </div>
                            <div class="col-md-6">
                                <small class="text-muted">Cuota:</small>
                                <div class="fw-bold">${{ number_format($prestamo->cuota, 0, ',', '.') }}</div>
                            </div>
                        </div>
                    </div>

                    <form action="{{ route('pagos.update', $pago->id) }}" method="post">
                        @csrf
                        @method('PUT')

                        <input type="hidden" name="id_prestamo" value="{{ $prestamo->id }}">
                        <input type="hidden" name="id_persona" value="{{ $prestamo->id_persona }}">

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="monto_pagado" class="form-label">
                                    <i class="fas fa-money-bill-wave me-1"></i>Monto abonado
                                </label>
                                <input type="number"
                                    name="monto_pagado"
                                    id="monto_pagado"
                                    class="form-control @error('monto_pagado') is-invalid @enderror"
                                    value="{{ old('monto_pagado', $pago->monto_pagado) }}"
                                    placeholder="Ingresa el monto abonado"
                                    step="0.01"
                                    min="0"
                                    required>
                                @error('monto_pagado')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="fecha_pago" class="form-label">
                                    <i class="fas fa-calendar me-1"></i>Fecha de pago
                                </label>
                                <input type="date"
                                       name="fecha_pago"
                                       id="fecha_pago"
                                       class="form-control @error('fecha_pago') is-invalid @enderror"
                                       value="{{ old('fecha_pago', $pago->fecha_pago) }}"
                                       required>
                                @error('fecha_pago')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Información adicional del pago -->
                        <div class="alert alert-light border">
                            <div class="row">
                                <div class="col-md-6">
                                    <small class="text-muted">Pago registrado el:</small>
                                    <div class="fw-bold">{{ $pago->created_at->format('d/m/Y H:i') }}</div>
                                </div>
                                <div class="col-md-6">
                                    <small class="text-muted">Última modificación:</small>
                                    <div class="fw-bold">{{ $pago->updated_at->format('d/m/Y H:i') }}</div>
                                </div>
                            </div>
                        </div>

                        <!-- Botones de Acción -->
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="{{ route('prestamos.show', $prestamo->id) }}" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left me-1"></i>Cancelar
                            </a>
                            <button type="submit" class="btn btn-warning">
                                <i class="fas fa-save me-1"></i>Actualizar Pago
                            </button>
                        </div>
                    </form>
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

        .form-control {
            padding: 12px;
            font-size: 16px;
            /* Evita zoom en iOS */
        }

        .btn {
            padding: 12px 20px;
            font-size: 16px;
        }

        .d-grid.gap-2.d-md-flex {
            grid-template-columns: 1fr 1fr;
            gap: 10px !important;
        }

        .alert {
            margin-bottom: 15px;
        }
    }

    @media (min-width: 769px) {
        .card {
            border-radius: 10px;
        }

        .form-control:focus {
            border-color: #ffc107;
            box-shadow: 0 0 0 0.2rem rgba(255, 193, 7, 0.25);
        }

        .btn:hover {
            transform: translateY(-1px);
            transition: transform 0.2s ease;
        }
    }

    .form-control {
        border-radius: 8px;
        border: 2px solid #e9ecef;
        transition: all 0.3s ease;
    }

    .form-control:focus {
        border-color: #ffc107;
        box-shadow: 0 0 0 0.2rem rgba(255, 193, 7, 0.15);
    }

    .card-header {
        border-radius: 10px 10px 0 0 !important;
    }

    .alert {
        border-radius: 8px;
        border: none;
    }

    .btn {
        border-radius: 8px;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .alert-info {
        background-color: #d1ecf1;
        border-color: #bee5eb;
        color: #0c5460;
    }

    .alert-light {
        background-color: #f8f9fa;
        border-color: #dee2e6;
        color: #495057;
    }
</style>
@endsection

