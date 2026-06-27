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
    $pageTitle = trim($__env->yieldContent('title')) ?: ($page->seo_title ?? $home->seo_title ?? $settings?->site_name ?? config('app.name'));
    $pageDescription = trim($__env->yieldContent('description')) ?: ($page->seo_description ?? $home->seo_description ?? '');
@endphp
<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="utf-8">
    <title>{{ $pageTitle }}</title>
    <meta name="description" content="{{ $pageDescription }}">
    <meta name="theme-color" content="#0C1638">
    <meta name="color-scheme" content="only light">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('static/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('static/css/zh.css') }}">
    <link rel="stylesheet" href="{{ asset('static/css/intlTelInput.css') }}">
    <link rel="icon" type="image/png" href="{{ asset('static/picture/logo-white.png') }}">
    @stack('styles')
    <script src="{{ asset('static/js/flickity.js') }}"></script>
</head>
<body id="@yield('body_id', 'page')">
@include('frontend.partials.header')

<div class="container main">
    @yield('content')

    @include('frontend.partials.footer')
</div>

<script src="{{ asset('static/js/plugins.js') }}"></script>
@stack('scripts')
</body>
</html>
