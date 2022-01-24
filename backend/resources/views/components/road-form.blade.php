<div class="-m-2">
  <div class="p-2 w-1/2 mx-auto">
    <div class="relative">
      <label for="title" class="leading-7 text-sm text-gray-600">道の名前 ※必須</label>
      <input type="text" id="title" name="title" value="{{ old('title') ?? $road->title }}" required class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
    </div>
  </div>
  <div class="p-2 w-1/2 mx-auto">
      <div class="relative">
        <label for="latitude" class="leading-7 text-sm text-gray-600">緯度 ※必須</label>
        <input type="text" id="latitude" name="latitude" value="{{ old('latitude') ?? $road->latitude }}" required class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
      </div>
  </div>
  <div class="p-2 w-1/2 mx-auto">
      <div class="relative">
        <label for="longitude" class="leading-7 text-sm text-gray-600">経度 ※必須</label>
        <input type="text" id="longitude" name="longitude" value="{{ old('longitude') ?? $road->longitude }}" required class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
      </div>
  </div>
  <div class="p-2 w-1/2 mx-auto">
      <div class="relative">
        <label for="description" class="leading-7 text-sm text-gray-600">道の情報 ※必須</label>
        <textarea id="description" name="description" rows="10" required class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">{{ old('description') ?? $road->description }}</textarea>
      </div>
  </div>
  @if (explode('.', Route::currentRouteName())[2]==='edit')
    <div class="p-2 w-1/2 mx-auto">
        <div class="relative">
            <div class="w-32">
                <x-thumbnail :filename="$road->roadImages[0]->filename" type="roads"/>
            </div>
        </div>
    </div>
  @endif
  <div class="p-2 w-1/2 mx-auto">
      <div class="relative">
      <label for="image" class="leading-7 text-sm text-gray-600">画像（複数可）</label>
      <input type="file" id="image" name="files[][image]" multiple accept="image/png, image/jpeg, image/jpg" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
      </div>
  </div>
  <div class="p-2 w-full flex justify-around mt-4">
      <button type="button" onclick="location.href='{{ route('user.roads.index') }}'" class="bg-gray-200 border-0 py-2 px-8 focus:outline-none hover:bg-gray-400 rounded text-lg">戻る</button>
      <button type="submit" class="text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">登録する</button>
  </div>
</div>