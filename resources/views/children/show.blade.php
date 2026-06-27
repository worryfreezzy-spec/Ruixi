@extends('frontend.layout')

@section('body_id', 'others')
@section('title', $child->title)
@section('description', $child->summary)

@php
    $heroImage = $child->hero_image;
    $useCustomHero = filled($heroImage) && ! in_array(ltrim($heroImage, '/'), ['static/image/hero21.jpg', 'static/image/hero21@2x.jpg'], true);

    if (! function_exists('renderChildLines')) {
        function renderChildLines(?string $content): string {
            $html = '';
            $listItems = [];
            $flushList = static function () use (&$html, &$listItems): void {
                if ($listItems === []) {
                    return;
                }

                $html .= '<ul class="disc"><li>' . implode('</li><li>', $listItems) . '</li></ul>';
                $listItems = [];
            };

            foreach (preg_split('/\r\n|\r|\n/', (string) $content) as $line) {
                $line = trim($line);
                if ($line === '') {
                    continue;
                }

                if (str_starts_with($line, '- ')) {
                    $listItems[] = e(substr($line, 2));
                    continue;
                }

                $flushList();
                $html .= '<p>' . $line . '</p>';
            }

            $flushList();

            return $html;
        }
    }
@endphp

@section('content')
    <div class="banner zoom">
        <div class="hero hero21" @if($useCustomHero && $child->hero_image_url) style="background-image: url('{{ $child->hero_image_url }}')" @endif></div>
        <h1 class="tagline"><strong>{!! $child->short_title ?: $child->title !!}</strong></h1>
    </div>

    <div class="row">
        <div class="pad centered fade-up">
            <h4><a href="{{ url('kids.html') }}">儿童视力与眼睛保健 /</a></h4>
            @if ($child->intro_title)<h1>{!! $child->intro_title !!}</h1>@endif
            @if ($child->intro_description)<p>{!! nl2br(e($child->intro_description)) !!}</p>@endif
        </div>
    </div>

    @foreach ($sections as $section)
        @php $isImageLeft = $section->type === 'image_left_blue'; @endphp

        <div class="row {{ $isImageLeft ? 'blue' : 'mint' }} fade-up">
            @if ($isImageLeft && $section->image_url)
                <div class="col pad5 prop" style="background-image: url('{{ $section->image_url }}');"></div>
            @endif

            <div class="col pad5">
                @if ($section->title)<h2>{!! $section->title !!}</h2>@endif
                @if ($section->description){!! renderChildLines($section->description) !!}@endif
            </div>

            @if (! $isImageLeft && $section->image_url)
                <div class="col pad5 prop" style="background-image: url('{{ $section->image_url }}');"></div>
            @endif
        </div>
    @endforeach

    @include('frontend.partials.contact-cta', ['cta' => $contactCta])
@endsection
