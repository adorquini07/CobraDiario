<x-guest-layout>
    <div class="text-center mb-4">
        <h2 class="h3 mb-3 fw-bold text-dark">¿Olvidaste tu contraseña?</h2>
        <p class="text-muted">No te preocupes, te enviaremos un enlace para restablecerla</p>
    </div>

    <div class="alert alert-info mb-4">
        <i class="fas fa-info-circle me-2"></i>
        Ingresa tu dirección de correo electrónico y te enviaremos un enlace para restablecer tu contraseña.
    </div>

    <!-- Session Status -->
    @if (session('status'))
    <div class="success-message">
        <i class="fas fa-check-circle me-2"></i>
        {{ session('status') }}
    </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}" class="needs-validation" novalidate>
        @csrf

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
                    autofocus
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

        <!-- Submit Button -->
        <div class="form-group">
            <button type="submit" class="btn btn-primary w-100">
                <i class="fas fa-paper-plane me-2"></i>
                Enviar enlace de restablecimiento
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
    </script>
</x-guest-layout>