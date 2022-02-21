<div class="-m-2">
  <div class="p-2 lg:w-1/2 sm:w-full mx-auto">
    <div class="relative">
      <label for="title" class="leading-7 text-sm text-gray-600">タイトル ※必須</label>
      <input type="text" id="title" name="title" value="{{ old('title') ?? $bike->title }}" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
    </div>
  </div>
  <div class="p-2 lg:w-1/2 sm:w-full mx-auto">
    <div class="relative">
      <label for="maker_id" class="leading-7 text-sm text-gray-600">メーカー ※必須</label>
      <select type="text" id="maker_id" name="maker_id" value="{{ old('maker_id') ?? $bike->maker_id }}" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
        @foreach($makers as $maker)
          <option value="{{ $maker->id }}">
              {{ $maker->name }}
          </option>
        @endforeach
      </select>
    </div>
  </div>
  <div class="p-2 lg:w-1/2 sm:w-full mx-auto">
    <div class="relative">
      <label for="type_id" class="leading-7 text-sm text-gray-600">タイプ ※必須</label>
      <select type="text" id="type_id" name="type_id" value="{{ old('type_id') ?? $bike->type_id }}" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
        @foreach($types as $type)
          <option value="{{ $type->id }}">
              {{ $type->name }}
          </option>
        @endforeach
      </select>
    </div>
  </div>
  <div class="p-2 lg:w-1/2 sm:w-full mx-auto">
    <div class="relative">
      <label for="name" class="leading-7 text-sm text-gray-600">名前（半角英数字） ※必須</label>
      <input type="text" id="name" name="name" value="{{ old('name') ?? $bike->name }}" placeholder="CB, YZF-R" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
    </div>
  </div>
  <div class="p-2 lg:w-1/2 sm:w-full mx-auto">
    <div class="relative">
      <label for="engine_size" class="leading-7 text-sm text-gray-600">排気量（半角数字） ※必須</label>
      <input type="number" id="engine_size" name="engine_size" value="{{ old('engine_size') ?? $bike->engine_size }}" placeholder="400, 650" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
    </div>
  </div>
  <div class="p-2 lg:w-1/2 sm:w-full mx-auto">
      <div class="relative">
        <label for="description" class="leading-7 text-sm text-gray-600">バイクの情報 ※必須</label>
        <textarea id="description" name="description" rows="10" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">{{ old('description') ?? $bike->description }}</textarea>
      </div>
  </div>
  @if (explode('.', Route::currentRouteName())[2]==='edit')
    <div class="p-2 lg:w-1/2 sm:w-full mx-auto">
        <div class="relative">
            <div class="w-1/2 mx-auto">
                <x-thumbnail :filename="$bike->bikeImages[0]->filename ?? ''" type="bikes"/>
            </div>
        </div>
    </div>
  @endif
  <div class="p-2 lg:w-1/2 sm:w-full mx-auto">
      <div class="relative">
      <label for="image" class="leading-7 text-sm text-gray-600">画像（複数可）横長画像推奨, 2MB以下</label>
      <input type="file" id="image" name="files[][image]" multiple accept="image/png, image/jpeg, image/jpg" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
      </div>
  </div>
  <x-tag.form :tags="$tags" />
  <div class="p-2 w-full flex justify-around mt-4">
      <button type="button" onclick="location.href='{{ route('user.bikes.index') }}'" class="bg-gray-200 border-0 py-2 px-8 focus:outline-none hover:bg-gray-400 rounded text-lg">戻る</button>
      <button type="submit" class="text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">登録する</button>
  </div>
</div>
