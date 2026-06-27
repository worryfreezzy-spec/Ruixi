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

    $hero = $sections->get('doctors_hero');
    $intro = $sections->get('doctors_intro');
@endphp

@section('content')
    @if ($hero?->is_active)
        <div class="banner zoom">
            <div class="hero hero8" @if($hero->image) style="background-image: url('{{ $assetUrl($hero->image) }}')" @endif></div>
            @if ($hero->title)<h1 class="tagline">{!! nl2br(e($hero->title)) !!}</h1>@endif
        </div>
    @endif

    @if ($intro?->is_active)
        <div class="row fade-up">
            <div class="centered pad pb0">
                @if ($intro->title)<h1>{!! nl2br(e($intro->title)) !!}</h1>@endif
                @if ($intro->description)<p>{!! nl2br(e($intro->description)) !!}</p>@endif
            </div>
        </div>
    @endif

    @foreach ($doctors->chunk(4) as $doctorRow)
        <div class="row thumbs fade-up">
            @foreach ($doctorRow as $doctor)
                <div class="col">
                    <a href="{{ url($doctor->slug . '.html') }}">
                        @if ($doctor->photo_url)
                            <img src="{{ $doctor->photo_url }}" alt="{{ $doctor->name }}">
                        @endif
                    </a>
                    <h4>{{ $doctor->name }}</h4>
                    <p>
                        {!! nl2br(e($doctor->qualification)) !!}
                        @if ($doctor->branches)
                            <br><strong><span class="branch">分行</span>: {{ $doctor->branches }}</strong>
                        @endif
                    </p>
                </div>
            @endforeach

            @for ($i = $doctorRow->count(); $i < 4; $i++)
                <div class="col"></div>
            @endfor
        </div>
    @endforeach
@endsection
