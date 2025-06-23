@extends('layouts.main')
@section('title', 'Crear Pago')
@section('contenidossss')
<div class="container"><br>
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-user-plus me-2"></i>
                        <h5 class="mb-0">Crear Pago a {{ $prestamo->persona->nombre }} {{ $prestamo->persona->apellido }}</h5>
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

                    <form action="{{ route('pagos.store') }}" method="post">
                        @csrf

                        <input type="hidden" name="id_prestamo" value="{{ $prestamo->id }}">
                        <input type="hidden" name="id_persona" value="{{ $prestamo->id_persona }}">

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nombre" class="form-label">
                                    <i class="fas fa-user me-1"></i>Monto abonado
                                </label>
                                <input type="number"
                                    name="monto_pagado"
                                    id="monto_pagado"
                                    class="form-control @error('monto_pagado') is-invalid @enderror"
                                    value="{{ $prestamo->cuota }}"
                                    placeholder="Ingresa el monto abonado"
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
                                       value="{{ old('fecha_pago', date('Y-m-d')) }}"
                                       required>
                                @error('fecha_pago')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Botones de Acción -->
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="{{ route('prestamos.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left me-1"></i>Cancelar
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i>Guardar Pago
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
    }

    @media (min-width: 769px) {
        .card {
            border-radius: 10px;
        }

        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
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
        border-color: #007bff;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.15);
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
</style>
@endsection