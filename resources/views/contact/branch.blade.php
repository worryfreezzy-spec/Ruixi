@extends('frontend.layout')

@section('body_id', 'contact')
@section('title', $branch->title)
@section('description', $branch->address)

@section('content')
    <div class="banner zoom">
        <div class="hero hero40 nofade"></div>
        <h1 class="tagline">联系我们</h1>
    </div>

    <div class="row">
        <div class="col o2 blue fade-up">
            <div class="pad">
                <div class="pad">
                    @include('contact.partials.branch-list')
                </div>
            </div>
        </div>
        <div class="col o1 x2 mint fade-up">
            <div class="pad">
                <h2>{{ $branch->title }}</h2>
                @if ($branch->address)<p>{!! nl2br(e($branch->address)) !!}</p>@endif
                <p>
                    @if ($branch->phone)电话： {{ $branch->phone }}<br>@endif
                    @if ($branch->whatsapp)WhatsApp: {{ $branch->whatsapp }}<br>@endif
                    @if ($branch->email)电子邮件： {{ $branch->email }}@endif
                </p>
                @if ($branch->business_hours)
                    <p><strong>营业时间：</strong><br>{!! nl2br(e($branch->business_hours)) !!}</p>
                @endif
                <p>
                    @if ($branch->contact_url)<a class="button2" href="{{ $branch->contact_url }}">联系我们</a>@endif
                    @if ($branch->street_view_url)<a class="button" href="{{ $branch->street_view_url }}" target="_blank" rel="noopener">STREET VIEW</a>@endif
                    @if ($branch->waze_url)<a class="button" href="{{ $branch->waze_url }}">WAZE</a>@endif
                </p>
            </div>
            @if ($branch->map_embed)
                <div class="embed">{!! $branch->map_embed !!}</div>
            @endif
        </div>
    </div>
@endsection
