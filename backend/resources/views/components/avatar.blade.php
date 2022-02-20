@php
    if($type === 'nav'){
        $style = "lazyload rounded-full object-cover h-12 w-12 mt-2";
    }
    if($type === 'profile'){
        $style = "lazyload rounded-full object-cover h-20 w-20";
    }
@endphp

<div class="items-center justify-center">
    <a href="{{ route('user.profile', ['user' => $uid ?? Auth::user()->uid]) }}">
        @if (empty($avatar))
            <img loading="lazy" src="{{ asset('images/test.webp') }}" data-src="{{ asset('images/default_user.jpg') }}" class="{{$style}}">
        @else
            <img loading="lazy" src="{{ asset('images/test.webp') }}" data-src="{{ Storage::disk('s3')->url('/users/' . $avatar) }}" class="{{$style}}">
        @endif
    </a>
</div>
