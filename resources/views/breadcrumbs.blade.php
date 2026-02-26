<nav aria-label="breadcrumb" style="
    display: inline-flex;
    align-items: center;
    background: linear-gradient(135deg, #1e293b, #0f172a);
    border: 1px solid rgba(255,255,255,0.08);
    border-radius: 12px;
    padding: 10px 18px;
    font-family: 'Vazirmatn', 'Segoe UI', Tahoma, sans-serif;
    direction: rtl;
    box-shadow: 0 4px 20px rgba(0,0,0,0.3);
">
    <ol style="
        list-style: none;
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 4px;
        margin: 0;
        padding: 0;
    ">
        @forelse($items ?? [] as $crumb)
            <li style="display: flex; align-items: center; gap: 4px;">

                @if($crumb['active'])
                    <span style="
                        color: #f8fafc;
                        font-size: 13px;
                        font-weight: 700;
                        padding: 4px 10px;
                        background: rgba(99,102,241,0.2);
                        border: 1px solid rgba(99,102,241,0.4);
                        border-radius: 8px;
                    ">{{ $crumb['label'] ?? '—' }}</span>
                @else
                    <a href="{{ $crumb['url'] ?? '#' }}" style="
                        color: #94a3b8;
                        font-size: 13px;
                        font-weight: 500;
                        text-decoration: none;
                        padding: 4px 10px;
                        border-radius: 8px;
                        transition: all 0.2s;
                    "
                    onmouseover="this.style.color='#f8fafc';this.style.background='rgba(255,255,255,0.07)'"
                    onmouseout="this.style.color='#94a3b8';this.style.background='transparent'"
                    >{{ $crumb['label'] ?? '—' }}</a>
                @endif

                @if(!$loop->last)
                    <span style="color: #334155; font-size: 12px; margin: 0 2px;">
                        {!! $separator ?? '›' !!}
                    </span>
                @endif

            </li>
        @empty
            <li style="color: #475569; font-size: 13px;">بدون مسیر</li>
        @endforelse
    </ol>
</nav>