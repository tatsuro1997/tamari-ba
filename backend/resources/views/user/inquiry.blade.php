<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />
                    <form method="post" action="{{ route('user.send.inquiry') }}">
                        @csrf
                        <div class="-m-2">
                          <div class="p-2 lg:w-1/2 sm:w-full mx-auto">
                            <div class="relative">
                              <label for="name" class="leading-7 text-sm text-gray-600">お名前 ※必須</label>
                              <input type="text" id="name" name="name" value="{{ $user->name ?? ''}}" required class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                            </div>
                          </div>
                          <div class="p-2 lg:w-1/2 sm:w-full mx-auto">
                            <div class="relative">
                              <label for="item" class="leading-7 text-sm text-gray-600">項目 ※必須</label>
                              <select type="text" id="item" name="item" value="{{ old('item') }}" required class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                <option value="お問い合わせ">
                                    {{ "お問い合わせ" }}
                                </option>
                                <option value="改善要望">
                                    {{ "改善要望" }}
                                </option>
                              </select>
                            </div>
                          </div>
                          <div class="p-2 lg:w-1/2 sm:w-full mx-auto">
                            <div class="relative">
                              <label for="content" class="leading-7 text-sm text-gray-600">内容 ※必須</label>
                              <textarea id="content" name="content" value="{{ old('content') }}" required class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"></textarea>
                            </div>
                          </div>
                          <div class="p-2 w-full flex justify-around mt-4">
                              <button type="button" onclick="location.href='{{ route('user.welcome') }}'" class="bg-gray-200 border-0 py-2 px-8 focus:outline-none hover:bg-gray-400 rounded text-lg">戻る</button>
                              <button type="submit" class="text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">送信</button>
                          </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
