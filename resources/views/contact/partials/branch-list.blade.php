@if ($branchSection?->title)<h2>{!! $branchSection->title !!}</h2>@endif
@if ($branchSection?->description)<p>{!! nl2br(e($branchSection->description)) !!}</p>@endif

@foreach ($cities as $city)
    <h4 class="elg">{{ $city->name }}</h4>
    <ul class="branches">
        @foreach ($city->branches as $branch)
            <li><a href="{{ url($branch->slug . '.html') }}">{{ $branch->title }}</a></li>
        @endforeach
    </ul>
@endforeach

<h3><a href="{{ url('contact.html#eform') }}">查询及预约表格</a></h3>
