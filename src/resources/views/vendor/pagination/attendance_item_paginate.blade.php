@if ($paginator->hasPages())
<div class="pagination">
    @if ($paginator->onFirstPage())
    <span class="page-link-prev"><</span>
    @else
    <a href="{{ $paginator->previousPageUrl() }}" class="page-link-prev"><</a>
    @endif

    @foreach ($elements as $element)
        @if (is_string($element))
            <span class="another-paginate">…</span>
        @endif
        @if (is_array($element))
            @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                <span class="current-paginate-page">{{ $page }}</span>
                @else
                <a href="{{ $url }}" class="another-paginate-page">{{ $page }}</a>
                @endif
            @endforeach
        @endif
    @endforeach

    @if ($paginator->hasMorePages())
        <a href="{{ $paginator->nextPageUrl() }}" class="page-link-next">></a>
    @else
        <span class="page-link-next">></span>
    @endif
</div>
@endif