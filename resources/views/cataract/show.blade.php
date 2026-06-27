@extends('frontend.layout')

@section('body_id', 'cataract')
@section('title', $service->title)
@section('description', $service->summary)

@php
    $activeSections = $service->sections->where('is_active', true)->sortBy('sort_order');
    $rleLensSection = $service->slug === 'refractive-lens-exchange'
        ? $activeSections->firstWhere('title', '人工水晶体')
        : null;
    $rleProcedureSection = $service->slug === 'refractive-lens-exchange'
        ? $activeSections->firstWhere('title', '屈光性晶状体置换术程序')
        : null;
    $pageUrl = function (?string $url): string {
        if (blank($url) || $url === '#') {
            return '#';
        }

        if (str_starts_with($url, 'http://') || str_starts_with($url, 'https://') || str_starts_with($url, 'tel:') || str_starts_with($url, 'mailto:')) {
            return $url;
        }

        $clean = ltrim($url, '/');

        return url(str_ends_with($clean, '.html') ? $clean : $clean . '.html');
    };
@endphp

@section('content')
    <div class="banner zoom">
        <div class="hero hero26" @if($service->hero_image_url) style="background-image: url('{{ $service->hero_image_url }}')" @endif></div>
        <h1 class="tagline"><strong>白内障</strong>治疗</h1>
    </div>
    <div class="row">
        <div class="pad centered fade-up">
            <h4><a href="{{ url('cataract.html') }}">白内障治疗 /</a></h4>
            <h1>{!! nl2br(e($service->intro_title ?: $service->title)) !!}</h1>
            @if ($service->intro_description)<p>{!! nl2br(e($service->intro_description)) !!}</p>@endif
            @if ($service->button_text && $service->button_url)
                <p><a class="button" href="{{ $pageUrl($service->button_url) }}">{{ $service->button_text }}</a></p>
            @endif
            @if ($sections->get('intro_image')?->image_url)
                <img width="450" src="{{ $sections->get('intro_image')->image_url }}" alt="{{ $service->title }}">
                @if ($sections->get('intro_image')->description)<h5>{{ $sections->get('intro_image')->description }}</h5>@endif
            @endif
        </div>
    </div>

    @foreach ($activeSections as $section)
        @continue($section->type === 'intro_image')
        @if ($rleLensSection && $section->is($rleLensSection))
            <div class="row ds fade-up">
                <div class="col x15 pad">
                    @if ($rleLensSection->image_url)<img src="{{ $rleLensSection->image_url }}" alt="{{ $rleLensSection->title }}">@endif
                    @if ($rleLensSection->subtitle)<h5>{{ $rleLensSection->subtitle }}</h5>@endif
                    @if ($rleLensSection->title)<h2>{{ $rleLensSection->title }}</h2>@endif
                    @if ($rleLensSection->description)
                        @php
                            $lensLines = collect(preg_split('/\r\n|\r|\n/', $rleLensSection->description))
                                ->map(fn ($line) => trim($line))
                                ->filter()
                                ->values();
                            $lensIntro = $lensLines->shift();
                            $lensOptions = $lensLines->take(4);
                            $lensRemaining = $lensLines->slice(4)->values();
                            $lensHeading = $lensRemaining->shift();
                        @endphp

                        @if ($lensIntro)<p>{{ $lensIntro }}</p>@endif
                        @if ($lensOptions->isNotEmpty())
                            <ul class="disc">
                                @foreach ($lensOptions as $line)
                                    <li>{{ $line }}</li>
                                @endforeach
                            </ul>
                        @endif
                        @if ($lensHeading)<h3>{{ $lensHeading }}</h3>@endif
                        @foreach ($lensRemaining as $line)
                            <p>{{ $line }}</p>
                        @endforeach
                    @endif
                </div>

                @if ($rleProcedureSection)
                    <div class="col mint pad taC">
                        @if ($rleProcedureSection->title)<h2>{{ $rleProcedureSection->title }}</h2>@endif
                        @foreach ($rleProcedureSection->items->where('is_active', true)->sortBy('sort_order') as $item)
                            @if ($item->title)<h3>{{ $item->title }}</h3>@endif
                            @if ($item->description || $item->image_url)
                                <p>
                                    @if ($item->description){{ $item->description }}@endif
                                    @if ($item->image_url)<br><img width="320" src="{{ $item->image_url }}" alt="{{ $item->title }}">@endif
                                </p>
                            @endif
                        @endforeach
                    </div>
                @endif
            </div>
            @continue
        @endif
        @continue($rleProcedureSection && $section->is($rleProcedureSection))

        @if ($section->type === 'blue_columns')
            <div class="row blue">
                @foreach ($section->items->where('is_active', true)->sortBy('sort_order') as $item)
                    <div class="pad col pad5 fade-up">
                        @if ($item->title)<h2>{{ $item->title }}</h2>@endif
                        @if ($item->description)
                            <ul class="disc">
                                @foreach (preg_split('/\r\n|\r|\n/', $item->description) as $line)
                                    @if (trim($line) !== '')<li>{!! e(trim($line)) !!}</li>@endif
                                @endforeach
                            </ul>
                        @endif
                        @if ($item->icon)<p><a class="button3" href="{{ asset($item->icon) }}" target="_blank" rel="noopener">下载手册 (PDF)</a></p>@endif
                    </div>
                @endforeach
            </div>
        @elseif ($section->items->isNotEmpty())
            <div class="row taC flex-td fade-up">
                @if ($section->title)
                    <div class="centered blue pad"><h2 class="mb0">{{ $section->title }}</h2></div>
                @endif
                @foreach ($section->items->where('is_active', true)->sortBy('sort_order') as $item)
                    <div class="col {{ $loop->even ? 'mint' : '' }} pad">
                        @if ($item->title)<h2>{{ $item->title }}</h2>@endif
                        @if ($item->image_url)<p><img width="320" src="{{ $item->image_url }}" alt="{{ $item->title }}"></p>@endif
                        @if ($item->description)<p>{!! nl2br(e($item->description)) !!}</p>@endif
                    </div>
                @endforeach
            </div>
        @else
            <div class="row {{ $section->type === 'mint' ? 'mint' : '' }} fade-up">
                <div class="col x15 pad">
                    @if ($section->image_url)<img src="{{ $section->image_url }}" alt="{{ $section->title }}">@endif
                    @if ($section->title)<h2>{{ $section->title }}</h2>@endif
                    @if ($section->subtitle)<h3>{{ $section->subtitle }}</h3>@endif
                    @if ($section->description)<p>{!! nl2br(e($section->description)) !!}</p>@endif
                </div>
            </div>
        @endif
    @endforeach

    @include('frontend.partials.contact-cta', [
        'cta' => $contactCta,
        'variant' => 'form',
        'defaultTreatment' => $service->category?->title,
    ])
@endsection
