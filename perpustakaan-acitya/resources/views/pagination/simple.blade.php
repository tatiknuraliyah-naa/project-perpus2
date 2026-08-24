@if ($paginator->hasPages())
    <nav class="app-pagination" role="navigation" aria-label="Navigasi halaman">
        @if ($paginator->onFirstPage())
            <span class="pagination-control is-disabled" aria-disabled="true"><span aria-hidden="true">←</span><span class="pagination-label">Sebelumnya</span></span>
        @else
            <a class="pagination-control" href="{{ $paginator->previousPageUrl() }}" rel="prev"><span aria-hidden="true">←</span><span class="pagination-label">Sebelumnya</span></a>
        @endif

        @if ($paginator->hasMorePages())
            <a class="pagination-control" href="{{ $paginator->nextPageUrl() }}" rel="next"><span class="pagination-label">Berikutnya</span><span aria-hidden="true">→</span></a>
        @else
            <span class="pagination-control is-disabled" aria-disabled="true"><span class="pagination-label">Berikutnya</span><span aria-hidden="true">→</span></span>
        @endif
    </nav>
@endif
