@php
if($type === 'roads'){
    $path = 'storage/roads/';
} elseif ($type === 'boards'){
    $path = 'storage/boards/';
}
if($type === 'users'){
    $path = 'storage/users/';
}
@endphp

<div>
    @if(empty($filename))
        <img src="{{ asset('images/no_image.jpg') }}">
    @else
        <img src="{{ asset($path . $filename) }}">
    @endif
</div>
