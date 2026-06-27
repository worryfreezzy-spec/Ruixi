<nav id="navbar">
    <div class="container ds">
        @if ($settings?->english_button_enabled)
            <div class="lang"><a href="{{ $pageUrl($settings->english_button_url ?: 'index.html') }}"><strong>ENG</strong></a></div>
        @endif
        <a
            href="{{ url('/') }}"
            class="logo"
            @if ($settings?->logo_url) style="background-image: url('{{ $settings->logo_url }}')" @endif
        >
            {{ $settings?->site_name ?: '主页' }}
        </a>
        <input type="checkbox" id="nav-btn">
        <label class="nav-ico" for="nav-btn"><span></span></label>
        <ul class="menu">
            @foreach ($activeItems($headerMenu?->items?->whereNull('parent_id') ?? collect()) as $item)
                @php
                    $children = $activeItems($item->children);
                @endphp
                <li @class(['has-submenu' => $children->isNotEmpty()])>
                    <a href="{{ $pageUrl($item->url) }}" @if($item->target === '_blank') target="_blank" rel="noopener" @endif>{{ $item->title }}</a>
                    @if ($children->isNotEmpty())
                        <ul class="sub-menu">
                            @foreach ($children as $child)
                                <li><a href="{{ $pageUrl($child->url) }}" @if($child->target === '_blank') target="_blank" rel="noopener" @endif>{{ $child->title }}</a></li>
                            @endforeach
                        </ul>
                    @endif
                </li>
            @endforeach
            @if ($settings?->whatsapp_url)
                <li class="ico-wa"><a href="{{ $settings->whatsapp_url }}" target="_blank" rel="noopener" title="WhatsApp us">WhatsApp</a></li>
            @endif
        </ul>
    </div>
</nav>
