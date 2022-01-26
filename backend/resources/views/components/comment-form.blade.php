<div class="w-full">
    <form method="post" action="{{ route('user.road.comment.store', ['road' => $road->id]) }}" class="w-1/2" >
        @csrf
        <div class="border-b border-blue-500 my-2">
            <input value="{{ $road->id }}" type="hidden" name="road_id" />
            <input value="{{ Auth::id() }}" type="hidden" name="user_id" />
            <input id="commentForm" class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none" placeholder="コメント入力 ..." type="text" name="comment" />
        </div>
        <button type="submit" class="flex-shrink-0 bg-blue-500 hover:bg-blue-700 border-blue-500 hover:border-blue-700 text-sm border-4 text-white py-1 px-2 rounded" >
            コメント
        </button>
        <button type="button" onclick="cancelComment(this)" class="flex-shrink-0 border-transparent border-4 text-gray-500 hover:text-gray-800 text-sm py-1 px-2 rounded">
            キャンセル
        </button>
    </form>
    @foreach ($road->roadComments as $comment)
        <div class="flex mt-4">
            <x-avatar avatar="{{ $comment->user->avatar ?? '' }}" type="nav" />
            <div class="ml-4 w-3/4">
                <div class="flex">
                    <div class="font-medium mr-4">{{$comment->user->name}}</div>
                    <div>{{$comment->created_at->format('Y-m-d')}}</div>
                    <form id="delete_comment_{{$comment->id}}" method="post" action="{{ route('user.road.comment.destroy', ['road' => $comment->road_id, 'comment' => $comment->id ]) }}">
                        @csrf
                        @method('delete')
                        <input value="{{ $comment->id }}" type="hidden" name="comment_id" />
                        <input value="{{ $comment->road->id }}" type="hidden" name="road_id" />
                        @can('delete', $comment)
                            <a href="#" data-id="{{ $comment->id }}" onclick="deleteComment(this)" class="border-0 px-4"><i class="far fa-trash-alt"></i></a>
                        @endcan
                    </form>
                </div>
                <div class="text-xl my-1">{{$comment->comment}}</div>
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
    let inputComemnt = document.getElementById('commentForm');
    inputComment.value = ""
  }
</script>
