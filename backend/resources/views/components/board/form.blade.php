<div class="-m-2">
  <div class="p-2 lg:w-1/2 sm:w-full mx-auto">
    <div class="relative">
      <label for="title" class="leading-7 text-sm text-gray-600">募集名 ※必須</label>
      <input type="text" id="title" name="title" value="{{ old('title') ?? $board->title }}" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
    </div>
  </div>
  <div class="p-2 lg:w-1/2 sm:w-full mx-auto">
      <div class="relative">
        <label for="date" class="leading-7 text-sm text-gray-600">募集日時 ※必須</label>
        <input type="datetime-local" id="date" name="date" value="{{ old('date') ?? $board->date }}" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
      </div>
  </div>
  <div class="p-2 lg:w-1/2 sm:w-full mx-auto">
      <div class="relative">
        <label for="prefecture_id" class="leading-7 text-sm text-gray-600">募集地域 ※必須</label>
        <select type="text" id="prefecture_id" name="prefecture_id" value="{{ old('prefecture_id') ?? $board->prefecture_id }}" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
          @foreach($prefectures as $prefecture)
            @if ($prefecture->id===$board->prefecture_id)
              <option value="{{ $prefecture->id }}" selected>{{ $prefecture->name }}</option>
            @else
              <option value="{{ $prefecture->id }}">{{ $prefecture->name }}</option>
            @endif
          @endforeach
        </select>
      </div>
  </div>
  <div class="p-2 lg:w-1/2 sm:w-full mx-auto">
      <div class="relative">
        <label for="location" class="leading-7 text-sm text-gray-600">集合場所 ※必須</label>
        <input type="text" id="location" name="location" value="{{ old('location') ?? $board->location }}" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
      </div>
  </div>
  <div class="p-2 lg:w-1/2 sm:w-full mx-auto">
      <div class="relative">
        <label for="destination" class="leading-7 text-sm text-gray-600">目的地 ※必須</label>
        <input type="text" id="destination" name="destination" value="{{ old('destination') ?? $board->destination }}" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
      </div>
  </div>
  <div class="p-2 lg:w-1/2 sm:w-full mx-auto">
      <div class="relative">
        <label for="description" class="leading-7 text-sm text-gray-600">募集詳細 ※必須</label>
        <textarea id="description" name="description" rows="10" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">{{ old('description') ?? $board->description }}</textarea>
      </div>
  </div>
  @if (explode('.', Route::currentRouteName())[2]==='edit')
    <div class="p-2 lg:w-1/2 sm:w-full mx-auto">
        <div class="relative">
            <div class="w-1/2 mx-auto">
                <x-thumbnail :filename="$board->boardImages->first()->filename ?? ''" :board="$board" type="boards"/>
            </div>
        </div>
    </div>
  @endif
  <div class="p-2 lg:w-1/2 sm:w-full mx-auto">
      <div class="relative">
      <label for="image" class="leading-7 text-sm text-gray-600">画像（複数可）横長画像推奨, 2MB以下※目的地のイメージ画像があると募集が集まりやすいです</label>
      <input type="file" id="image" name="files[][image]" multiple accept="image/png, image/jpeg, image/jpg" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
      </div>
  </div>

  @if (explode('.', Route::currentRouteName())[2]==='edit')
    <div class="p-2 lg:w-1/2 sm:w-full mx-auto">
      <div class="relative">
        <label for="deadline" class="leading-7 text-sm text-gray-600">募集状況</label>
        <div class="relative flex justify-around">
            <div><input type="radio" name="deadline" value="0" class="mr-2" checked>募集中</div>
            <div><input type="radio" name="deadline" value="1" class="mr-2">募集を終了</div>
        </div>
    </div>
  @else
    <input value="0" type="hidden" name="deadline" />
  @endif

  <div class="p-2 w-full flex justify-around mt-4">
      <button type="button" onclick="location.href='{{ route('user.boards.index') }}'" class="bg-gray-200 border-0 py-2 px-8 focus:outline-none hover:bg-gray-400 rounded text-lg">戻る</button>
      <button type="submit" class="text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">登録する</button>
  </div>
</div>
