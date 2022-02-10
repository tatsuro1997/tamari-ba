@php
    if($type=='bike'){
        $id = $bike->id;
        $like_count = $bike->bikeLikes->count();
    }
    if($type=='road'){
        $id = $road->id;
        $like_count = $road->roadLikes->count();
    }
@endphp


<div class="w-12 h-6 p-2">
    @if($like->like_exist(Auth::user()->id, $road->id ?? $bike->id))
        <p class="favorite-marke">
            <a class="js-like-toggle text-red-600" href="" data-likeid='["{{$id}}", "{{$type}}"]'><i class="fas fa-heart"></i></a>
            <span class="likesCount">{{ $like_count }}</span>
        </p>
    @else
        <p class="favorite-marke">
            <a class="js-like-toggle" href="" data-likeid='["{{$id}}", "{{$type}}"]'><i class="fas fa-heart"></i></a>
            <span class="likesCount">{{ $like_count }}</span>
        </p>
    @endif
</div>
