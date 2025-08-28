@extends('layouts.main')

@section('title', 'Cambiar Contraseña')

@section('contenidossss')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">
                        <i class="fas fa-key me-2"></i>Cambiar Contraseña
                    </h4>
                </div>
                <div class="card-body">
                    
                    <!-- Session Status -->
                    @if (session('status'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle me-2"></i>
                            {{ session('status') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.change.update') }}">
                        @csrf

                        <!-- Current Password -->
                        <div class="mb-3">
                            <label for="current_password" class="form-label">
                                <i class="fas fa-lock me-2"></i>Contraseña Actual
                            </label>
                            <div class="input-group">
                                <input 
                                    id="current_password" 
                                    name="current_password" 
                                    type="password" 
                                    class="form-control @error('current_password') is-invalid @enderror"
                                    required 
                                    autocomplete="current-password"
                                    placeholder="Ingresa tu contraseña actual"
                                />
                                <button type="button" class="btn btn-outline-secondary" onclick="togglePassword('current_password')">
                                    <i class="fas fa-eye" id="current_password_icon"></i>
                                </button>
                            </div>
                            @error('current_password')
                                <div class="invalid-feedback">
                                    <i class="fas fa-exclamation-circle me-1"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- New Password -->
                        <div class="mb-3">
                            <label for="password" class="form-label">
                                <i class="fas fa-key me-2"></i>Nueva Contraseña
                            </label>
                            <div class="input-group">
                                <input 
                                    id="password" 
                                    name="password" 
                                    type="password" 
                                    class="form-control @error('password') is-invalid @enderror"
                                    required 
                                    autocomplete="new-password"
                                    placeholder="Mínimo 8 caracteres"
                                />
                                <button type="button" class="btn btn-outline-secondary" onclick="togglePassword('password')">
                                    <i class="fas fa-eye" id="password_icon"></i>
                                </button>
                            </div>
                            @error('password')
                                <div class="invalid-feedback">
                                    <i class="fas fa-exclamation-circle me-1"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Confirm New Password -->
                        <div class="mb-4">
                            <label for="password_confirmation" class="form-label">
                                <i class="fas fa-check-circle me-2"></i>Confirmar Nueva Contraseña
                            </label>
                            <div class="input-group">
                                <input 
                                    id="password_confirmation" 
                                    name="password_confirmation" 
                                    type="password" 
                                    class="form-control"
                                    required 
                                    autocomplete="new-password"
                                    placeholder="Repite tu nueva contraseña"
                                />
                                <button type="button" class="btn btn-outline-secondary" onclick="togglePassword('password_confirmation')">
                                    <i class="fas fa-eye" id="password_confirmation_icon"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Submit Buttons -->
                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>
                                Actualizar Contraseña
                            </button>
                            
                            <a href="{{ route('pagos.resumen') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-2"></i>
                                Cancelar
                            </a>
                        </div>
                    </form>

                    <!-- Security Tips -->
                    <div class="mt-4 p-3 bg-info bg-opacity-10 border border-info rounded">
                        <h6 class="text-info mb-2">
                            <i class="fas fa-shield-alt me-2"></i>Consejos de Seguridad
                        </h6>
                        <ul class="text-muted small mb-0">
                            <li><i class="fas fa-check me-1"></i>Usa al menos 8 caracteres</li>
                            <li><i class="fas fa-check me-1"></i>Combina letras, números y símbolos</li>
                            <li><i class="fas fa-check me-1"></i>Evita información personal</li>
                            <li><i class="fas fa-check me-1"></i>No reutilices contraseñas</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function togglePassword(fieldId) {
        const field = document.getElementById(fieldId);
        const icon = document.getElementById(fieldId + '_icon');
        
        if (field.type === 'password') {
            field.type = 'text';
            icon.className = 'fas fa-eye-slash';
        } else {
            field.type = 'password';
            icon.className = 'fas fa-eye';
        }
    }
</script>
@endsection
