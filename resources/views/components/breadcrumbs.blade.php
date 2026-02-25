<nav aria-label="breadcrumb" {{ $attributes ?? '' }}>
    <ol class="breadcrumb mb-0">
        @foreach($items as $index => $item)
            <li class="breadcrumb-item {{ $item['active'] ? 'active' : '' }}">
                @if(!$item['active'] || config('autocrumb.last_item_link', false))
                    <a href="{{ $item['url'] }}">{{ $item['label'] }}</a>
                @else
                    {{ $item['label'] }}
                @endif
            </li>

            @if(! $loop->last)
                <li class="breadcrumb-separator">{{ $separator }}</li>
            @endif
        @endforeach
    </ol>
</nav>