@extends('layouts.main')
@section('title', 'Crear Persona')
@section('contenidossss')
<div class="container"><br>
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-user-plus me-2"></i>
                        <h5 class="mb-0">Crear Nueva Persona</h5>
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

                    <form action="{{ route('personas.store') }}" method="post">
                        @csrf

                        <!-- Información Personal -->
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nombre" class="form-label">
                                    <i class="fas fa-user me-1"></i>Nombres
                                </label>
                                <input type="text"
                                    name="nombre"
                                    id="nombre"
                                    class="form-control @error('nombre') is-invalid @enderror"
                                    value="{{ old('nombre') }}"
                                    placeholder="Ingresa los nombres"
                                    required>
                                @error('nombre')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="apellido" class="form-label">
                                    <i class="fas fa-user me-1"></i>Apellidos
                                </label>
                                <input type="text"
                                    name="apellido"
                                    id="apellido"
                                    class="form-control @error('apellido') is-invalid @enderror"
                                    value="{{ old('apellido') }}"
                                    placeholder="Ingresa los apellidos"
                                    required>
                                @error('apellido')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Información de Contacto -->
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nuip" class="form-label">
                                    <i class="fas fa-id-card me-1"></i>Cédula
                                </label>
                                <input type="text"
                                    name="nuip"
                                    id="nuip"
                                    class="form-control @error('nuip') is-invalid @enderror"
                                    value="{{ old('nuip') }}"
                                    placeholder="Ingresa el número de cédula"
                                    required>
                                @error('nuip')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="telefono" class="form-label">
                                    <i class="fas fa-phone me-1"></i>Celular
                                </label>
                                <input type="tel"
                                    name="telefono"
                                    id="telefono"
                                    class="form-control @error('telefono') is-invalid @enderror"
                                    value="{{ old('telefono') }}"
                                    placeholder="Ingresa el número de celular"
                                    required>
                                @error('telefono')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Barrio -->

                        <div class="mb-4">
                            <label for="barrio" class="form-label">
                                <i class="fas fa-map-marker-alt me-1"></i>Barrio
                            </label>
                            <input type="text" name="barrio" id="barrio" class="form-control @error('barrio') is-invalid @enderror" value="{{ old('barrio') }}" placeholder="Ingresa el barrio" required>
                            @error('barrio')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Dirección -->
                        <div class="mb-4">
                            <label for="direccion" class="form-label">
                                <i class="fas fa-map-marker-alt me-1"></i>Dirección
                            </label>
                            <textarea name="direccion"
                                id="direccion"
                                class="form-control @error('direccion') is-invalid @enderror"
                                rows="3"
                                placeholder="Ingresa la dirección completa"
                                required>{{ old('direccion') }}</textarea>
                            @error('direccion')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Campo oculto para estado (siempre activo en creación) -->
                        <input type="hidden" name="estado" value="1">

                        <!-- Botones de Acción -->
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="{{ route('personas.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left me-1"></i>Cancelar
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i>Guardar Persona
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