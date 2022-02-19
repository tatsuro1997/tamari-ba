@foreach ($user->bikeComments as $comment)
    <div class="p-1 w-full">
        <div class="h-full border-2 border-gray-200 border-opacity-60 rounded-lg overflow-hidden">
            <div class="flex ml-2 mr-4 mt-1">
                <x-avatar avatar="{{ $comment->user->avatar ?? '' }}" type="nav" />
                <div class="font-medium ml-4 mt-2">{{$comment->user->name}}</div>
            </div>
            <a href="{{ route('user.bikes.show', ['bike' => $comment->bike_id]) }}">
                <h1 class="title-font text-lg font-medium text-gray-900 p-2">{{ $comment->comment }}</h1>
            </a>
        </div>
    </div>
@endforeach
@foreach ($user->roadComments as $comment)
    <div class="p-1 w-full">
        <div class="h-full border-2 border-gray-200 border-opacity-60 rounded-lg overflow-hidden">
            <div class="flex ml-2 mr-4 mt-1">
                <x-avatar avatar="{{ $comment->user->avatar ?? '' }}" type="nav" />
                <div class="font-medium ml-4 mt-2">{{$comment->user->name}}</div>
            </div>
            <a href="{{ route('user.roads.show', ['road' => $comment->road_id]) }}">
                <h1 class="title-font text-lg font-medium text-gray-900 p-2">{{ $comment->comment }}</h1>
            </a>
        </div>
    </div>
@endforeach
@foreach ($user->boardComments as $comment)
    <div class="p-1 w-full">
        <div class="h-full border-2 border-gray-200 border-opacity-60 rounded-lg overflow-hidden">
            <div class="flex ml-2 mr-4 mt-1">
                <x-avatar avatar="{{ $comment->user->avatar ?? '' }}" type="nav" />
                <div class="font-medium ml-4 mt-2">{{$comment->user->name}}</div>
            </div>
            <a href="{{ route('user.boards.show', ['board' => $comment->board_id]) }}">
                <h1 class="title-font text-lg font-medium text-gray-900 p-2">{{ $comment->comment }}</h1>
            </a>
        </div>
    </div>
@endforeach
