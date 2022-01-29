<div class="w-12 h-6 p-2">
    @if($like->like_exist(Auth::user()->id, $road->id))
        <p class="favorite-marke">
            <a class="js-like-toggle text-red-600" href="" data-roadid="{{ $road->id }}"><i class="fas fa-heart"></i></a>
            <span class="likesCount">{{$road->roadLikes->count()}}</span>
        </p>
    @else
        <p class="favorite-marke">
            <a class="js-like-toggle" href="" data-roadid="{{ $road->id }}"><i class="fas fa-heart"></i></a>
            <span class="likesCount">{{$road->roadLikes->count()}}</span>
        </p>
    @endif
</div>
