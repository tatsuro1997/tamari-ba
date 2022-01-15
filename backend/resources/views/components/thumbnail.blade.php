@php
if($type === 'roads'){
    $path = 'storage/roads/';
}
@endphp

<div>
    @if(empty($filename))
        <img src="{{ asset('images/no_image.jpg') }}">
    @else
        <img src="{{ asset($path . $filename) }}">
    @endif
</div>
