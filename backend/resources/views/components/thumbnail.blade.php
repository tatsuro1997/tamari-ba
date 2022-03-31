@php
use Carbon\Carbon;

    if($type === 'bikes'){
        $path = '/bikes/';
    }
    if($type === 'roads'){
        $path = '/roads/';
    }
    if ($type === 'boards'){
        $path = '/boards/';
    }
    if($type === 'users'){
        $path = '/users/';
        $style = "lazyload w-full h-auto mx-auto bg-cover";
    }else {
        $style = "lazyload w-full h-60 mx-auto bg-cover";
    }

$nowDate = new Carbon(Carbon::now());
@endphp

<div class="relative">
    @if($board ?? '')
        @if($board->date < $nowDate || $board->deadline == 1)
            <p class="absolute inset-x-0 bottom-0 bg-gray-600 bg-opacity-75 text-white pl-2">※この募集は終了しました。</p>
        @endif
    @endif
    @if(empty($filename))
        <img class="lazyload" width="350" height="240" loading="lazy" src="{{ asset('images/test.webp') }}" data-src="{{ asset('images/no_image.webp') }}">
    @elseif ($type === 'roads')
        <img class="lazyload w-full sm:max-h-80 max-h-52 mx-auto bg-cover" loading="lazy" src="{{ asset('images/test.webp') }}" data-src="{{ url($filename) }}">
    @else
        <img class="{{ $style }}" width="350" height="240"  loading="lazy" src="{{ asset('images/test.webp') }}" data-src="{{ Storage::disk('s3')->url($path . $filename) }}">
    @endif
</div>
