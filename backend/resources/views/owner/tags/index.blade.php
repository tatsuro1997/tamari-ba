<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <x-flash-message status="session('status')" />
                    <section class="text-gray-600 body-font">
                        @foreach ($tags as $key => $tag)
                            <form method="post" action="{{ route('owner.tags.destroy', ['id' => $key ]) }}">
                                @csrf
                                @method('delete')
                                <div class="w-full flex justify-around">
                                    <div class="p-2 w-1/4 mx-auto">
                                        <div class="relative">
                                            <div class="{{ $errors->has('tags.*') ? 'is-invalid' : '' }}">
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label" for="tag{{$key}}">{{ $tag }}</label>
                                                </div>
                                            </div>
                                            @error('tags.*')
                                            <span class="invalid-feedback" role="alert">
                                                {{ $message }}
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="w-1/4">
                                        <button type="submit" class="border-0 py-2"><i class="far fa-trash-alt"></i></button>
                                    </div>
                                </div>
                            </form>
                        @endforeach
                        <form method="post" action="{{ route('owner.tags.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="-m-2">
                                <div class="p-2 lg:w-1/2 sm:w-full mx-auto">
                                    <div class="relative">
                                        <label for="name" class="leading-7 text-sm text-gray-600">タグ名</label>
                                        <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="バイク" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                        </div>
                                    </div>
                                    <div class="p-2 lg:w-1/2 sm:w-full mx-auto">
                                        <div class="relative">
                                        <label for="slug" class="leading-7 text-sm text-gray-600">タグslug※ローマ字</label>
                                        <input type="text" id="slug" name="slug" value="{{ old('slug') }}" placeholder="bike" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                        </div>
                                    </div>
                                    <div class="p-2 w-full flex justify-around mt-4">
                                        <button type="button" onclick="location.href='{{ route('user.profile', ['user' => $uid ?? Auth::user()->uid]) }}'" class="bg-gray-200 border-0 py-2 px-8 focus:outline-none hover:bg-gray-400 rounded text-lg">戻る</button>
                                        <button type="submit" class="text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">登録する</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
