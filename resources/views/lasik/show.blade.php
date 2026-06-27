@extends('frontend.layout')

@section('body_id', 'lasik')
@section('title', $service->title)
@section('description', $service->summary)

@php
    $heroImage = $service->hero_image;
    $useCustomHero = filled($heroImage) && ! in_array(ltrim($heroImage, '/'), ['static/image/hero36.webp', 'static/image/hero36@2x.webp'], true);
    $featureSection = $sections->firstWhere('type', 'feature_split');
    $benefitsSection = $sections->firstWhere('type', 'blue_columns');
    $audienceItem = $benefitsSection?->items?->where('is_active', true)->sortBy('sort_order')->first();
    $leftTitle = $service->left_title ?: $featureSection?->title;
    $leftDescription = $service->left_description ?: $featureSection?->description;
    $leftImage = $service->left_image ?: $featureSection?->image;
    $detailMedia = $service->detail_media;
    $rightTitle = $service->right_title ?: $featureSection?->subtitle;
    $advantagesTitle = $service->advantages_title ?: $benefitsSection?->title;
    $advantagesContent = $service->advantages_content ?: $benefitsSection?->description;
    $audienceTitle = $service->audience_title ?: $audienceItem?->title;
    $audienceContent = $service->audience_content ?: $audienceItem?->description;

    if (! function_exists('renderLasikLines')) {
        function renderLasikLines(?string $content): string {
            $html = '';
            $listType = null;
            $listItems = [];
            $flushList = static function () use (&$html, &$listType, &$listItems): void {
                if ($listType === null || $listItems === []) {
                    return;
                }

                $tag = $listType === 'ol' ? 'ol' : 'ul';
                $class = $listType === 'ul' ? ' class="disc"' : '';
                $html .= '<' . $tag . $class . '><li>' . implode('</li><li>', $listItems) . '</li></' . $tag . '>';
                $listType = null;
                $listItems = [];
            };

            foreach (preg_split('/\r\n|\r|\n/', (string) $content) as $line) {
                $line = trim($line);
                if ($line === '') {
                    continue;
                }

                if (str_starts_with($line, '# ')) {
                    $flushList();
                    $html .= '<h2>' . substr($line, 2) . '</h2>';
                } elseif (str_starts_with($line, '## ')) {
                    $flushList();
                    $html .= '<h3>' . substr($line, 3) . '</h3>';
                } elseif (str_starts_with($line, '- ')) {
                    if ($listType !== 'ul') {
                        $flushList();
                        $listType = 'ul';
                    }

                    $listItems[] = e(substr($line, 2));
                } elseif (preg_match('/^\d+\.\s+(.+)$/', $line, $matches)) {
                    if ($listType !== 'ol') {
                        $flushList();
                        $listType = 'ol';
                    }

                    $listItems[] = e($matches[1]);
                } else {
                    $flushList();
                    $html .= '<p>' . $line . '</p>';
                }
            }

            $flushList();

            return $html;
        }
    }
@endphp

@section('content')
    <div class="banner zoom">
        <div class="hero hero36" @if($useCustomHero && $service->hero_image_url) style="background-image: url('{{ $service->hero_image_url }}')" @endif></div>
        <h1 class="tagline">{!! $service->short_title ?: $service->title !!}</h1>
    </div>

    <div class="row">
        <div class="pad centered fade-up">
            @if ($service->intro_title)<h1>{!! $service->intro_title !!}</h1>@endif
            @if ($service->intro_description)<p>{!! nl2br(e($service->intro_description)) !!}</p>@endif
        </div>
    </div>

    @if ($featureSection)
        <div class="row aos-init fade-up">
            <div class="col x2 mint">
                @if ($detailMedia && str_ends_with(strtolower($detailMedia), '.mp4'))
                    <div class="embed">
                        <video class="w-100" controls="controls">
                            <source src="{{ $service->detail_media_url }}" type="video/mp4">
                        </video>
                    </div>
                @elseif ($detailMedia && $service->detail_media_url)
                    <p><img src="{{ $service->detail_media_url }}" alt="{{ strip_tags($leftTitle ?: $service->title) }}"></p>
                @endif
                <div class="pad">
                    @if ($leftTitle)<h2>{!! $leftTitle !!}</h2>@endif
                    @if ($leftDescription){!! renderLasikLines($leftDescription) !!}@endif
                    @if ($featureSection->items->isNotEmpty())
                        <div class="row mint taC">
                            @foreach ($featureSection->items->where('is_active', true)->sortBy('sort_order') as $item)
                                <div class="col">
                                    @if ($item->image_url)<img src="{{ $item->image_url }}" alt="{{ $item->title }}"><br><br>@endif
                                    @if ($item->title)<h5>{!! $item->title !!}</h5>@endif
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
            <div class="col pad ds taC">
                @if ($rightTitle)<h2>{!! $rightTitle !!}</h2>@endif
                @if ($service->benefits_title)<p>{!! nl2br(e($service->benefits_title)) !!}</p>@endif
                @if ($leftImage && ! str_ends_with($leftImage, '.mp4'))
                    <p><img src="{{ $service->left_image_url ?: $featureSection->image_url }}" alt="{{ strip_tags($rightTitle ?: $leftTitle ?: $service->title) }}"></p>
                @endif
            </div>
        </div>
    @endif

    @if ($advantagesTitle || $advantagesContent || $audienceTitle || $audienceContent)
        <div class="row blue">
            <div class="pad col pad5 aos-init fade-up">
                @if ($advantagesTitle)<h2>{!! $advantagesTitle !!}</h2>@endif
                @if ($advantagesContent){!! renderLasikLines($advantagesContent) !!}@endif
            </div>
            <div class="col blue blue2 pad5">
                @if ($audienceTitle)<h2>{!! $audienceTitle !!}</h2>@endif
                @if ($audienceContent){!! renderLasikLines($audienceContent) !!}@endif
            </div>
        </div>
    @endif

    @include('frontend.partials.contact-cta', [
        'cta' => $contactCta,
        'variant' => 'form',
        'defaultTreatment' => $service->category?->title,
    ])
@endsection
