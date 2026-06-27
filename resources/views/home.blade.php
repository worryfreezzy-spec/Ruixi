@extends('frontend.layout')

@section('body_id', 'home')
@section('title', $home->seo_title ?: ($settings?->site_name ?: $home->title))
@section('description', $home->seo_description)

@php
    $assetUrl = function (?string $path): string {
        if (blank($path)) {
            return '';
        }

        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://') || str_starts_with($path, 'tel:') || str_starts_with($path, 'mailto:')) {
            return $path;
        }

        $clean = ltrim($path, '/');

        if (str_starts_with($clean, 'static/')) {
            return asset($clean);
        }

        return asset('storage/' . $clean);
    };

    $pageUrl = function (?string $url): string {
        if (blank($url) || $url === '#') {
            return '#';
        }

        if (str_starts_with($url, 'http://') || str_starts_with($url, 'https://') || str_starts_with($url, 'tel:') || str_starts_with($url, 'mailto:')) {
            return $url;
        }

        if ($url === '/') {
            return url('/');
        }

        $clean = ltrim($url, '/');

        if (str_contains($clean, '#')) {
            [$path, $fragment] = explode('#', $clean, 2);
            $suffix = $path !== '' && ! str_ends_with($path, '.html') ? '.html' : '';

            return url($path . $suffix . '#' . $fragment);
        }

        return url(str_ends_with($clean, '.html') ? $clean : $clean . '.html');
    };

    $activeItems = fn ($items) => collect($items)->where('is_active', true)->sortBy('sort_order');
    $isExternal = fn (?string $url): bool => filled($url) && (str_starts_with($url, 'http://') || str_starts_with($url, 'https://'));
    $intro = $sections->get('intro_text_image');
    $feature = $sections->get('feature_grid');
    $treatment = $sections->get('treatment_highlight');
    $payment = $sections->get('payment_plan');
    $awardSection = $sections->get('award_grid');
    $logoSection = $sections->get('logo_grid');
    $treatmentBackground = $treatment?->background_image ? $assetUrl($treatment->background_image) : null;
@endphp

@section('content')
    @if ($heroItems->isNotEmpty())
        <div class="caro fade">
            @foreach ($heroItems as $item)
                <div class="cell">
                    <a href="{{ $pageUrl($item->link_url) }}" @if($isExternal($item->link_url)) target="_blank" rel="noopener" @endif>
                        <picture>
                            <img
                                src="{{ $assetUrl($item->image) }}"
                                alt="{{ $item->title }}"
                                width="1920"
                                height="900"
                                @if(! $loop->first) loading="lazy" @else fetchpriority="high" @endif
                            >
                        </picture>
                    </a>
                </div>
            @endforeach
        </div>
    @endif

    <div class="row">
        @if ($intro?->is_active)
            <div class="pad centered fade-up">
                @if ($intro->title)<h1>{!! nl2br(e($intro->title)) !!}</h1>@endif
                @if ($intro->description)<p>{!! nl2br(e($intro->description)) !!}</p>@endif
                @if ($intro->button_text && $intro->button_url)
                    <br><a class="button" href="{{ $pageUrl($intro->button_url) }}">{{ $intro->button_text }}</a>
                @endif
            </div>
        @endif

        @include('frontend.partials.why-choose-us', [
            'section' => $feature,
            'items' => $featureItems,
            'assetUrl' => $assetUrl,
        ])
    </div>

    @if ($treatment?->is_active)
        <div class="row fade-up">
            <div
                class="col prop talks"
                @if($treatmentBackground) style="background-image: url('{{ $treatmentBackground }}'); background-size: cover; background-position: center;" @endif
            ></div>
            <div class="col pad5">
                @if ($treatment->subtitle)<h4>{{ $treatment->subtitle }}</h4>@endif
                @if ($treatment->title)<h1>{{ $treatment->title }}</h1>@endif
                @if ($treatment->description)<p>{!! nl2br(e($treatment->description)) !!}</p>@endif
                @if ($treatment->button_text && $treatment->button_url)
                    <p><a class="button" href="{{ $pageUrl($treatment->button_url) }}">{{ $treatment->button_text }}</a></p>
                @endif
            </div>
        </div>
    @endif

    @if ($payment?->is_active)
        <div class="row fade-up">
            <div class="col pad5 blue mobi-ds">
                @if ($payment->subtitle)<h4>{{ $payment->subtitle }}</h4>@endif
                @if ($payment->title)<h1>{!! nl2br(e($payment->title)) !!}</h1>@endif
                @if ($payment->description)<p>{!! nl2br(e($payment->description)) !!}</p>@endif
                @if ($payment->button_text && $payment->button_url)
                    <br><a class="button3" href="{{ $pageUrl($payment->button_url) }}">{{ $payment->button_text }}</a>
                @endif
            </div>
            <div class="col prop meet-doc x15"></div>
        </div>
    @endif
@endsection

@push('scripts')
    <script>
        var elem = document.querySelector('.caro');
        if (elem) {
            new Flickity(elem, {
                cellSelector: '.cell',
                cellAlign: 'left',
                autoPlay: 6500,
                contain: true,
                pageDots: true
            });
        }
    </script>
@endpush
