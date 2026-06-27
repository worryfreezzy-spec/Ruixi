@extends('frontend.layout')

@section('body_id', 'others')
@section('title', $page->title)
@section('description', $page->summary)

@section('content')
    <div class="full banner zoom">
        <div class="hero hero35" @if($page->hero_image_url) style="background-image: url('{{ $page->hero_image_url }}')" @endif></div>
        @if ($page->hero_title)<h1 class="tagline">{!! $page->hero_title !!}</h1>@endif
    </div>

    <div class="row">
        <div class="pad centered fade-up" style="padding-bottom: 0">
            @if ($page->breadcrumb_title)<h4>{{ $page->breadcrumb_title }}</h4>@endif
            <h1>{!! $page->title !!}</h1>
            @if ($page->summary)<p>{!! nl2br(e($page->summary)) !!}</p>@endif
            @if ($serviceSection?->title)<h2 class="xx taC">{!! $serviceSection->title !!}</h2>@endif
        </div>
    </div>

    @foreach ($services->chunk(3) as $row)
        <div class="row thumbs zoom pb0 pt0">
            @foreach ($row as $item)
                <div class="col">
                    <a href="{{ $item->button_url ?: '#0' }}">
                        @if ($item->image_url)<img src="{{ $item->image_url }}" alt="{{ $item->title }}" class="ds">@endif
                        @if ($item->title)<h4>{!! $item->title !!}</h4>@endif
                        @if ($item->description)<p>{!! nl2br(e($item->description)) !!}</p>@endif
                    </a>
                </div>
            @endforeach
        </div>
    @endforeach

    @include('frontend.partials.contact-cta', ['cta' => $contactCta])
@endsection
