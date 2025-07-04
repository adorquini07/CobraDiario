@extends('layouts.main')
@section('title', 'Crear Prestamo')
@section('contenidossss')
<div class="container"><br>
    <div class="row justify-content-center">
        <div class="col-md-10 col-lg-8">
            <div class="card shadow-sm">
                <div class="card-header bg-success text-white">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-money-bill-wave me-2"></i>
                        <h5 class="mb-0">Crear Nuevo Préstamo</h5>
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
                    
                    <form action="{{ route('prestamos.store') }}" method="post">
                        @csrf
                        
                        <!-- Información del Préstamo -->
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="id_persona" class="form-label">
                                    <i class="fas fa-user me-1"></i>Persona
                                </label>
                                <select name="id_persona" 
                                        id="id_persona" 
                                        class="form-select @error('id_persona') is-invalid @enderror"
                                        required>
                                    <option value="">Seleccione una persona</option>
                                    @foreach ($personas as $persona)
                                        <option value="{{ $persona->id }}" {{ old('id_persona') == $persona->id ? 'selected' : '' }}>
                                            {{ $persona->nombre . ' ' . $persona->apellido }} - {{ $persona->nuip }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('id_persona')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
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
                                           value="{{ old('monto_prestado') }}"
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
                                           value="{{ old('cuota') }}"
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
                                       value="{{ old('fecha_prestamo', date('Y-m-d')) }}"
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
                                       value="{{ old('barrio') }}"
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
                                       value="{{ old('direccion') }}"
                                       placeholder="Ingresa la dirección"
                                       required>
                                @error('direccion')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
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
                                $seleccionados = old('dias_apagar', []);
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
                        
                        <!-- Información adicional -->
                        <div class="alert alert-info mb-4">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-info-circle me-2"></i>
                                <div>
                                    <strong>Información importante:</strong>
                                    <ul class="mb-0 mt-2">
                                        <li>Selecciona la persona que recibirá el préstamo</li>
                                        <li>El monto prestado debe ser mayor a 0</li>
                                        <li>La cuota debe ser menor o igual al monto prestado</li>
                                        <li>Completa la información de ubicación donde va ser cobrado (barrio y dirección)</li>
                                        <li>Selecciona al menos un día de pago</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Botones de Acción -->
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="{{ route('prestamos.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left me-1"></i>Cancelar
                            </a>
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-save me-1"></i>Guardar Préstamo
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
        border-color: #198754;
        box-shadow: 0 0 0 0.2rem rgba(25, 135, 84, 0.25);
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
    border-color: #198754;
    box-shadow: 0 0 0 0.2rem rgba(25, 135, 84, 0.15);
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
    background-color: #198754;
    border-color: #198754;
}

.form-check-label {
    cursor: pointer;
    user-select: none;
}

.alert-info {
    background-color: #d1ecf1;
    border-color: #bee5eb;
    color: #0c5460;
}
</style>
@endsection