<footer>
    <div class="centered grey2 pad">
        @include('frontend.partials.awards')

        @if (($awardSection ?? (isset($sections) ? $sections->get('award_grid') : null))?->is_active && ($logoSection ?? (isset($sections) ? $sections->get('logo_grid') : null))?->is_active)
            <hr>
        @endif

        @include('frontend.partials.partners')
    </div>

    <div class="row grey3 pad footer-menu">
        @foreach ($activeItems($footerMenu?->items?->whereNull('parent_id') ?? collect())->chunk(4) as $chunk)
            <div class="col">
                @foreach ($chunk as $item)
                    <p><strong><a href="{{ $pageUrl($item->url) }}">{{ $item->title }}</a></strong></p>
                @endforeach
                @if ($loop->last && $settings?->hotline)
                    <p><a href="tel:{{ preg_replace('/\D+/', '', $settings->hotline) }}" class="button3">HOTLINE: {{ $settings->hotline }}</a></p>
                @endif
            </div>
        @endforeach
    </div>

    <div class="row blue3 inv pad mobi-center">
        <div class="col"><img src="{{ asset('static/picture/logo-white.png') }}" alt="{{ $settings?->site_name }}" class="footer-logo"></div>
        <div class="col taR">
            @if ($settings?->facebook_url)<a href="{{ $settings->facebook_url }}"><img src="{{ asset('static/picture/facebook.svg') }}" alt="Facebook" class="social"></a>@endif
            @if ($settings?->instagram_url)<a href="{{ $settings->instagram_url }}"><img src="{{ asset('static/picture/instagram.svg') }}" alt="Instagram" class="social"></a>@endif
        </div>
    </div>
    <div class="credit blue4">
        @if ($settings?->english_button_enabled)
            <p class="taC"><a href="{{ $pageUrl($settings->english_button_url ?: 'index.html') }}"><strong>ENGLISH</strong></a></p>
        @endif
        @if ($settings?->footer_license_text)<p><strong>{!! nl2br(e($settings->footer_license_text)) !!}</strong></p>@endif
        @if ($settings?->copyright_text)<p>{!! nl2br(e($settings->copyright_text)) !!}</p>@endif
    </div>
</footer>
