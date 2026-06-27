@php
    $awardSection = $awardSection ?? (isset($sections) ? $sections->get('award_grid') : null);
@endphp

@if ($awardSection?->is_active)
    <h3>{{ $awardSection->title ?: '我们的奖项' }}</h3>
    <div class="awards aw2024">
        @foreach ($awards as $award)
            <div @class(['aw-wide' => $loop->index < 2])>
                @if ($award->link_url)
                    <a href="{{ $pageUrl($award->link_url) }}" @if($isExternal($award->link_url)) target="_blank" rel="noopener" @endif>
                @endif
                    @if ($award->image)
                        <img src="{{ $assetUrl($award->image) }}" alt="{{ $award->title }}" height="87">
                    @endif
                    <p>{{ $award->title }}</p>
                @if ($award->link_url)
                    </a>
                @endif
            </div>
        @endforeach
    </div>
@endif
