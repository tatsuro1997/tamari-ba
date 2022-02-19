@php
    if ($type==='bike') {
        $action = route('user.bike.comment.store', ['bike' => $original->id]);
        $Comments = $original->bikeComments;
        $input_name = 'bike_id';
    }
    if ($type==='road') {
        $action = route('user.road.comment.store', ['road' => $original->id]);
        $Comments = $original->roadComments;
        $input_name = 'road_id';
    }
    if ($type==='board') {
        $action = route('user.board.comment.store', ['board' => $original->id]);
        $Comments = $original->boardComments;
        $input_name = 'board_id';
    }
@endphp

<div class="w-full ml-2">
    <form method="post" action="{{ $action }}" class="lg:w-1/2 sm:w-full" >
        @csrf
        <div class="border-b border-blue-500 my-2">
            <input value="{{ $original->id }}" type="hidden" name="{{$input_name}}" />
            <input value="{{ Auth::id() }}" type="hidden" name="user_id" />
            <textarea id="comment" name="comment" placeholder="コメント入力 ..." type="text" rows="10" required class="w-full h-20 rounded border-none focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 leading-8 transition-colors duration-200 ease-in-out"></textarea>
        </div>
        <button type="submit" class="flex-shrink-0 bg-blue-500 hover:bg-blue-700 border-blue-500 hover:border-blue-700 text-sm border-4 text-white py-1 px-2 rounded" >
            コメント
        </button>
        <button type="button" onClick="cancelComment()" class="flex-shrink-0 border-transparent border-4 text-gray-500 hover:text-gray-800 text-sm py-1 px-2 rounded">
            キャンセル
        </button>
    </form>
    @foreach ($Comments as $comment)
        <div class="flex mt-4">
            <x-avatar avatar="{{ $comment->user->avatar ?? '' }}" uid="{{ $comment->user->uid ?? '' }}" type="nav" />
            <div class="ml-4 w-3/4">
                <div class="lg:flex">
                    <div class="font-medium mr-4">{{$comment->user->name}}</div>
                    <div>{{$comment->created_at->format('Y-m-d')}}</div>
                    @if ($type==='bike')
                        <form id="delete_comment_{{$comment->id}}" method="post" action="{{ route('user.bike.comment.destroy', ['bike' => $comment->bike_id, 'comment' => $comment->id ]) }}">
                    @endif
                    @if ($type==='road')
                        <form id="delete_comment_{{$comment->id}}" method="post" action="{{ route('user.road.comment.destroy', ['road' => $comment->road_id, 'comment' => $comment->id ]) }}">
                    @endif
                    @if ($type==='board')
                        <form id="delete_comment_{{$comment->id}}" method="post" action="{{ route('user.board.comment.destroy', ['board' => $comment->board_id, 'comment' => $comment->id ]) }}">
                    @endif
                        @csrf
                        @method('delete')
                        <input type="hidden" value="{{ $comment->id }}" name="comment_id" />
                        {{-- <input type="hidden" value="{{ $comment->bike->id }}" name="{{$input_name}}" /> --}}
                        <input type="hidden" value="{{ $comment->road->id ?? $comment->board->id ?? $comment->bike->id }}" name="{{$input_name}}" />
                        @can('delete', $comment)
                            <a href="#" data-id="{{ $comment->id }}" onclick="deleteComment(this)" class="border-0 px-4"><i class="far fa-trash-alt"></i></a>
                        @endcan
                    </form>
                </div>
                <div class="text-xl my-1 h-auto">{!!nl2br(e($comment->comment))!!}</div>
            </div>
        </div>
    @endforeach
</div>

<script>
  'use strict'
  function deleteComment(e){
    'use strict';
    if (confirm('本当に削除しても良いですか？')){
      document.getElementById('delete_comment_'+ e.dataset.id).submit();
    }
  }

  function cancelComment(){
    'use strict';
    let inputComemnt = document.getElementById('comment');
    if ( inputComemnt.value ) {
        inputComemnt.value = '';
    }
  }
</script>
