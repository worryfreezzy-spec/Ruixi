@extends('frontend.layout')

@section('body_id', 'lasik')
@section('title', $category->title)
@section('description', $category->description)

@php
    $heroImage = $category->hero_image;
    $useCustomHero = filled($heroImage) && ! in_array(ltrim($heroImage, '/'), ['static/image/hero12.jpg', 'static/image/hero12@2x.jpg'], true);
@endphp

@section('content')
    <div class="full banner zoom">
        <div class="hero hero12" @if($useCustomHero && $category->hero_image_url) style="background-image: url('{{ $category->hero_image_url }}')" @endif></div>
        @if ($category->hero_title)<h1 class="tagline">{{ $category->hero_title }}</h1>@endif
    </div>

    <div class="row fade-up">
        <div class="centered pad">
            @if ($category->intro_title)<h1>{{ $category->intro_title }}</h1>@endif
            @if ($category->intro_description)<h4>{!! nl2br(e($category->intro_description)) !!}</h4>@endif
            @if ($category->description)<p>{!! nl2br(e($category->description)) !!}</p>@endif
        </div>
    </div>

    @foreach ($services->chunk(3) as $row)
        <div class="row {{ $loop->odd ? '' : 'mint ' }}zoom thumbs fade-up">
            @foreach ($row as $service)
                <div class="col">
                    <a href="{{ str_starts_with($service->slug, 'http') ? $service->slug : url($service->slug . '.html') }}" @if(str_starts_with($service->slug, 'http')) target="_blank" rel="noopener" @endif>
                        @if ($service->thumbnail_url)<img class="ds" src="{{ $service->thumbnail_url }}" alt="{{ $service->short_title ?: $service->title }}">@endif
                        <h4>{!! $service->short_title ?: $service->title !!}</h4>
                    </a>
                </div>
            @endforeach
        </div>
    @endforeach

    @include('frontend.partials.contact-cta', [
        'cta' => $contactCta,
        'variant' => 'form',
        'defaultTreatment' => $category->title,
    ])
@endsection
