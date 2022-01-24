<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            ツーリング掲示板
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <x-flash-message status="session('status')" />
                    <section class="text-gray-600 body-font">
                        <div class="container px-5 py-8 mx-auto">
                            <div class="flex justify-end mb-4">
                                <button onclick="location.href='{{ route('user.boards.create') }}'"  class="text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">募集作成する</button>
                            </div>
                            <div class="flex flex-wrap -m-4">
                                @foreach ($boards as $board)
                                    <div class="p-4 lg:w-1/3 md:w-1/3">
                                        <a href="{{ route('user.boards.show', ['board' => $board->id]) }}">
                                            <div class="h-full border-2 border-gray-200 border-opacity-60 rounded-lg overflow-hidden">
                                                <x-thumbnail filename="{{ $board->boardImages->first()->filename ?? ''}}" type="boards" />
                                                <div class="p-6">
                                                    <h1 class="title-font text-lg font-medium text-gray-900 mb-3">{{ $board->title }}</h1>
                                                    <p class="leading-relaxed mb-1"><i class="far fa-clock mr-2 w-4"></i>{{ date('Y/m/d H:i', strtotime($board->date)) }}</p>
                                                    <p class="leading-relaxed mb-1"><i class="fas fa-motorcycle mr-2 w-4"></i>{{ $board->location }}</p>
                                                    <p class="leading-relaxed mb-3"><i class="fas fa-map-marker-alt mr-2 w-4"></i>{{ $board->destination }}</p>
                                                    <p class="leading-relaxed mb-3 h-24">{{ Str::limit($board->description, 100, ' ...続きを読む') }}</p>
                                                    <div class="flex justify-between">
                                                        <div class="flex">
                                                            @can('update', $board)
                                                                <button  onclick="location.href='{{ route('user.boards.edit', ['board' => $board->id ]) }}'" class="text-black bg-yellow-400 border-0 py-2 px-4 mr-2 focus:outline-none hover:bg-yellow-500 rounded">編集</button>
                                                            @endcan
                                                            @can('delete', $board)
                                                                <form id="delete_{{ $board->id }}" method="post" action="{{ route('user.boards.destroy', ['board' => $board->id ]) }}">
                                                                    @csrf
                                                                    @method('delete')
                                                                    <div class="w-full flex justify-around">
                                                                        <a href="#" data-id="{{ $board->id }}" onclick="deletePost(this)" class="text-white bg-red-400 border-0 py-2 px-4 focus:outline-none hover:bg-red-500 rounded">削除</a>
                                                                    </div>
                                                                </form>
                                                            @endcan
                                                        </div>
                                                        <div>
                                                            <p class="leading-relaxed text-right">{{ $board->created_at->format('Y-m-d') }}</p>
                                                            <p class="leading-relaxed text-right">{{ $board->boardUsers->first()->user->name}}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </section>
                    {{ $boards->links() }}
                </div>
            </div>
        </div>
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
</x-app-layout>
