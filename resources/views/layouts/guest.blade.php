<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Favicon -->
        <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
        <link rel="icon" type="image/jpeg" href="{{ asset('imagenes/logo.jpeg') }}">
        <link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
        <link rel="shortcut icon" type="image/jpeg" href="{{ asset('imagenes/logo.jpeg') }}">
        <link rel="apple-touch-icon" href="{{ asset('imagenes/logo.jpeg') }}">
        <link rel="apple-touch-icon-precomposed" href="{{ asset('imagenes/logo.jpeg') }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <style>
            :root {
                --primary-color: #ffc107;
                --secondary-color: #2c3e50;
                --accent-color: #34495e;
                --text-color: #2c3e50;
                --light-bg: #f8f9fa;
                --white: #ffffff;
                --shadow: 0 10px 30px rgba(0,0,0,0.1);
                --border-radius: 15px;
            }

            body {
                font-family: 'Figtree', sans-serif;
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                min-height: 100vh;
                overflow-x: hidden;
            }

            .auth-container {
                min-height: 100vh;
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 20px;
                position: relative;
            }

            .auth-card {
                background: var(--white);
                border-radius: var(--border-radius);
                box-shadow: var(--shadow);
                overflow: hidden;
                width: 100%;
                max-width: 900px;
                display: flex;
                min-height: 600px;
                position: relative;
                animation: slideInUp 0.6s ease-out;
            }

            .auth-sidebar {
                background: linear-gradient(135deg, var(--secondary-color) 0%, var(--accent-color) 100%);
                color: var(--white);
                padding: 40px;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                text-align: center;
                position: relative;
                overflow: hidden;
                min-height: 400px;
            }

            .auth-sidebar::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="rgba(255,255,255,0.1)"/><circle cx="75" cy="75" r="1" fill="rgba(255,255,255,0.1)"/><circle cx="50" cy="10" r="0.5" fill="rgba(255,255,255,0.1)"/><circle cx="10" cy="60" r="0.5" fill="rgba(255,255,255,0.1)"/><circle cx="90" cy="40" r="0.5" fill="rgba(255,255,255,0.1)"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
                opacity: 0.3;
            }

            .auth-content {
                padding: 40px;
                display: flex;
                flex-direction: column;
                justify-content: center;
                flex: 1;
                position: relative;
                color: var(--text-color);
            }

            .logo-container {
                margin-bottom: 30px;
                text-align: center;
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
            }

            .logo-container img {
                width: 80px;
                height: 80px;
                border-radius: 20px;
                box-shadow: 0 5px 15px rgba(0,0,0,0.2);
                margin-bottom: 15px;
                object-fit: cover;
                display: block;
            }

            .brand-name {
                font-size: 2rem;
                font-weight: 700;
                color: var(--primary-color);
                margin-bottom: 10px;
                text-shadow: 0 2px 4px rgba(0,0,0,0.3);
                text-align: center;
            }

            .brand-tagline {
                font-size: 1.1rem;
                opacity: 0.9;
                margin-bottom: 30px;
                text-align: center;
            }

            .form-group {
                margin-bottom: 25px;
                position: relative;
            }

            .form-label {
                font-weight: 600;
                color: var(--text-color);
                margin-bottom: 8px;
                display: block;
                font-size: 0.95rem;
            }

            .auth-content h2,
            .auth-content h3,
            .auth-content .h3 {
                color: var(--text-color) !important;
                font-weight: 700;
                margin-bottom: 0.5rem;
            }

            .auth-content p {
                color: #6c757d;
                margin-bottom: 0.5rem;
            }

            .auth-content .text-muted {
                color: #6c757d !important;
            }

            .auth-content .text-dark {
                color: var(--text-color) !important;
            }

            /* Asegurar que todos los textos sean visibles */
            .auth-content * {
                color: inherit;
            }

            .auth-content .fw-bold {
                font-weight: 700 !important;
            }

            .auth-content .mb-3 {
                margin-bottom: 1rem !important;
            }

            .form-check-label {
                color: var(--text-color);
                font-size: 0.9rem;
            }

            .form-check-input:checked {
                background-color: var(--primary-color);
                border-color: var(--primary-color);
            }

            .alert-info {
                background-color: #d1ecf1;
                border-color: #bee5eb;
                color: #0c5460;
                border-radius: 8px;
            }

            .form-control {
                border: 2px solid #e9ecef;
                border-radius: 12px;
                padding: 15px 20px;
                font-size: 1rem;
                transition: all 0.3s ease;
                background: #f8f9fa;
                color: #333333;
            }

            .form-control:focus {
                border-color: var(--primary-color);
                box-shadow: 0 0 0 0.2rem rgba(255, 193, 7, 0.25);
                background: var(--white);
                transform: translateY(-2px);
                color: #333333;
            }

            .form-control::placeholder {
                color: #6c757d !important;
                opacity: 1;
            }

            .form-control:focus::placeholder {
                color: #adb5bd !important;
            }

            /* Asegurar que el texto sea visible en todos los estados */
            .form-control,
            .form-control:focus,
            .form-control:active,
            .form-control:hover,
            .form-control:valid,
            .form-control:invalid {
                color: #333333 !important;
            }

            /* Forzar el color del texto en todos los inputs */
            input[type="text"],
            input[type="email"],
            input[type="password"],
            input[type="tel"],
            input[type="number"],
            textarea,
            select {
                color: #333333 !important;
            }

            /* Específicamente para los campos del formulario de auth */
            .auth-content input,
            .auth-content textarea {
                color: #333333 !important;
            }

            .input-group {
                position: relative;
            }

            .input-icon {
                position: absolute;
                left: 15px;
                top: 50%;
                transform: translateY(-50%);
                color: #6c757d;
                z-index: 10;
            }

            .input-with-icon {
                padding-left: 50px;
            }

            .btn-primary {
                background: linear-gradient(135deg, var(--primary-color) 0%, #ffb300 100%);
                border: none;
                border-radius: 12px;
                padding: 15px 30px;
                font-weight: 600;
                font-size: 1.1rem;
                transition: all 0.3s ease;
                box-shadow: 0 5px 15px rgba(255, 193, 7, 0.3);
            }

            .btn-primary:hover {
                transform: translateY(-3px);
                box-shadow: 0 8px 25px rgba(255, 193, 7, 0.4);
                background: linear-gradient(135deg, #ffb300 0%, var(--primary-color) 100%);
            }

            .btn-secondary {
                background: transparent;
                border: 2px solid var(--primary-color);
                color: var(--primary-color);
                border-radius: 12px;
                padding: 15px 30px;
                font-weight: 600;
                transition: all 0.3s ease;
            }

            .btn-secondary:hover {
                background: var(--primary-color);
                color: var(--white);
                transform: translateY(-2px);
            }

            .auth-links {
                margin-top: 30px;
                text-align: center;
            }

            .auth-links a {
                color: var(--primary-color);
                text-decoration: none;
                font-weight: 500;
                transition: all 0.3s ease;
                margin: 0 15px;
            }

            .auth-links a:hover {
                color: #ffb300;
                transform: translateY(-1px);
            }

            .floating-shapes {
                position: absolute;
                width: 100%;
                height: 100%;
                overflow: hidden;
                pointer-events: none;
            }

            .shape {
                position: absolute;
                background: rgba(255, 255, 255, 0.1);
                border-radius: 50%;
                animation: float 6s ease-in-out infinite;
            }

            .shape:nth-child(1) {
                width: 80px;
                height: 80px;
                top: 20%;
                left: 10%;
                animation-delay: 0s;
            }

            .shape:nth-child(2) {
                width: 120px;
                height: 120px;
                top: 60%;
                right: 10%;
                animation-delay: 2s;
            }

            .shape:nth-child(3) {
                width: 60px;
                height: 60px;
                bottom: 20%;
                left: 20%;
                animation-delay: 4s;
            }

            @keyframes float {
                0%, 100% { transform: translateY(0px) rotate(0deg); }
                50% { transform: translateY(-20px) rotate(180deg); }
            }

            @keyframes slideInUp {
                from {
                    opacity: 0;
                    transform: translateY(30px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            .error-message {
                background: #fee;
                border: 1px solid #fcc;
                color: #c33;
                padding: 10px 15px;
                border-radius: 8px;
                margin-bottom: 20px;
                font-size: 0.9rem;
            }

            .success-message {
                background: #efe;
                border: 1px solid #cfc;
                color: #3c3;
                padding: 10px 15px;
                border-radius: 8px;
                margin-bottom: 20px;
                font-size: 0.9rem;
            }

            /* Responsive Design */
            @media (max-width: 768px) {
                .auth-card {
                    flex-direction: column;
                    min-height: auto;
                    margin: 20px;
                }

                .auth-sidebar {
                    padding: 30px 20px;
                    order: 2;
                    min-height: 200px;
                }

                .auth-content {
                    padding: 30px 20px;
                    order: 1;
                }

                .brand-name {
                    font-size: 1.5rem;
                }

                .brand-tagline {
                    font-size: 1rem;
                }

                .logo-container img {
                    width: 60px;
                    height: 60px;
                    object-fit: cover;
                }

                .floating-shapes {
                    display: none;
                }

                .auth-content h2,
                .auth-content h3,
                .auth-content .h3 {
                    color: var(--text-color) !important;
                    font-weight: 700;
                    font-size: 1.5rem;
                }

                .auth-content p {
                    color: #6c757d;
                    font-size: 0.9rem;
                }
            }

            @media (max-width: 480px) {
                .auth-container {
                    padding: 10px;
                }

                .auth-card {
                    margin: 10px;
                }

                .auth-content {
                    padding: 20px 15px;
                }

                .auth-sidebar {
                    padding: 20px 15px;
                }

                .btn-primary, .btn-secondary {
                    padding: 12px 20px;
                    font-size: 1rem;
                }
            }

            /* Dark mode support */
            @media (prefers-color-scheme: dark) {
                .auth-card {
                    background: #1a1a1a;
                    color: #ffffff;
                }

                .form-control {
                    background: #2a2a2a;
                    border-color: #404040;
                    color: #ffffff !important;
                }

                .form-control:focus {
                    background: #2a2a2a;
                    color: #ffffff !important;
                }

                .form-control::placeholder {
                    color: #adb5bd !important;
                }

                .form-label {
                    color: #ffffff;
                }

                .auth-content h2,
                .auth-content h3,
                .auth-content .h3 {
                    color: #ffffff !important;
                }

                .auth-content .text-dark {
                    color: #ffffff !important;
                }

                /* Forzar color en dark mode */
                .auth-content input,
                .auth-content textarea {
                    color: #ffffff !important;
                }
            }
        </style>
    </head>
    <body>
        <div class="auth-container">
            <div class="auth-card">
                <!-- Sidebar with branding -->
                <div class="auth-sidebar">
                    <div class="floating-shapes">
                        <div class="shape"></div>
                        <div class="shape"></div>
                        <div class="shape"></div>
                    </div>
                    
                    <div class="logo-container">
                        <img src="{{ asset('imagenes/logo.jpeg') }}" alt="MAIVVI Logo">
                        <div class="brand-name">MAIVVI</div>
                        <div class="brand-tagline">Sistema de Gestión de Préstamos</div>
                    </div>
                    
                    <div class="mt-4">
                        <p class="mb-3">
                            <i class="fas fa-chart-line me-2"></i>
                            Control total de tus préstamos
                        </p>
                        <p class="mb-3">
                            <i class="fas fa-users me-2"></i>
                            Gestión de clientes
                        </p>
                        <p class="mb-3">
                            <i class="fas fa-hand-holding-usd me-2"></i>
                            Seguimiento de pagos
                        </p>
                    </div>
                </div>

                <!-- Main content -->
                <div class="auth-content">
                    {{ $slot }}
                </div>
            </div>
        </div>

        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
