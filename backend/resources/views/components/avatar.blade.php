@php
    if($type === 'nav'){
        $style = "rounded-full object-cover h-12 w-12 mt-2";
    }
    if($type === 'profile'){
        $style = "rounded-full object-cover h-20 w-20";
    }
@endphp

<div class="items-center justify-center">
    <a href="{{ route('user.profile') }}">
        @if (empty($avatar))
            <img src="{{ asset('storage/images/' . Auth::user()->avatar) }}" class="{{$style}}">
        @else
            @if ($avatar == 'default_user.jpg')
                <img src="{{ asset('images/default_user.jpg') }}" class="rounded-full object-cover h-12 w-12">
            @else
                <img src="{{ asset('storage/images/' . $avatar) }}" class="rounded-full object-cover h-12 w-12">
            @endif
        @endif
    </a>
</div>
