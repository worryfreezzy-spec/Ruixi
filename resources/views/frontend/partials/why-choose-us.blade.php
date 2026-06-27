@props([
    'section' => null,
    'items' => collect(),
    'assetUrl' => null,
])

@php
    $activeItems = collect($items)->where('is_active', true)->sortBy('sort_order');
    $resolveAssetUrl = $assetUrl ?? function (?string $path): string {
        if (blank($path)) {
            return '';
        }

        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
            return $path;
        }

        $clean = ltrim($path, '/');

        if (str_starts_with($clean, 'static/')) {
            return asset($clean);
        }

        return asset('storage/' . $clean);
    };
    $background = $section?->background_image ? $resolveAssetUrl($section->background_image) : null;
@endphp

@if ($section?->is_active)
    <div
        class="pad centered mint fig-up fade-up"
        @if($background) style="background-image: url('{{ $background }}'); background-size: cover; background-position: center;" @endif
    >
        <h1>{{ $section->title ?: '为什么选择我们' }}</h1>
        <div class="fig-up">
            @foreach ($activeItems as $item)
                <figure>
                    @if ($item->icon)
                        <img src="{{ $resolveAssetUrl($item->icon) }}" alt="{{ $item->title }}">
                    @endif
                    <figcaption>{{ $item->title }}</figcaption>
                </figure>
            @endforeach
        </div>
        <h6>* 我们的Vision For Life计划保证您终生的LASIK视觉效果</h6>
    </div>
@endif
