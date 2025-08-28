<x-guest-layout>
    <div class="text-center mb-4">
        <h2 class="h3 mb-3 fw-bold text-dark">Restablecer Contraseña</h2>
        <p class="text-muted">Ingresa tu nueva contraseña para completar el proceso</p>
    </div>

    <form method="POST" action="{{ route('password.store') }}" class="needs-validation" novalidate>
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <div class="form-group">
            <label for="email" class="form-label">
                <i class="fas fa-envelope me-2"></i>Correo electrónico
            </label>
            <div class="input-group">
                <span class="input-icon">
                    <i class="fas fa-envelope"></i>
                </span>
                <input
                    id="email"
                    class="form-control input-with-icon @error('email') is-invalid @enderror"
                    type="email"
                    name="email"
                    value="{{ old('email', $request->email) }}"
                    required
                    autofocus
                    autocomplete="username"
                    placeholder="tu@email.com"
                    style="color: #ffffff !important;" />
            </div>
            @error('email')
            <div class="error-message mt-2">
                <i class="fas fa-exclamation-circle me-2"></i>
                {{ $message }}
            </div>
            @enderror
        </div>

        <!-- Password -->
        <div class="form-group">
            <label for="password" class="form-label">
                <i class="fas fa-lock me-2"></i>Nueva contraseña
            </label>
            <div class="input-group">
                <span class="input-icon">
                    <i class="fas fa-lock"></i>
                </span>
                <input
                    id="password"
                    class="form-control input-with-icon @error('password') is-invalid @enderror"
                    type="password"
                    name="password"
                    required
                    autocomplete="new-password"
                    placeholder="Mínimo 8 caracteres"
                    style="color: #ffffff !important;" />
            </div>
            @error('password')
            <div class="error-message mt-2">
                <i class="fas fa-exclamation-circle me-2"></i>
                {{ $message }}
            </div>
            @enderror
        </div>

        <!-- Confirm Password -->
        <div class="form-group">
            <label for="password_confirmation" class="form-label">
                <i class="fas fa-lock me-2"></i>Confirmar nueva contraseña
            </label>
            <div class="input-group">
                <span class="input-icon">
                    <i class="fas fa-lock"></i>
                </span>
                <input
                    id="password_confirmation"
                    class="form-control input-with-icon"
                    type="password"
                    name="password_confirmation"
                    required
                    autocomplete="new-password"
                    placeholder="Repite tu nueva contraseña"
                    style="color: #ffffff !important;" />
            </div>
        </div>

        <!-- Submit Button -->
        <div class="form-group">
            <button type="submit" class="btn btn-primary w-100">
                <i class="fas fa-key me-2"></i>
                Restablecer contraseña
            </button>
        </div>

        <!-- Links -->
        <div class="auth-links">
            <a href="{{ route('login') }}" class="text-decoration-none">
                <i class="fas fa-arrow-left me-1"></i>
                Volver al inicio de sesión
            </a>
        </div>
    </form>

    <script>
        // Form validation
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                var forms = document.getElementsByClassName('needs-validation');
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();

        // Password visibility toggle for both password fields
        document.addEventListener('DOMContentLoaded', function() {
            const passwordFields = ['password', 'password_confirmation'];

            passwordFields.forEach(function(fieldId) {
                const passwordField = document.getElementById(fieldId);
                if (passwordField) {
                    const togglePassword = document.createElement('span');
                    togglePassword.innerHTML = '<i class="fas fa-eye"></i>';
                    togglePassword.className = 'input-icon';
                    togglePassword.style.right = '15px';
                    togglePassword.style.left = 'auto';
                    togglePassword.style.cursor = 'pointer';

                    passwordField.parentNode.appendChild(togglePassword);

                    togglePassword.addEventListener('click', function() {
                        const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
                        passwordField.setAttribute('type', type);
                        this.innerHTML = type === 'password' ? '<i class="fas fa-eye"></i>' : '<i class="fas fa-eye-slash"></i>';
                    });
                }
            });
        });
    </script>
</x-guest-layout>