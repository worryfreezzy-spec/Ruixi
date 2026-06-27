@php
    $logoSection = $logoSection ?? (isset($sections) ? $sections->get('logo_grid') : null);
@endphp

@if ($logoSection?->is_active)
    <div class="partners">
        <h3>{{ $logoSection->title ?: '保险 & TPA*' }}</h3>
        @foreach ($partners as $partner)
            @if ($partner->logo)
                @if ($partner->url)
                    <a href="{{ $pageUrl($partner->url) }}" @if($isExternal($partner->url)) target="_blank" rel="noopener" @endif>
                @endif
                    <img src="{{ $assetUrl($partner->logo) }}" alt="{{ $partner->name }}" @class(['pmcare' => in_array($partner->name, ['MiCare', 'PM Care'])])>
                @if ($partner->url)
                    </a>
                @endif
            @endif
        @endforeach
        @if ($logoSection->description)<h6>{{ $logoSection->description }}</h6>@endif
    </div>
@endif
