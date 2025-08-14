@extends('layouts.main')
@section('title', 'Personas')

@push('styles')
<style>
    /* Estilos para filtros dinámicos */
    .bg-gradient-primary {
        background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
    }

    .card.shadow-sm {
        transition: all 0.3s ease;
    }

    .card.shadow-sm:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15) !important;
    }

    .input-group-text {
        border: none;
    }

    .form-control:focus {
        border-color: #007bff;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }

    .btn-group .btn.active {
        background-color: #007bff;
        border-color: #007bff;
        color: white;
    }

    /* Hover sutil para filas de tabla - solo en escritorio */
    @media (min-width: 992px) {
        .table-hover tbody tr {
            border-left: 3px solid transparent;
            transition: all 0.3s ease;
        }
        
        .table-hover tbody tr:hover {
            background-color: rgba(0, 123, 255, 0.06);
            border-left: 3px solid #007bff;
            box-shadow: 0 1px 4px rgba(0, 0, 0, 0.08);
        }
    }

    /* Hover más sutil para móviles */
    @media (max-width: 991px) {
        .table-hover tbody tr:hover {
            background-color: rgba(0, 123, 255, 0.05);
            transition: background-color 0.2s ease;
        }
    }

    /* Efecto sutil para nombres de personas */
    .table-hover tbody tr td:first-child {
        transition: color 0.2s ease;
    }

    .table-hover tbody tr:hover td:first-child {
        color: #0056b3 !important;
    }

    .badge {
        font-size: 0.75em;
    }

    /* Animaciones para filtros */
    .filtro-animado {
        animation: slideIn 0.3s ease-out;
    }

    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Responsive improvements */
    @media (max-width: 768px) {
        .input-group {
            margin-bottom: 1rem;
        }

        .btn-group {
            width: 100%;
            margin-top: 1rem;
        }

        .btn-group .btn {
            flex: 1;
        }
    }

    /* Loading state */
    .loading {
        opacity: 0.6;
        pointer-events: none;
    }

    /* Smooth transitions */
    .table-responsive,
    .card {
        transition: all 0.3s ease;
    }

    /* Estilos para paginación personalizada */
    .pagination {
        gap: 0.25rem;
    }

    .pagination .page-link {
        border-radius: 0.5rem;
        padding: 0.5rem 0.75rem;
        font-weight: 500;
        transition: all 0.2s ease;
        min-width: 2.5rem;
        text-align: center;
    }

    .pagination .page-link:hover {
        transform: translateY(-1px);
        box-shadow: 0 2px 8px rgba(0, 123, 255, 0.3);
        background-color: rgba(0, 123, 255, 0.1);
    }

    .pagination .page-link:focus {
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        outline: none;
    }

    .pagination .page-item.active .page-link {
        box-shadow: 0 2px 8px rgba(0, 123, 255, 0.4);
        transform: scale(1.05);
    }

    .pagination .page-item.disabled .page-link {
        opacity: 0.5;
        cursor: not-allowed;
        transform: none !important;
        box-shadow: none !important;
    }

    .pagination .page-item.disabled .page-link:hover {
        transform: none;
        box-shadow: none;
        background-color: transparent;
    }

    /* Responsive para paginación */
    @media (max-width: 768px) {
        .pagination {
            gap: 0.125rem;
        }

        .pagination .page-link {
            padding: 0.375rem 0.5rem;
            min-width: 2rem;
            font-size: 0.875rem;
        }
    }
</style>
@endpush

@section('contenidossss')

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-gradient-primary text-white">
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                        <div>
                            <h4 class="mb-0"><i class="fas fa-users me-2"></i>Gestión de Personas</h4>
                            <small class="opacity-75">Busca y filtra personas de forma dinámica</small>
                        </div>
                        <a href="{{ route('personas.create') }}" class="btn btn-light btn-sm">
                            <i class="fas fa-plus me-1"></i>Nueva Persona
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    @if (session('info'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle me-2"></i>{{ session('info') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                    @endif

                    <!-- Filtros -->
                    <div class="card mb-4 border-0 bg-light">
                        <div class="card-body">
                            <form method="GET" action="{{ route('personas.index') }}" id="filtrosForm">

                                <!-- Filtros específicos -->
                                <div class="row g-3">
                                    <div class="col-md-3 col-sm-6">
                                        <label class="form-label text-muted small">
                                            <i class="fas fa-user me-1"></i>Nombre
                                        </label>
                                        <input type="text"
                                            class="form-control"
                                            name="nombre"
                                            value="{{ request('nombre') }}"
                                            placeholder="Filtrar por nombre">
                                    </div>

                                    <div class="col-md-3 col-sm-6">
                                        <label class="form-label text-muted small">
                                            <i class="fas fa-user-tag me-1"></i>Apellido
                                        </label>
                                        <input type="text"
                                            class="form-control"
                                            name="apellido"
                                            value="{{ request('apellido') }}"
                                            placeholder="Filtrar por apellido">
                                    </div>

                                    <div class="col-md-2 col-sm-6">
                                        <label class="form-label text-muted small">
                                            <i class="fas fa-id-card me-1"></i>Cédula
                                        </label>
                                        <input type="text"
                                            class="form-control"
                                            name="nuip"
                                            value="{{ request('nuip') }}"
                                            placeholder="Número de cédula">
                                    </div>

                                    <div class="col-md-2 col-sm-6">
                                        <label class="form-label text-muted small">
                                            <i class="fas fa-phone me-1"></i>Teléfono
                                        </label>
                                        <input type="text"
                                            class="form-control"
                                            name="telefono"
                                            value="{{ request('telefono') }}"
                                            placeholder="Número de teléfono">
                                    </div>

                                    <div class="col-md-2 col-sm-6">
                                        <label class="form-label text-muted small">
                                            <i class="fas fa-map-marker-alt me-1"></i>Barrio
                                        </label>
                                        <select class="form-select" name="barrio">
                                            <option value="">Todos los barrios</option>
                                            @foreach($barrios as $barrio)
                                            <option value="{{ $barrio }}" {{ request('barrio') == $barrio ? 'selected' : '' }}>
                                                {{ $barrio }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <!-- Botones de acción -->
                                <div class="row mt-3">
                                    <div class="col-12">
                                        <div class="d-flex gap-2 flex-wrap">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fas fa-filter me-1"></i>Filtrar
                                            </button>
                                            <a href="{{ route('personas.index') }}" class="btn btn-outline-secondary">
                                                <i class="fas fa-undo me-1"></i>Limpiar
                                            </a>
                                            <div class="ms-auto d-flex gap-2">
                                                <select class="form-select form-select-sm" name="sort_by" style="width: auto;">
                                                    <option value="nombre" {{ request('sort_by') == 'nombre' ? 'selected' : '' }}>Ordenar por Nombre</option>
                                                    <option value="apellido" {{ request('sort_by') == 'apellido' ? 'selected' : '' }}>Ordenar por Apellido</option>
                                                    <option value="barrio" {{ request('sort_by') == 'barrio' ? 'selected' : '' }}>Ordenar por Barrio</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Resultados -->
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="d-flex align-items-center gap-2">
                            <span class="badge bg-primary" id="resultCount">{{ $personas->total() }} personas encontradas</span>
                            @if(request()->hasAny(['search', 'nombre', 'apellido', 'nuip', 'telefono', 'barrio']))
                            <span class="badge bg-warning text-dark">
                                <i class="fas fa-filter me-1"></i>Filtros activos
                            </span>
                            @endif
                            <div id="loadingIndicator" class="d-none">
                                <div class="spinner-border spinner-border-sm text-primary" role="status">
                                    <span class="visually-hidden">Cargando...</span>
                                </div>
                                <span class="ms-1 text-muted small">Buscando...</span>
                            </div>
                        </div>
                    </div>

                    <!-- Vista de escritorio (tabla) -->
                    <div id="tableView" class="d-none d-lg-block">
                        <div class="table-responsive">
                            <table class="table table-hover table-striped align-middle">
                                <thead class="table-dark">
                                    <tr>
                                        <th><i class="fas fa-user me-1"></i>Nombre</th>
                                        <th><i class="fas fa-user-tag me-1"></i>Apellido</th>
                                        <th><i class="fas fa-id-card me-1"></i>Cédula</th>
                                        <th><i class="fas fa-mobile-alt me-1"></i>Celular</th>
                                        <th><i class="fas fa-map-marker-alt me-1"></i>Dirección</th>
                                        <th><i class="fas fa-map-marker-alt me-1"></i>Barrio</th>
                                        <th class="text-center"><i class="fas fa-cogs me-1"></i>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($personas as $persona)
                                    <tr>
                                        <td class="fw-bold text-primary">{{ $persona->nombre }}</td>
                                        <td>{{ $persona->apellido }}</td>
                                        <td><span class="badge bg-info text-dark">{{ $persona->nuip }}</span></td>
                                        <td>
                                            <a href="tel:{{ $persona->telefono }}" class="text-decoration-none text-success">
                                                <i class="fas fa-phone-alt me-1"></i>{{ $persona->telefono }}
                                            </a>
                                        </td>
                                        <td><span class="text-secondary">{{ $persona->direccion }}</span></td>
                                        <td><span class="badge bg-secondary">{{ $persona->barrio }}</span></td>
                                        <td>
                                            <div class="d-flex justify-content-center gap-1">
                                                <a href="{{ route('personas.edit', $persona->id) }}"
                                                    class="btn btn-warning btn-sm"
                                                    data-bs-toggle="tooltip"
                                                    data-bs-placement="top"
                                                    title="Editar persona">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </a>
                                                <form action="{{ route('personas.destroy', $persona->id) }}"
                                                    method="POST"
                                                    class="d-inline">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit"
                                                        class="btn btn-danger btn-sm"
                                                        data-bs-toggle="tooltip"
                                                        data-bs-placement="top"
                                                        title="Eliminar persona">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="7" class="text-center py-4">
                                            <i class="fas fa-search fa-2x text-muted mb-2"></i>
                                            <p class="text-muted mb-0">No se encontraron personas con los filtros aplicados</p>
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Vista móvil (cards) -->
                    <div id="cardsView" class="d-lg-none">
                        @forelse ($personas as $persona)
                        <div class="card mb-3 border-0 shadow-sm">
                            <div class="card-header bg-gradient-primary text-white">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h6 class="mb-0">{{ $persona->nombre . ' ' . $persona->apellido }}</h6>
                                    <span class="badge bg-light text-dark">{{ $persona->nuip }}</span>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row g-2 mb-3">
                                    <div class="col-6">
                                        <small class="text-muted d-block">
                                            <i class="fas fa-phone me-1"></i>Teléfono:
                                        </small>
                                        <a href="tel:{{ $persona->telefono }}" class="text-decoration-none text-success fw-bold">
                                            {{ $persona->telefono }}
                                        </a>
                                    </div>
                                    <div class="col-6">
                                        <small class="text-muted d-block">
                                            <i class="fas fa-map-marker-alt me-1"></i>Barrio:
                                        </small>
                                        <span class="badge bg-secondary">{{ $persona->barrio }}</span>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <small class="text-muted d-block">
                                        <i class="fas fa-home me-1"></i>Dirección:
                                    </small>
                                    <span class="text-secondary">{{ $persona->direccion }}</span>
                                </div>
                                <div class="d-grid gap-2 d-md-flex">
                                    <a href="{{ route('personas.edit', $persona->id) }}"
                                        class="btn btn-warning btn-sm flex-fill"
                                        data-bs-toggle="tooltip"
                                        data-bs-placement="top"
                                        title="Editar persona">
                                        <i class="fas fa-edit me-1"></i>Editar
                                    </a>
                                    <form action="{{ route('personas.destroy', $persona->id) }}"
                                        method="POST"
                                        class="flex-fill">
                                        @csrf
                                        @method('delete')
                                        <button type="submit"
                                            class="btn btn-danger btn-sm w-100"
                                            data-bs-toggle="tooltip"
                                            data-bs-placement="top"
                                            title="Eliminar persona">
                                            <i class="fas fa-trash me-1"></i>Eliminar
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="text-center py-5">
                            <i class="fas fa-search fa-3x text-muted mb-3"></i>
                            <p class="text-muted mb-0">No se encontraron personas con los filtros aplicados</p>
                        </div>
                        @endforelse
                    </div>

                    <!-- Paginación -->
                    @if($personas->hasPages())
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mt-4 p-3 bg-light rounded-3 border gap-3">
                        <div class="d-flex align-items-center gap-2">
                            <span class="text-muted small">
                                <i class="fas fa-info-circle me-1"></i>
                                <span class="d-none d-sm-inline">Mostrando {{ $personas->firstItem() ?? 0 }} - {{ $personas->lastItem() ?? 0 }} de {{ $personas->total() }} registros</span>
                                <span class="d-sm-none">{{ $personas->total() }} registros</span>
                            </span>
                        </div>

                        <nav aria-label="Navegación de páginas" class="order-first order-md-2">
                            {{ $personas->appends(request()->query())->links('vendor.pagination.custom') }}
                        </nav>

                        <div class="d-flex align-items-center gap-2 order-last order-md-3">
                            <span class="text-muted small">
                                <span class="d-none d-sm-inline">Página {{ $personas->currentPage() }} de {{ $personas->lastPage() }}</span>
                                <span class="d-sm-none">{{ $personas->currentPage() }}/{{ $personas->lastPage() }}</span>
                            </span>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Búsqueda en tiempo real con debounce
        const searchInput = document.getElementById('searchInput');
        const clearSearch = document.getElementById('clearSearch');
        const filtrosForm = document.getElementById('filtrosForm');
        let searchTimeout;

        searchInput.addEventListener('input', function() {
            clearTimeout(searchTimeout);
            showLoadingState();
            searchTimeout = setTimeout(() => {
                filtrosForm.submit();
            }, 500);
        });

        clearSearch.addEventListener('click', function() {
            searchInput.value = '';
            showLoadingState();
            filtrosForm.submit();
        });

        // Cambio de vista con animaciones
        const viewTable = document.getElementById('viewTable');
        const viewCards = document.getElementById('viewCards');
        const tableView = document.getElementById('tableView');
        const cardsView = document.getElementById('cardsView');

        viewTable.addEventListener('click', function() {
            viewTable.classList.add('active');
            viewCards.classList.remove('active');
            tableView.classList.remove('d-none');
            tableView.classList.add('filtro-animado');
            cardsView.classList.add('d-none');
        });

        viewCards.addEventListener('click', function() {
            viewCards.classList.add('active');
            viewTable.classList.remove('active');
            cardsView.classList.remove('d-none');
            cardsView.classList.add('filtro-animado');
            tableView.classList.add('d-none');
        });

        // Auto-submit en cambios de filtros
        const filterInputs = document.querySelectorAll('select[name="sort_by"], select[name="sort_order"], select[name="barrio"]');
        filterInputs.forEach(input => {
            input.addEventListener('change', function() {
                showLoadingState();
                filtrosForm.submit();
            });
        });

        // Filtros específicos con debounce
        const specificFilters = document.querySelectorAll('input[name="nombre"], input[name="apellido"], input[name="nuip"], input[name="telefono"]');
        specificFilters.forEach(input => {
            input.addEventListener('input', function() {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(() => {
                    showLoadingState();
                    filtrosForm.submit();
                }, 800);
            });
        });

        // Función para mostrar estado de carga
        function showLoadingState() {
            const container = document.querySelector('.card-body');
            const loadingIndicator = document.getElementById('loadingIndicator');
            const resultCount = document.getElementById('resultCount');

            container.classList.add('loading');
            loadingIndicator.classList.remove('d-none');
            resultCount.classList.add('opacity-50');

            // Remover loading después de un tiempo
            setTimeout(() => {
                container.classList.remove('loading');
                loadingIndicator.classList.add('d-none');
                resultCount.classList.remove('opacity-50');
            }, 1000);
        }

        // Tooltips para botones
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });

        // Confirmación mejorada para eliminar
        const deleteButtons = document.querySelectorAll('button[onclick*="confirm"]');
        deleteButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const form = this.closest('form');

                Swal.fire({
                    title: '¿Estás seguro?',
                    text: "Esta acción no se puede deshacer",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Sí, eliminar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });

        // Animación de entrada para las cards
        const cards = document.querySelectorAll('.card.mb-3');
        cards.forEach((card, index) => {
            card.style.animationDelay = `${index * 0.1}s`;
            card.classList.add('filtro-animado');
        });

        // Contador de resultados en tiempo real
        const resultCount = document.querySelector('.badge.bg-primary');
        if (resultCount) {
            const count = parseInt(resultCount.textContent);
            if (count === 0) {
                resultCount.classList.remove('bg-primary');
                resultCount.classList.add('bg-warning', 'text-dark');
            }
        }

        // Animación suave al cambiar de página
        const paginationLinks = document.querySelectorAll('.pagination .page-link[href]');
        paginationLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                const container = document.querySelector('.card-body');
                container.style.opacity = '0.7';
                container.style.transform = 'scale(0.98)';

                setTimeout(() => {
                    container.style.opacity = '1';
                    container.style.transform = 'scale(1)';
                }, 300);
            });
        });
    });
</script>
@endpush

@endsection