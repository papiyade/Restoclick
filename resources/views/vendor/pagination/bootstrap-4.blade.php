@if ($paginator->hasPages())
    <ul class="pagination">
        {{-- Lien vers la page précédente --}}
        @if ($paginator->onFirstPage())
            <li class="disabled"><span>« Précédent</span></li>
        @else
            <li><a href="{{ $paginator->previousPageUrl() }}" rel="prev">« Précédent</a></li>
        @endif

        {{-- Lien pour les pages --}}
        @foreach ($elements as $element)
            {{-- Trois points indiquant une séparation entre les pages --}}
            @if (is_string($element))
                <li class="disabled"><span>{{ $element }}</span></li>
            @endif

            {{-- Lien pour les pages numérotées --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="active"><span>{{ $page }}</span></li>
                    @else
                        <li><a href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Lien vers la page suivante --}}
        @if ($paginator->hasMorePages())
            <li><a href="{{ $paginator->nextPageUrl() }}" rel="next">Suivant »</a></li>
        @else
            <li class="disabled"><span>Suivant »</span></li>
        @endif
    </ul>
@endif
