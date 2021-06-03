@if ($paginator->hasPages())
    <div class="pagination {{ isset($parent) ? $parent . '__pagination' : null }}">
        <ul class="lists pagination__lists">

            @if (!$paginator->onFirstPage())
                <li class="pagination__element">
                    <a class="links pagination__links pagination__links--none-active"
                        href="{{ $paginator->previousPageUrl() }}">
                        <span role="img" class="icons icons--small links__icons fas fa-chevron-left"
                            aria-label="Poprzednia strona"></span>
                    </a>
                </li>
            @endif

            @foreach ($elements as $element)
                {{-- Three dots --}}
                @if (is_string($element))
                    <li class="pagination__element pagination__element--disabled">
                        {{ $element }}
                    </li>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="pagination__element">
                                <span
                                    class="links pagination__links pagination__links--active">{{ $page }}</span>
                            </li>
                        @else
                            <li class="pagination__element">
                                <a href="{{ $url }}"
                                    class="links pagination__links pagination__links--none-active">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif

            @endforeach

            @if ($paginator->hasMorePages())
                <li class="pagination__element">
                    <a class="links pagination__links pagination__links--none-active"
                        href="{{ $paginator->nextPageUrl() }}">
                        <span role="img" class="icons icons--small links__icons fas fa-chevron-right"
                            aria-label="Następna strona"></span>
                    </a>
                </li>
            @endif
        </ul>


    </div>
@endif
