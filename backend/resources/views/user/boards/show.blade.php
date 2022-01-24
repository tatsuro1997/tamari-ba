<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            掲示板詳細
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                     <section class="text-gray-600 body-font">
                        <div class="container px-5 py-8 mx-auto">
                            <div class="flex justify-end mb-4">
                                <button onclick="location.href='{{ route('user.boards.index') }}'"  class="text-black bg-gray-200 border-0 py-2 px-8 focus:outline-none hover:bg-gray-400 rounded text-lg">一覧に戻る</button>
                            </div>
                            <div class="h-full border-2 border-gray-200 border-opacity-60 rounded-lg overflow-hidden flex">
                                <div class="w-1/2 text-center">
                                    <!-- Slider main container -->
                                    <div class="swiper-container">
                                        <!-- Additional required wrapper -->
                                        <div class="swiper-wrapper">
                                            @foreach ($board->boardImages as $image)
                                                <div class="swiper-slide">
                                                    @if ($image->filename !== null)
                                                        <img src="{{ asset('storage/boards/' . $image->filename) }}">
                                                    @else
                                                        <img src="">
                                                    @endif
                                                </div>
                                            @endforeach
                                        </div>
                                        <!-- If we need pagination -->
                                        <div class="swiper-pagination"></div>

                                        <!-- If we need navigation buttons -->
                                        <div class="swiper-button-prev"></div>
                                        <div class="swiper-button-next"></div>

                                        <!-- If we need scrollbar -->
                                        <div class="swiper-scrollbar"></div>
                                    </div>
                                </div>
                                <div class="p-6 relative">
                                    <h1 class="title-font text-lg font-medium text-gray-900 mb-3">{{ $board->title }}</h1>
                                    <p class="leading-relaxed mb-1"><i class="far fa-clock mr-2 w-4"></i>{{ date('Y/m/d H:i', strtotime($board->date)) }}</p>
                                    <p class="leading-relaxed mb-1"><i class="fas fa-motorcycle mr-2 w-4"></i>{{ $board->location }}</p>
                                    <p class="leading-relaxed mb-3"><i class="fas fa-map-marker-alt mr-2 w-4"></i>{{ $board->destination }}</p>
                                    <p class="leading-relaxed mb-3">{{ $board->description }}</p>
                                    <div class="flex justify-between">
                                        <div class="flex">
                                            {{-- @can('update', $board) --}}
                                                <button  onclick="location.href='{{ route('user.boards.edit', ['board' => $board->id ]) }}'" class="text-black bg-yellow-400 border-0 py-2 px-6 mr-2 focus:outline-none hover:bg-yellow-500 rounded">編集</button>
                                            {{-- @endcan
                                            @can('delete', $board) --}}
                                                <form id="delete_{{ $board->id }}" method="post" action="{{ route('user.boards.destroy', ['board' => $board->id ]) }}">
                                                    @csrf
                                                    @method('delete')
                                                    <div class="w-full flex justify-around">
                                                        <a href="#" data-id="{{ $board->id }}" onclick="deletePost(this)" class="text-white bg-red-400 border-0 py-4 px-6 focus:outline-none hover:bg-red-500 rounded">削除</a>
                                                    </div>
                                                </form>
                                            {{-- @endcan --}}
                                        </div>
                                        <div>
                                            <p class="leading-relaxed text-right">{{ $board->created_at->format('Y-m-d') }}</p>
                                            <p class="leading-relaxed text-right">{{ $board->boardUsers->first()->user->name }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
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
<script src="{{ mix('js/swiper.js') }}"></script>
</x-app-layout>