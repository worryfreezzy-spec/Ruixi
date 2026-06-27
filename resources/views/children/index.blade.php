@extends('frontend.layout')

@section('body_id', 'others')
@section('title', $category->title)
@section('description', $category->description)

@php
    $heroImage = $category->hero_image;
    $useCustomHero = filled($heroImage) && ! in_array(ltrim($heroImage, '/'), ['static/image/hero20.jpg', 'static/image/hero20@2x.jpg'], true);
@endphp

@section('content')
    <div class="full banner zoom">
        <div class="hero hero20" @if($useCustomHero && $category->hero_image_url) style="background-image: url('{{ $category->hero_image_url }}')" @endif></div>
        @if ($category->hero_title)<h1 class="tagline">{!! $category->hero_title !!}</h1>@endif
    </div>

    <div class="row">
        <div class="pad centered fade-up">
            @if ($category->intro_title)<h1>{!! $category->intro_title !!}</h1>@endif
            @if ($category->intro_description)<p>{!! nl2br(e($category->intro_description)) !!}</p>@endif
        </div>
    </div>

    @foreach ($children->chunk(3) as $row)
        <div class="row {{ $loop->odd ? 'mint ' : 'mint ' }}zoom thumbs fade-up">
            @foreach ($row as $child)
                <div class="col">
                    <a href="{{ url($child->slug . '.html') }}">
                        @if ($child->thumbnail_url)<img class="ds" src="{{ $child->thumbnail_url }}" alt="{{ $child->short_title ?: $child->title }}">@endif
                        <h4>{!! $child->short_title ?: $child->title !!}</h4>
                    </a>
                </div>
            @endforeach
        </div>
    @endforeach

    @include('frontend.partials.contact-cta', ['cta' => $contactCta])
@endsection
