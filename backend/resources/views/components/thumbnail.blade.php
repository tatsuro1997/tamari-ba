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
}
$nowDate = new Carbon(Carbon::now());;
@endphp

<div>
    <div class="relative">
        @if($board ?? '')
            @if($board->date < $nowDate || $board->deadline == 1)
                <p class="absolute inset-x-0 bottom-0 bg-gray-600 bg-opacity-75 text-white pl-2">※この募集は終了しました。</p>
            @endif
        @endif
        @if(empty($filename))
            <img src="{{ asset('images/no_image.jpg') }}">
        @else
            <img src="{{ Storage::disk('s3')->url($path . $filename) }}">
        @endif
    </div>
</div>
