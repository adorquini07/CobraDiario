<x-guest-layout>
    <div class="text-center mb-4">
        <h2 class="h3 mb-3 fw-bold text-dark">¡Únete a MAIVVI!</h2>
        <p class="text-muted">Crea tu cuenta para comenzar a gestionar tus préstamos</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="needs-validation" novalidate>
        @csrf

        <!-- Name -->
        <div class="form-group">
            <label for="name" class="form-label">
                <i class="fas fa-user me-2"></i>Nombre completo
            </label>
            <div class="input-group">
                <span class="input-icon">
                    <i class="fas fa-user"></i>
                </span>
                <input
                    id="name"
                    class="form-control input-with-icon @error('name') is-invalid @enderror"
                    type="text"
                    name="name"
                    value="{{ old('name') }}"
                    required
                    autofocus
                    autocomplete="name"
                    placeholder="Tu nombre completo"
                    style="color: #ffffff !important;" />
            </div>
            @error('name')
            <div class="error-message mt-2">
                <i class="fas fa-exclamation-circle me-2"></i>
                {{ $message }}
            </div>
            @enderror
        </div>

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
                    value="{{ old('email') }}"
                    required
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
                <i class="fas fa-lock me-2"></i>Contraseña
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
                <i class="fas fa-lock me-2"></i>Confirmar contraseña
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
                    placeholder="Repite tu contraseña"
                    style="color: #ffffff !important;" />
            </div>
        </div>

        <!-- Submit Button -->
        <div class="form-group">
            <button type="submit" class="btn btn-primary w-100">
                <i class="fas fa-user-plus me-2"></i>
                Crear cuenta
            </button>
        </div>

        <!-- Links -->
        <div class="auth-links">
            <a href="{{ route('login') }}" class="text-decoration-none">
                <i class="fas fa-sign-in-alt me-1"></i>
                ¿Ya tienes una cuenta? Inicia sesión
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