@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Paginación de resultados" style="margin-top:8px">
        <ul style="list-style:none;display:flex;gap:6px;padding:0;margin:0;font-size:13px;align-items:center">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li aria-disabled="true" aria-label="Página anterior">
                    <span style="display:inline-block;padding:6px 10px;border:1px solid #ddd;border-radius:4px;color:#999;font-size:13px">Anterior</span>
                </li>
            @else
                <li>
                    <a href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="Página anterior" style="display:inline-block;padding:6px 10px;border:1px solid #ddd;border-radius:4px;color:#333;text-decoration:none">Anterior</a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li><span style="display:inline-block;padding:6px 10px;color:#666">{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li aria-current="page"><span style="display:inline-block;padding:6px 10px;background:#f0f0f0;border:1px solid #ddd;border-radius:4px">{{ $page }}</span></li>
                        @else
                            <li><a href="{{ $url }}" style="display:inline-block;padding:6px 10px;border:1px solid #ddd;border-radius:4px;color:#333;text-decoration:none">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li>
                    <a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="Página siguiente" style="display:inline-block;padding:6px 10px;border:1px solid #ddd;border-radius:4px;color:#333;text-decoration:none">Siguiente</a>
                </li>
            @else
                <li aria-disabled="true" aria-label="Página siguiente">
                    <span style="display:inline-block;padding:6px 10px;border:1px solid #ddd;border-radius:4px;color:#999">Siguiente</span>
                </li>
            @endif
        </ul>
    </nav>
@endif
