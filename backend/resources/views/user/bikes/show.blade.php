<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                     <section class="text-gray-600 body-font">
                        <div class="container px-5 py-8 mx-auto">
                            <div class="flex justify-end mb-4">
                                <button onclick="location.href='{{ route('user.bikes.index') }}'"  class="text-black bg-gray-200 border-0 py-2 px-8 focus:outline-none hover:bg-gray-400 rounded text-lg">一覧に戻る</button>
                            </div>
                            <div class="h-full border-2 border-gray-200 border-opacity-60 rounded-lg overflow-hidden lg:flex">
                                <x-swiper :images="$bike->bikeImages" type="bike" />
                                <div class="p-6 relative lg:w-1/2">
                                    <div class="flex justify-between">
                                        <h1 class="title-font text-lg font-medium text-gray-900 mb-3">{{ $bike->title }}</h1>
                                        <x-like :bike="$bike" :like="$like" type="bike" />
                                    </div>
                                    <div class="flex flex-wrap">
                                        <i class="fas fa-motorcycle mr-2 w-4"></i>
                                        <div class="leading-relaxed mx-4">{{ $bike->maker->name }}</div>
                                        <div class="leading-relaxed">{{ $bike->type->name }}</div>
                                        <div class="leading-relaxed mx-4">{{ $bike->name }}</div>
                                        <div class="leading-relaxed">{{ $bike->engine_size }}</div>
                                    </div>
                                    <div class="flex justify-between">
                                        <p class="leading-relaxed mb-3">{{ $bike->description }}</p>
                                        <div class="flex">
                                            @can('update', $bike)
                                                <a onclick="location.href='{{ route('user.bikes.edit', ['bike' => $bike->id ]) }}'" class="py-2 px-2"><i class="far fa-edit"></i></a>
                                            @endcan
                                            @can('delete', $bike)
                                                <form id="delete_{{ $bike->id }}" method="post" action="{{ route('user.bikes.destroy', ['bike' => $bike->id ]) }}">
                                                    @csrf
                                                    @method('delete')
                                                    <div class="w-full flex justify-around">
                                                        <a href="#" data-id="{{ $bike->id }}" onclick="deletePost(this)" class="border-0 py-2"><i class="far fa-trash-alt"></i></a>
                                                    </div>
                                                </form>
                                            @endcan
                                        </div>
                                    </div>
                                    <div class="justify-end">
                                        <p class="leading-relaxed text-right">{{ $bike->created_at->format('Y-m-d') }}</p>
                                        <p class="leading-relaxed text-right">{{ $bike->user->name }}</p>
                                    </div>
                                </div>
                            </div>
                            <x-comment.form :original="$bike" type="bike" />
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
