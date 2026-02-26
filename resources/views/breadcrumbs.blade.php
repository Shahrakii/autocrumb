<nav aria-label="breadcrumb">
    <ol class="breadcrumb mb-0">
        @forelse($breadcrumbs ?? [] as $crumb)
            <li class="breadcrumb-item {{ $crumb['active'] ? 'active' : '' }}">
                @if ($crumb['active'] && !config('autocrumb.last_item_link', false))
                    {{ $crumb['label'] ?? '—' }}
                @else
                    <a href="{{ $crumb['url'] ?? '#' }}">{{ $crumb['label'] ?? '—' }}</a>
                @endif
            </li>

            @if (!$loop->last)
                <span class="mx-2">{{ $separator ?? ' / ' }}</span>
            @endif
        @empty
            <li class="breadcrumb-item text-muted">بدون مسیر</li>
        @endforelse
    </ol>
</nav>