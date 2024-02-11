<ul class="breadcrumb fw-bold fs-8 my-1">
    @if($dataURL && is_array($dataURL))
        @foreach ($dataURL as $item)
            @if(isset($item['url']) || $item['url'] !== '#' )
            <li class="breadcrumb-item text-muted">
                <a href="{{ $item['url'] }}" class="text-muted">{{ $item['name'] }}</a>
            </li>
            @else
            <li class="breadcrumb-item text-muted">{{ $item['name'] }}</li>
            @endif
        @endforeach
    @endif
    <li class="breadcrumb-item text-dark">{{ $currentURL['name'] }}</li>
</ul>