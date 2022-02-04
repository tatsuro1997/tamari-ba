<div class="flex flex-wrap -m-4">
    @foreach ($boards as $board)
        <div class="p-4 lg:w-1/3 md:w-1/3">
            <a href="{{ route('user.boards.show', ['board' => $board->id]) }}">
                <div class="h-full border-2 border-gray-200 border-opacity-60 rounded-lg overflow-hidden">
                    <x-thumbnail filename="{{ $board->boardImages->first()->filename ?? ''}}" type="boards" />
                    <div class="p-6">
                        <div class="flex justify-between">
                            <h1 class="title-font text-lg font-medium text-gray-900 mb-3">{{ $board->title }}</h1>
                            <div class="flex">
                                @can('update', $board)
                                <a onclick="location.href='{{ route('user.boards.edit', ['board' => $board->id ]) }}'" class="py-2 px-2"><i class="far fa-edit"></i></a>
                                @endcan
                                @can('delete', $board)
                                <form id="delete_{{ $board->id }}" method="post" action="{{ route('user.boards.destroy', ['board' => $board->id ]) }}">
                                    @csrf
                                    @method('delete')
                                    <div class="w-full flex justify-around">
                                        <a href="#" data-id="{{ $board->id }}" onclick="deletePost(this)" class="border-0 py-2"><i class="far fa-trash-alt"></i></a>
                                    </div>
                                </form>
                                @endcan
                            </div>
                        </div>
                        <p class="leading-relaxed mb-1"><i class="far fa-clock mr-2 w-4"></i>{{ date('Y/m/d H:i', strtotime($board->date)) }}</p>
                        <p class="leading-relaxed mb-1"><i class="fas fa-map-marker-alt mr-2 w-4"></i>{{ $board->location }}</p>
                        <p class="leading-relaxed mb-3"><i class="fas fa-motorcycle mr-2 w-4"></i>{{ $board->destination }}</p>
                        <p class="leading-relaxed h-24 relative">{{ Str::limit($board->description, 100, '...') }}</p>
                        <div class="flex justify-between">
                            <p class="leading-relaxed text-right">{{ $board->created_at->format('Y-m-d') }}</p>
                            <p class="leading-relaxed text-right">{{ $board->boardUsers->first()->user->name }}</p>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    @endforeach
</div>

<script>
  'use strict'
  function deletePost(e){
    'use strict';
    if (confirm('本当に削除しても良いですか？')){
      document.getElementById('delete_'+ e.dataset.id).submit();
    }
  }
</script>
