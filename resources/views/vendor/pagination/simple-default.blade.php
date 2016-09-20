@if ($paginator->hasPages())
    <ul class="pager">
        <!-- Previous Page Link -->
        @if ($paginator->onFirstPage())
            <li class="disabled"><span>{{ trans('general.paginator-previous') }}</span></li>
        @else
            <li><a href="{{ $paginator->previousPageUrl() }}" rel="prev">{{ trans('general.paginator-previous')
            }}</a></li>
        @endif

        <!-- Next Page Link -->
        @if ($paginator->hasMorePages())
            <li><a href="{{ $paginator->nextPageUrl() }}" rel="next">{{ trans('general.paginator-next') }}</a></li>
        @else
            <li class="disabled"><span>{{ trans('general.paginator-next') }}</span></li>
        @endif
    </ul>
@endif