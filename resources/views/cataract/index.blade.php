@extends('frontend.layout')

@section('body_id', 'cataract')
@section('title', $category->title)
@section('description', $category->description)

@section('content')
    <div class="full banner zoom">
        <div class="hero hero10" @if($category->hero_image_url) style="background-image: url('{{ $category->hero_image_url }}')" @endif></div>
        @if ($category->hero_title)<h1 class="tagline">{!! nl2br($category->hero_title) !!}</h1>@endif
    </div>
    <div class="row">
        <div class="pad centered fade-up">
            @if ($category->intro_title)<h1>{{ $category->intro_title }}</h1>@endif
            @if ($category->intro_description)<p>{!! nl2br(e($category->intro_description)) !!}</p>@endif
        </div>
    </div>
    <div class="row blue fade-up">
        <div class="col x2 pad5">
            @if ($category->symptom_image_url)<img class="ds" src="{{ $category->symptom_image_url }}" alt="{{ $category->symptom_title }}">@endif
        </div>
        <div class="col pad5">
            @if ($category->symptom_title)<h2>{{ $category->symptom_title }}</h2>@endif
            @if ($category->symptom_description)<p>{!! nl2br(e($category->symptom_description)) !!}</p>@endif
            @if ($category->symptoms)
                <ul class="disc">
                    @foreach (preg_split('/\r\n|\r|\n/', $category->symptoms) as $symptom)
                        @if (trim($symptom) !== '')<li>{{ trim($symptom) }}</li>@endif
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
    <div class="row zoom thumbs mint">
        <div class="col taL">
            <h1>{{ strip_tags($category->hero_title ?: $category->title) }}</h1>
        </div>
        @foreach ($services as $service)
            <div class="col">
                <a href="{{ url($service->slug . '.html') }}">
                    @if ($service->thumbnail_url)<img class="ds" src="{{ $service->thumbnail_url }}" alt="{{ $service->title }}">@endif
                </a>
                <h4>{{ $service->short_title ?: $service->title }}</h4>
            </div>
        @endforeach
    </div>
    @include('frontend.partials.contact-cta', ['cta' => $contactCta])
@endsection
