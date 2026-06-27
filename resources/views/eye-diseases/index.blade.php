@extends('frontend.layout')

@section('body_id', 'others')
@section('title', $category->title)
@section('description', $category->description)

@section('content')
    <div class="full banner zoom">
        <div class="hero hero30" @if($category->hero_image_url) style="background-image: url('{{ $category->hero_image_url }}')" @endif></div>
        @if ($category->hero_title)<h1 class="tagline">{{ $category->hero_title }}</h1>@endif
    </div>

    <div class="centered pad">
        @if ($category->intro_title)<h1>{{ $category->intro_title }}</h1>@endif
        @if ($category->intro_description)<p>{!! nl2br(e($category->intro_description)) !!}</p>@endif
    </div>

    @foreach ($diseases->chunk(3) as $row)
        <div class="row {{ $loop->odd ? 'mint ' : '' }}zoom thumbs fade-up">
            @foreach ($row as $disease)
                <div class="col">
                    <a href="{{ url($disease->slug . '.html') }}">
                        @if ($disease->thumbnail_url)<img class="ds" src="{{ $disease->thumbnail_url }}" alt="{{ $disease->short_title ?: $disease->title }}">@endif
                    </a>
                    <h4>{{ $disease->short_title ?: $disease->title }}</h4>
                </div>
            @endforeach
        </div>
    @endforeach
@endsection
