@extends('frontend.layout')

@section('body_id', 'others')
@section('title', $disease->title)
@section('description', $disease->summary)

@php
    $introImageSection = $sections->firstWhere('type', 'intro_image');
@endphp

@section('content')
    <div class="banner zoom">
        <div class="hero hero29" @if($disease->hero_image_url) style="background-image: url('{{ $disease->hero_image_url }}')" @endif></div>
        <h1 class="tagline"><strong>{{ $disease->short_title ?: $disease->title }}</strong></h1>
    </div>

    <div class="row fade-up">
        <div class="centered pad">
            <h4><a href="{{ url('eye-diseases-management.html') }}">眼睛疾病及其他眼疾状况的管理 /</a></h4>
            @if ($disease->intro_title)<h1>{!! $disease->intro_title !!}</h1>@endif
            @if ($disease->intro_description)<p>{!! nl2br(e($disease->intro_description)) !!}</p>@endif
            @if ($introImageSection?->image_url)<p><img width="460" src="{{ $introImageSection->image_url }}" alt="{{ $disease->short_title ?: $disease->title }}"></p>@endif
            @if ($disease->benefits_title)<h5>{{ $disease->benefits_title }}</h5>@endif
        </div>
    </div>

    @foreach ($sections as $section)
        @continue($section->type === 'intro_image')

        @if ($section->type === 'two_column')
            <div class="row ds fade-up">
                <div class="col ds pad">
                    @if ($section->title)<h2>{!! $section->title !!}</h2>@endif
                    @foreach (preg_split('/\r\n|\r|\n/', (string) $section->description) as $line)
                        @php $line = trim($line); @endphp
                        @continue($line === '')

                        @if (str_starts_with($line, '## '))
                            <h3>{!! substr($line, 3) !!}</h3>
                        @elseif (str_starts_with($line, '# '))
                            <h2>{!! substr($line, 2) !!}</h2>
                        @elseif (str_starts_with($line, '- '))
                            <ul class="disc"><li>{{ substr($line, 2) }}</li></ul>
                        @elseif (str_starts_with($line, '[button]'))
                            @continue
                        @else
                            <p>{!! $line !!}</p>
                        @endif
                    @endforeach
                    @if ($disease->brochure_pdf_url)
                        <p>
                            <a href="{{ $disease->brochure_pdf_url }}" target="_blank" rel="noopener" download style="display:inline-flex;align-items:center;justify-content:center;min-height:44px;padding:0 24px;border-radius:999px;background:#00a9c8;color:#fff;font-weight:700;text-decoration:none;letter-spacing:0;border:0;box-shadow:0 8px 18px rgba(0, 169, 200, .22);">
                                下载手册 (PDF)
                            </a>
                        </p>
                    @endif
                </div>

                @foreach ($section->items->where('is_active', true)->sortBy('sort_order') as $item)
                    <div class="col mint">
                        @if ($item->image_url)<img src="{{ $item->image_url }}" alt="{{ $item->title }}">@endif
                        <div class="pad">
                            @if ($item->title)<h2>{!! $item->title !!}</h2>@endif
                            @foreach (preg_split('/\r\n|\r|\n/', (string) $item->description) as $line)
                                @php $line = trim($line); @endphp
                                @continue($line === '')

                                @if (str_starts_with($line, '- '))
                                    <ul class="disc"><li>{{ substr($line, 2) }}</li></ul>
                                @else
                                    <p>{!! $line !!}</p>
                                @endif
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="row fade-up">
                <div class="centered pad">
                    @if ($section->title)<h2>{!! $section->title !!}</h2>@endif
                    @if ($section->description)<p>{!! nl2br(e($section->description)) !!}</p>@endif
                    @if ($section->image_url)<p><img src="{{ $section->image_url }}" alt="{{ $section->title }}"></p>@endif
                </div>
            </div>
        @endif
    @endforeach

    @include('frontend.partials.contact-cta', ['cta' => $contactCta])
@endsection
