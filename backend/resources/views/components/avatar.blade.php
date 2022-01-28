<div class="h-12 w-12 flex items-center justify-center">
    @if (empty($avatar))
        <img src="{{ asset('storage/images/' . Auth::user()->avatar) }}" class="rounded-full object-cover h-12 w-12 mt-4">
    @else
        @if ($avatar == 'default_user.jpg')
            <img src="{{ asset('images/default_user.jpg') }}" class="rounded-full object-cover h-12 w-12">
        @else
            <img src="{{ asset('storage/images/' . $avatar) }}" class="rounded-full object-cover h-12 w-12">
        @endif
    @endif
</div>
