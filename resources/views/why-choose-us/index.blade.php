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

    $hero = $sections->get('why_choose_hero');
@endphp

@section('content')
    @if ($hero?->is_active)
        <div class="banner zoom">
            <div class="hero hero9" @if($hero->image) style="background-image: url('{{ $assetUrl($hero->image) }}')" @endif></div>
            @if ($hero->title)<h1 class="tagline">{!! nl2br(e($hero->title)) !!}</h1>@endif
        </div>
    @endif

    @include('frontend.partials.why-choose-us', [
        'section' => $iconSection,
        'items' => $iconItems,
        'assetUrl' => $assetUrl,
    ])

    @if ($advantageSection?->is_active)
        <div class="row mint">
            <article class="pad5">
                @if ($advantageSection->title)<h1>{!! nl2br(e($advantageSection->title)) !!}</h1>@endif
                @if ($advantageSection->subtitle)<h3>{!! nl2br(e($advantageSection->subtitle)) !!}</h3>@endif
                <ol>
                    @foreach (collect($advantages)->where('is_active', true)->sortBy('sort_order') as $advantage)
                        <li>
                            @if ($advantage->title)<strong>{{ $advantage->title }}</strong>@endif
                            @if ($advantage->description)<br>{!! nl2br(e($advantage->description)) !!}@endif
                        </li>
                    @endforeach
                </ol>
            </article>
        </div>
    @endif
@endsection
