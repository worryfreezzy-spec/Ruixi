@extends('frontend.layout')

@section('body_id', 'about')
@section('title', $page->seo_title ?: $page->title)
@section('description', $page->seo_description ?: $page->summary)

@php
    $assetUrl = function (?string $path): string {
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

    $hero = $sections->get('ceo_hero');
    $profile = $sections->get('ceo_profile');
    $heroImage = $hero?->image ? ltrim($hero->image, '/') : '';
    $usesDefaultSandyHero = in_array($heroImage, [
        'about/ceo.webp',
        'about/ceo@2x.webp',
        'static/image/ceo.webp',
        'static/image/ceo@2x.webp',
    ], true);
@endphp

@section('content')
    @if ($hero?->is_active)
        <div class="full banner zoom">
            <div class="hero sandy" @if($heroImage && ! $usesDefaultSandyHero) style="background-image: url('{{ $assetUrl($heroImage) }}')" @endif></div>
            @if ($hero->title)<h1 class="tagline">{!! nl2br(e($hero->title)) !!}</h1>@endif
        </div>
    @endif

    @if ($profile?->is_active)
        <div class="row">
            <div class="pad centered fade-up">
                @if ($profile->title)<h1>{!! nl2br(e($profile->title)) !!}</h1>@endif
                @if ($profile->subtitle)<h3>{!! nl2br(e($profile->subtitle)) !!}</h3>@endif
                @if ($profile->description)<div>{!! nl2br(e($profile->description)) !!}</div>@endif
            </div>
        </div>
    @endif
@endsection
