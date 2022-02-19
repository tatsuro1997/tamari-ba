@php
    if($type === 'nav'){
        $style = "rounded-full object-cover h-12 w-12 mt-2";
    }
    if($type === 'profile'){
        $style = "rounded-full object-cover h-20 w-20";
    }
@endphp

<div class="items-center justify-center">
    <a href="{{ route('user.profile', ['user' => $uid ?? Auth::user()->uid]) }}">
        @if (empty($avatar))
            <img src="{{ asset('images/default_user.jpg') }}" class="{{$style}}">
        @else
            <img src="{{ Storage::disk('s3')->url('/users/' . $avatar) }}" class="{{$style}}">
        @endif
    </a>
</div>
