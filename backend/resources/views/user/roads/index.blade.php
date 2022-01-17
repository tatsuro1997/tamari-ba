<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            道の投稿一覧
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
                                <button onclick="location.href='{{ route('user.roads.create') }}'"  class="text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">新規登録する</button>
                            </div>
                            <div class="flex flex-wrap -m-4">
                                @foreach ($roads as $road)
                                    <div class="p-4 lg:w-1/3 md:w-1/3">
                                        <a href="{{ route('user.roads.show', ['road' => $road->id]) }}">
                                            <div class="h-full border-2 border-gray-200 border-opacity-60 rounded-lg overflow-hidden">
                                                <x-thumbnail filename="{{ $road->roadImages->first()->filename ?? ''}}" type="roads" />
                                                <div class="p-6">
                                                    <h1 class="title-font text-lg font-medium text-gray-900 mb-3">{{ $road->title }}</h1>
                                                    <p class="leading-relaxed mb-3">{{ Str::limit($road->description, 100, ' ...続きを読む') }}</p>
                                                    <div class="flex justify-between">
                                                        <div class="flex">
                                                            @can('update', $road)
                                                                <button  onclick="location.href='{{ route('user.roads.edit', ['road' => $road->id ]) }}'" class="text-black bg-yellow-400 border-0 py-2 px-4 mr-2 focus:outline-none hover:bg-yellow-500 rounded">編集</button>
                                                            @endcan
                                                            @can('delete', $road)
                                                                <form id="delete_{{ $road->id }}" method="post" action="{{ route('user.roads.destroy', ['road' => $road->id ]) }}">
                                                                    @csrf
                                                                    @method('delete')
                                                                    <div class="w-full flex justify-around">
                                                                        <a href="#" data-id="{{ $road->id }}" onclick="deletePost(this)" class="text-white bg-red-400 border-0 py-2 px-4 focus:outline-none hover:bg-red-500 rounded">削除</a>
                                                                    </div>
                                                                </form>
                                                            @endcan
                                                        </div>
                                                        <div>
                                                            <p class="leading-relaxed text-right">{{ $road->created_at->format('Y-m-d') }}</p>
                                                            <p class="leading-relaxed text-right">{{ $road->user->name }}</p>
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
                    {{ $roads->links() }}
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
