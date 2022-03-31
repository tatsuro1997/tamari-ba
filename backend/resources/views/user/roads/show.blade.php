<x-app-layout>
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
                                <div class="lg:flex">
                                    {{-- <x-swiper :images="$road->roadImages" type="road"/> --}}
                                    @if(empty($road->filename))
                                        <img class="lazyload w-1/2" width="350" height="240" loading="lazy" src="{{ asset('images/test.webp') }}" data-src="{{ asset('images/no_image.webp') }}">
                                    @else
                                        <img class="lazyload w-full md:w-1/2 sm:max-h-80 max-h-52 mx-auto bg-cover" loading="lazy" src="{{ asset('images/test.webp') }}" data-src="{{ url($road->filename) }}">
                                    @endif
                                    <div class="lg:w-1/2 sm:w-full">
                                        <div id="map" class="w-full h-80">
                                    </div>
                                </div>
                            </div>
                            <div class="p-6 relative">
                                <div class="flex justify-between">
                                    <h1 class="title-font text-lg font-medium text-gray-900 mb-3">{{ $road->title }}</h1>
                                    <x-like :road="$road" :like="$like" type="road" />
                                </div>
                                <div class="flex justify-between">
                                    <p class="leading-relaxed mb-3">{{ $road->description }}</p>
                                    <div class="flex">
                                        @can('update', $road)
                                            <a onclick="location.href='{{ route('user.roads.edit', ['road' => $road->id ]) }}'" class="py-2 px-2"><i class="far fa-edit"></i></a>
                                        @endcan
                                        @can('delete', $road)
                                            <form id="delete_{{ $road->id }}" method="post" action="{{ route('user.roads.destroy', ['road' => $road->id ]) }}">
                                                @csrf
                                                @method('delete')
                                                <div class="w-full flex justify-around">
                                                    <a href="#" data-id="{{ $road->id }}" onclick="deletePost(this)" class="border-0 py-2"><i class="far fa-trash-alt"></i></a>
                                                </div>
                                            </form>
                                        @endcan
                                    </div>
                                </div>
                                <div class="justify-end">
                                    <p class="leading-relaxed text-right">{{ $road->created_at->format('Y-m-d') }}</p>
                                    <p class="leading-relaxed text-right">{{ $road->user->name }}</p>
                                </div>
                            </div>
                        </div>
                        <x-comment.form :original="$road" type="road" />
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
<script src="{{ asset('/js/originalLocation.js') }}"></script>
<script src="https://maps.googleapis.com/maps/api/js?language=ja&region=JP&key={{env('GOOGLE_MAP_API_KEY')}}&callback=initMap" async defer></script>
</x-app-layout>
