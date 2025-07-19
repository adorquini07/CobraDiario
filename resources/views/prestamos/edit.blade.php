@extends('layouts.main')
@section('title', 'Editar Prestamo')
@section('contenidossss')
<div class="container"><br>
    <div class="row justify-content-center">
        <div class="col-md-10 col-lg-8">
            <div class="card shadow-sm">
                <div class="card-header bg-warning text-dark">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-edit me-2"></i>
                        <h5 class="mb-0">Editar Préstamo</h5>
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
                    
                    <form action="{{ route('prestamos.update', $prestamo->id) }}" method="post">
                        @method('put')
                        @csrf
                        
                        <!-- Información del Préstamo -->
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="id_persona" class="form-label">
                                    <i class="fas fa-user me-1"></i>Persona
                                </label>
                                <input type="text" 
                                       name="id" 
                                       id="id" 
                                       class="form-control bg-light" 
                                       value="{{ $prestamo->persona->nombre . ' ' . $prestamo->persona->apellido }}" 
                                       disabled>
                                <input type="hidden" name="id_persona" id="id_persona" value="{{ $prestamo->id_persona }}">
                                <small class="text-muted">
                                    <i class="fas fa-info-circle me-1"></i>La persona no se puede cambiar
                                </small>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="monto_prestado" class="form-label">
                                    <i class="fas fa-dollar-sign me-1"></i>Monto Prestado
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="number" 
                                           name="monto_prestado" 
                                           id="monto_prestado" 
                                           class="form-control @error('monto_prestado') is-invalid @enderror"
                                           value="{{ old('monto_prestado', $prestamo->monto_prestado) }}"
                                           placeholder="Ingresa el monto"
                                           min="0"
                                           step="1000"
                                           required>
                                </div>
                                @error('monto_prestado')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <!-- Cuota y Fecha -->
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="cuota" class="form-label">
                                    <i class="fas fa-coins me-1"></i>Cuota
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="number" 
                                           name="cuota" 
                                           id="cuota" 
                                           class="form-control @error('cuota') is-invalid @enderror"
                                           value="{{ old('cuota', $prestamo->cuota) }}"
                                           placeholder="Ingresa la cuota"
                                           min="0"
                                           step="1000"
                                           required>
                                </div>
                                @error('cuota')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="fecha_prestamo" class="form-label">
                                    <i class="fas fa-calendar me-1"></i>Fecha de Préstamo
                                </label>
                                <input type="date" 
                                       name="fecha_prestamo" 
                                       id="fecha_prestamo" 
                                       class="form-control @error('fecha_prestamo') is-invalid @enderror"
                                       value="{{ old('fecha_prestamo', $prestamo->fecha_prestamo) }}"
                                       required>
                                @error('fecha_prestamo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <!-- Barrio y Dirección -->
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="barrio" class="form-label">
                                    <i class="fas fa-map-marker-alt me-1"></i>Barrio
                                </label>
                                <input type="text"
                                       name="barrio"
                                       id="barrio"
                                       class="form-control @error('barrio') is-invalid @enderror"
                                       value="{{ old('barrio', $prestamo->barrio) }}"
                                       placeholder="Ingresa el barrio"
                                       required>
                                @error('barrio')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="direccion" class="form-label">
                                    <i class="fas fa-home me-1"></i>Dirección
                                </label>
                                <input type="text"
                                       name="direccion"
                                       id="direccion"
                                       class="form-control @error('direccion') is-invalid @enderror"
                                       value="{{ old('direccion', $prestamo->direccion) }}"
                                       placeholder="Ingresa la dirección"
                                       required>
                                @error('direccion')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Numeración -->
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="numeracion" class="form-label">
                                    <i class="fas fa-sort-numeric-up me-1"></i>Enrutamiento
                                </label>
                                <input type="number"
                                       name="numeracion"
                                       id="numeracion"
                                       class="form-control @error('numeracion') is-invalid @enderror"
                                       value="{{ old('numeracion', $prestamo->numeracion) }}"
                                       placeholder="Ingresa el enrutamiento"
                                       min="1"
                                       required>
                            </div>
                        </div>
                        
                        <!-- Días a Pagar -->
                        <div class="mb-4">
                            <label class="form-label">
                                <i class="fas fa-calendar-alt me-1"></i>Días a Pagar
                            </label>
                            <div class="row">
                                @php
                                $dias = [
                                    'Lunes' => 'Lunes',
                                    'Martes' => 'Martes',
                                    'Miércoles' => 'Miércoles',
                                    'Jueves' => 'Jueves',
                                    'Viernes' => 'Viernes',
                                    'Sábado' => 'Sábado',
                                ];
                                $seleccionados = old('dias_apagar', json_decode($prestamo->dias_apagar) ?? []);
                                @endphp

                                @foreach ($dias as $valor => $dia)
                                <div class="col-md-3 col-6 mb-2">
                                    <div class="form-check">
                                        <input class="form-check-input @error('dias_apagar') is-invalid @enderror"
                                               type="checkbox"
                                               name="dias_apagar[]"
                                               value="{{ $valor }}"
                                               id="dia_{{ $valor }}"
                                               {{ in_array($valor, $seleccionados) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="dia_{{ $valor }}">
                                            {{ $dia }}
                                        </label>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            @error('dias_apagar')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <!-- Información del préstamo -->
                        <div class="alert alert-warning mb-4">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-info-circle me-2"></i>
                                <div>
                                    <strong>Editando préstamo:</strong>
                                    <ul class="mb-0 mt-2">
                                        <li><strong>Persona:</strong> {{ $prestamo->persona->nombre }} {{ $prestamo->persona->apellido }}</li>
                                        <li><strong>Monto actual:</strong> ${{ number_format($prestamo->monto_prestado, 0, ',', '.') }}</li>
                                        <li><strong>Cuota actual:</strong> ${{ number_format($prestamo->cuota, 0, ',', '.') }}</li>
                                        <li><strong>Fecha:</strong> {{ $prestamo->fecha_prestamo }}</li>
                                        <li><strong>Barrio:</strong> {{ $prestamo->barrio ?? 'No especificado' }}</li>
                                        <li><strong>Dirección:</strong> {{ $prestamo->direccion ?? 'No especificada' }}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Botones de Acción -->
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="{{ route('prestamos.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left me-1"></i>Cancelar
                            </a>
                            <button type="submit" class="btn btn-warning">
                                <i class="fas fa-save me-1"></i>Actualizar Préstamo
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
    
    .form-control, .form-select {
        padding: 12px;
        font-size: 16px; /* Evita zoom en iOS */
    }
    
    .btn {
        padding: 12px 20px;
        font-size: 16px;
    }
    
    .d-grid.gap-2.d-md-flex {
        grid-template-columns: 1fr 1fr;
        gap: 10px !important;
    }
    
    .form-check {
        margin-bottom: 10px;
    }
}

@media (min-width: 769px) {
    .card {
        border-radius: 10px;
    }
    
    .form-control:focus, .form-select:focus {
        border-color: #ffc107;
        box-shadow: 0 0 0 0.2rem rgba(255, 193, 7, 0.25);
    }
    
    .btn:hover {
        transform: translateY(-1px);
        transition: transform 0.2s ease;
    }
}

.form-control, .form-select {
    border-radius: 8px;
    border: 2px solid #e9ecef;
    transition: all 0.3s ease;
}

.form-control:focus, .form-select:focus {
    border-color: #ffc107;
    box-shadow: 0 0 0 0.2rem rgba(255, 193, 7, 0.15);
}

.form-control:disabled {
    background-color: #f8f9fa;
    opacity: 0.8;
}

.input-group-text {
    background-color: #f8f9fa;
    border: 2px solid #e9ecef;
    border-right: none;
    border-radius: 8px 0 0 8px;
}

.input-group .form-control {
    border-left: none;
    border-radius: 0 8px 8px 0;
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

.form-check-input:checked {
    background-color: #ffc107;
    border-color: #ffc107;
}

.form-check-label {
    cursor: pointer;
    user-select: none;
}

.alert-warning {
    background-color: #fff3cd;
    border-color: #ffeaa7;
    color: #856404;
}

.text-muted {
    font-size: 0.875rem;
}
</style>
@endsection