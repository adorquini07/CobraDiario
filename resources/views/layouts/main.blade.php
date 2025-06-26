<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <title>@yield('title')</title>
        <style>
            /* Estilos para la navegación global */
            .navbar {
                box-shadow: 0 4px 12px rgba(0,0,0,0.2);
                border-bottom: 1px solid rgba(255,255,255,0.1);
            }
            
            .navbar-brand {
                font-size: 1.5rem;
                text-shadow: 0 2px 4px rgba(0,0,0,0.3);
            }
            
            .navbar-nav .nav-link {
                font-weight: 500;
                transition: all 0.3s ease;
                border-radius: 8px;
                margin: 0 2px;
            }
            
            .navbar-nav .nav-link:hover {
                background-color: rgba(255,255,255,0.1);
                transform: translateY(-1px);
                color: #ffc107 !important;
            }
            
            .navbar-nav .nav-link.active {
                background-color: rgba(255,193,7,0.2);
                box-shadow: 0 2px 8px rgba(0,0,0,0.2);
                color: #ffc107 !important;
            }
            
            .dropdown-item:hover {
                background-color: #f8f9fa;
                transform: translateX(5px);
                transition: all 0.3s ease;
            }
        </style>
    </head>
    <body>
        <!-- Navegación Global -->
        <nav class="navbar navbar-expand-lg navbar-dark" style="background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);">
            <div class="container">
                <a class="navbar-brand fw-bold text-warning" href="{{ route('pagos.resumen') }}">
                    <i class="fas fa-coins me-2"></i>
                    CobraDiario
                </a>
                
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link text-light {{ request()->routeIs('pagos.resumen') ? 'active' : '' }}" href="{{ route('pagos.resumen') }}">
                                <i class="fas fa-chart-line me-1"></i>
                                Resumen
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light {{ request()->routeIs('personas.*') ? 'active' : '' }}" href="{{ route('personas.index') }}">
                                <i class="fas fa-users me-1"></i>
                                Personas
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light {{ request()->routeIs('prestamos.*') ? 'active' : '' }}" href="{{ route('prestamos.index') }}">
                                <i class="fas fa-hand-holding-usd me-1"></i>
                                Préstamos
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light {{ request()->routeIs('pagos.show') ? 'active' : '' }}" href="{{ route('pagos.show') }}">
                                <i class="fas fa-money-bill-wave me-1 fa-lg"></i>
                                Cobros hoy
                            </a>
                        </li>
                    </ul>
                    
                    <div class="navbar-nav">
                        <div class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle d-flex align-items-center text-light" href="#" data-bs-toggle="dropdown">
                                <div class="bg-warning text-dark rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 32px; height: 32px;">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                </div>
                                <span>{{ Auth::user()->name }}</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <form method="POST" action="{{ route('logout') }}" class="d-inline">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger" onclick="return confirm('¿Cerrar sesión?')">
                                            <i class="fas fa-sign-out-alt me-2"></i>Cerrar sesión
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
        
        @yield('contenidossss')
        
        <!-- Scripts de Bootstrap y SweetAlert2 -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://kit.fontawesome.com/c4ec8bf8b9.js" crossorigin="anonymous"></script>
        @stack('scripts')
    </body>
</html>