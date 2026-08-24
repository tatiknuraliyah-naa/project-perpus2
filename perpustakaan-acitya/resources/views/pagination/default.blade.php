@if ($paginator->hasPages())
    <nav class="app-pagination" role="navigation" aria-label="Navigasi halaman">
        @if ($paginator->onFirstPage())
            <span class="pagination-control is-disabled" aria-disabled="true"><span aria-hidden="true">←</span><span class="pagination-label">Sebelumnya</span></span>
        @else
            <a class="pagination-control" href="{{ $paginator->previousPageUrl() }}" rel="prev"><span aria-hidden="true">←</span><span class="pagination-label">Sebelumnya</span></a>
        @endif

        <div class="pagination-pages">
            @foreach ($elements as $element)
                @if (is_string($element))
                    <span class="pagination-ellipsis">{{ $element }}</span>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span class="pagination-page is-current" aria-current="page">{{ $page }}</span>
                        @else
                            <a class="pagination-page" href="{{ $url }}">{{ $page }}</a>
                        @endif
                    @endforeach
                @endif
            @endforeach
        </div>

        @if ($paginator->hasMorePages())
            <a class="pagination-control" href="{{ $paginator->nextPageUrl() }}" rel="next"><span class="pagination-label">Berikutnya</span><span aria-hidden="true">→</span></a>
        @else
            <span class="pagination-control is-disabled" aria-disabled="true"><span class="pagination-label">Berikutnya</span><span aria-hidden="true">→</span></span>
        @endif
    </nav>
@endif
