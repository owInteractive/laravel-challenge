@if ($paginator->hasPages())
    <ul class="mt-4 flex">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="inline m-1 bg-white text-gray-500 w-6 h-8 rounded flex flex-col justify-center text-center"><span>&laquo;</span></li>
        @else
            <li class="inline m-1 hover:bg-blue-600 bg-white hover:text-white w-6 h-8 rounded flex flex-col justify-center text-center"><a href="{{ $paginator->previousPageUrl() }}" rel="prev">&laquo;</a></li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="inline m-1 hover:bg-blue-600 bg-white hover:text-white w-6 h-8 rounded flex flex-col justify-center text-center"><span>{{ $element }}</span></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="inline m-1 bg-blue-600 text-white w-6 h-8 rounded flex flex-col justify-center text-center"><span>{{ $page }}</span></li>
                    @else
                        <li class="inline m-1 hover:bg-blue-600 bg-white hover:text-white w-6 h-8 rounded flex flex-col justify-center text-center"><a href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li class="inline m-1 hover:bg-blue-600 bg-white hover:text-white w-6 h-8 rounded flex flex-col justify-center text-center"><a href="{{ $paginator->nextPageUrl() }}" rel="next">&raquo;</a></li>
        @else
            <li class="inline m-1 bg-white text-gray-500 w-6 h-8 rounded flex flex-col justify-center text-center"><span>&raquo;</span></li>
        @endif
    </ul>
@endif
