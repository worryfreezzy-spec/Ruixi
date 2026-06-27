@extends('frontend.layout')

@section('body_id', 'about')
@section('title', $doctor->name . ' | OPTIMAX 眼科医生')
@section('description', $doctor->short_bio ?: $doctor->qualification)

@php
    $lines = function (?string $value): array {
        return collect(preg_split('/\r\n|\r|\n/', (string) $value))
            ->map(fn (string $line): string => trim($line))
            ->filter()
            ->values()
            ->all();
    };
@endphp

@section('content')
    <div class="row profile fade-up">
        <div class="col pad">
            <h4><a href="{{ url('doctors.html') }}">我们的专科医生 /</a></h4>
            <h1>{{ $doctor->name }}</h1>

            @if ($doctor->position)
                <h4>职位</h4>
                <p>{!! nl2br(e($doctor->position)) !!}</p>
            @endif

            @if ($doctor->qualification)
                <h4>学历</h4>
                <p>{!! nl2br(e($doctor->qualification)) !!}</p>
            @endif

            @if ($doctor->specialty)
                <h4>专科领域</h4>
                <ul class="disc">
                    @foreach ($lines($doctor->specialty) as $specialty)
                        <li>{{ $specialty }}</li>
                    @endforeach
                </ul>
            @endif

            @if ($doctor->languages)
                <h4>语言</h4>
                <p>{!! nl2br(e($doctor->languages)) !!}</p>
            @endif

            @if ($doctor->branches)
                <h4>分行</h4>
                <p>{{ $doctor->branches }}</p>
            @endif
        </div>
        <div class="col doc-pic">
            @if ($doctor->photo_url)
                <img src="{{ $doctor->photo_url }}" alt="{{ $doctor->name }}">
            @endif
        </div>
    </div>
@endsection
