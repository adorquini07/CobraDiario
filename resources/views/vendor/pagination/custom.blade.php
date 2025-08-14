@if ($paginator->hasPages())
    <ul class="pagination pagination-sm mb-0">
        {{-- Botón Anterior --}}
        @if ($paginator->onFirstPage())
            <li class="page-item disabled">
                <span class="page-link border-0 bg-transparent text-muted" aria-label="Página anterior">
                    <i class="fas fa-chevron-left"></i>
                </span>
            </li>
        @else
            <li class="page-item">
                <a class="page-link border-0 bg-transparent text-primary" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="Página anterior">
                    <i class="fas fa-chevron-left"></i>
                </a>
            </li>
        @endif

        {{-- Enlaces de páginas --}}
        @foreach ($elements as $element)
            {{-- Separador "..." --}}
            @if (is_string($element))
                <li class="page-item disabled">
                    <span class="page-link border-0 bg-transparent text-muted">{{ $element }}</span>
                </li>
            @endif

            {{-- Enlaces de páginas --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="page-item active" aria-current="page">
                            <span class="page-link border-0 bg-primary text-white fw-bold" aria-label="Página {{ $page }}, página actual">{{ $page }}</span>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link border-0 bg-transparent text-primary" href="{{ $url }}" aria-label="Página {{ $page }}">{{ $page }}</a>
                        </li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Botón Siguiente --}}
        @if ($paginator->hasMorePages())
            <li class="page-item">
                <a class="page-link border-0 bg-transparent text-primary" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="Página siguiente">
                    <i class="fas fa-chevron-right"></i>
                </a>
            </li>
        @else
            <li class="page-item disabled">
                <span class="page-link border-0 bg-transparent text-muted" aria-label="Página siguiente">
                    <i class="fas fa-chevron-right"></i>
                </span>
            </li>
        @endif
    </ul>
@endif
