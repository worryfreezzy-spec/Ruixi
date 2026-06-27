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

        return url(str_ends_with($clean, '.html') ? $clean : $clean . '.html');
    };

    $hero = $sections->get('about_hero');
    $intro = $sections->get('about_intro');
    $humble = $sections->get('about_humble');
    $innovation = $sections->get('about_innovation');
    $people = $sections->get('about_people');
@endphp

@section('content')
    @if ($hero?->is_active)
        <div class="full banner zoom">
            <div class="hero hero4" @if($hero->image) style="background-image: url('{{ $assetUrl($hero->image) }}')" @endif></div>
            @if ($hero->title)<h1 class="tagline">{!! nl2br(e($hero->title)) !!}</h1>@endif
        </div>
    @endif

    @if ($intro?->is_active)
        <div class="row">
            <div class="pad centered fade-up">
                @if ($intro->title)<h1>{!! nl2br(e($intro->title)) !!}</h1>@endif
                @if ($intro->description)<div>{!! nl2br(e($intro->description)) !!}</div>@endif
            </div>
        </div>
    @endif

    @if ($humble?->is_active)
        <div class="row blue fade-up">
            @if ($humble->title)<h2 class="xx taC" style="padding: 3rem 2rem 0;">{!! nl2br(e($humble->title)) !!}</h2>@endif
            <div class="col pad">
                @if ($humble->image)
                    <div class="ds"><img src="{{ $assetUrl($humble->image) }}" alt="{{ $humble->title }}"></div>
                @endif
            </div>
            <div class="col pad">
                @if ($humble->subtitle)<h3>{!! nl2br(e($humble->subtitle)) !!}</h3>@endif
                @if ($humble->description)<div>{!! nl2br(e($humble->description)) !!}</div>@endif
            </div>
        </div>
    @endif

    @if ($innovation?->is_active)
        <div class="row fade-up">
            <div class="col pad5 x15">
                @if ($innovation->title)<h2>{!! nl2br(e($innovation->title)) !!}</h2>@endif
                @if ($innovation->subtitle)<h3>{!! nl2br(e($innovation->subtitle)) !!}</h3>@endif
                @if ($innovation->description)<div>{!! nl2br(e($innovation->description)) !!}</div>@endif
                @if ($innovation->button_text && $innovation->button_url)
                    <a class="button" href="{{ $pageUrl($innovation->button_url) }}">{{ $innovation->button_text }}</a>
                @endif
            </div>
            <div class="col prop bg-scan" @if($innovation->image) style="background-image: url('{{ $assetUrl($innovation->image) }}')" @endif></div>
        </div>
    @endif

    @if ($people?->is_active)
        <div class="row inv olay seniors aos-init fade-up" @if($people->image) style="background-image: url('{{ $assetUrl($people->image) }}')" @endif>
            <div class="col pad5">
                @if ($people->title)<h2>{!! nl2br(e($people->title)) !!}</h2>@endif
                @if ($people->subtitle)<h3>{!! nl2br(e($people->subtitle)) !!}</h3>@endif
                @if ($people->description)<div>{!! nl2br(e($people->description)) !!}</div>@endif
            </div>
        </div>
    @endif
@endsection
