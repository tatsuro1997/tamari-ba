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
                     <section class="text-gray-600 body-font">
                        <div class="container px-5 py-8 mx-auto">
                            <div class="flex justify-end mb-4">
                                <button onclick="location.href='{{ route('user.roads.index') }}'"  class="text-black bg-gray-200 border-0 py-2 px-8 focus:outline-none hover:bg-gray-400 rounded text-lg">一覧に戻る</button>
                            </div>
                            <div class="h-full border-2 border-gray-200 border-opacity-60 rounded-lg overflow-hidden flex">
                                <div class="w-1/2 text-center">
                                    <!-- Slider main container -->
                                    <div class="swiper-container">
                                        <!-- Additional required wrapper -->
                                        <div class="swiper-wrapper">
                                            @foreach ($road->roadImages as $image)
                                                <div class="swiper-slide">
                                                    @if ($image->filename !== null)
                                                        <img src="{{ asset('storage/roads/' . $image->filename) }}">
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
                                    <h1 class="title-font text-lg font-medium text-gray-900 mb-3">{{ $road->title }}</h1>
                                    <p class="leading-relaxed mb-3">{{ $road->description }}</p>
                                    <div class="flex justify-between absolute bottom-2">
                                        <div class="flex mr-5">
                                            <button  onclick="location.href='{{ route('user.roads.edit', ['road' => $road->id ]) }}'" class="text-black bg-yellow-400 border-0 py-2 px-6 mr-2 focus:outline-none hover:bg-yellow-500 rounded">編集</button>
                                            <form id="delete_{{ $road->id }}" method="post" action="{{ route('user.roads.destroy', ['road' => $road->id ]) }}">
                                                @csrf
                                                @method('delete')
                                                <div class="w-full flex justify-around">
                                                    <a href="#" data-id="{{ $road->id }}" onclick="deletePost(this)" class="text-white bg-red-400 border-0 py-4 px-6 focus:outline-none hover:bg-red-500 rounded">削除</a>
                                                </div>
                                            </form>
                                        </div>
                                        <div>
                                            <p class="leading-relaxed text-right">{{ $road->created_at->format('Y-m-d') }}</p>
                                            <p class="leading-relaxed text-right">{{ $road->user->name }}</p>
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
    <script src="{{ mix('js/swiper.js') }}"></script>
</x-app-layout>
