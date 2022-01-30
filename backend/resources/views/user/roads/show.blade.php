<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            道の投稿詳細
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
                                <button onclick="location.href='{{ route('user.roads.index') }}'"  class="text-black bg-gray-200 border-0 py-2 px-8 focus:outline-none hover:bg-gray-400 rounded text-lg">一覧に戻る</button>
                            </div>
                            <div class="h-full border-2 border-gray-200 border-opacity-60 rounded-lg overflow-hidden">
                                <div class="flex">
                                    <x-swiper :images="$road->roadImages" type="road" />
                                    <div class="w-1/2">
                                        <div id="map" class="w-full h-80">
                                    </div>
                                </div>
                            </div>
                            <div class="p-6 relative">
                                <h1 class="title-font text-lg font-medium text-gray-900 mb-3">{{ $road->title }}</h1>
                                <p class="leading-relaxed mb-3">{{ $road->description }}</p>
                                <div class="flex justify-between">
                                    <div class="flex">
                                        @can('update', $road)
                                            <button  onclick="location.href='{{ route('user.roads.edit', ['road' => $road->id ]) }}'" class="text-black bg-yellow-400 border-0 py-2 px-6 mr-2 focus:outline-none hover:bg-yellow-500 rounded">編集</button>
                                        @endcan
                                        @can('delete', $road)
                                            <form id="delete_{{ $road->id }}" method="post" action="{{ route('user.roads.destroy', ['road' => $road->id ]) }}">
                                                @csrf
                                                @method('delete')
                                                <div class="w-full flex justify-around">
                                                    <a href="#" data-id="{{ $road->id }}" onclick="deletePost(this)" class="text-white bg-red-400 border-0 py-4 px-6 focus:outline-none hover:bg-red-500 rounded">削除</a>
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
                            <x-comment-form :original="$road" type="road" />
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
<script>
    const lat = {{ $road->latitude }};
    const lng = {{ $road->longitude }};
</script>
<script src="{{ mix('js/swiper.js') }}"></script>
<script src="{{ asset('/js/currentLocation.js') }}"></script>
<script src="https://maps.googleapis.com/maps/api/js?language=ja&region=JP&key={{env('GOOGLE_MAP_API_KEY')}}&callback=initMap" async defer></script>
</x-app-layout>
