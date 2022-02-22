<div class="-m-2">
  <div class="p-2 lg:lg:w-1/2 sm:w-full mx-auto">
    <div class="relative">
      <label for="name" class="leading-7 text-sm text-gray-600">名前 ※必須</label>
      <input type="text" id="name" name="name" value="{{ old('name') ?? $user->name }}" required class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
    </div>
  </div>
  <div class="p-2 lg:w-1/2 sm:w-full mx-auto">
      <div class="relative">
      <label for="avatar" class="leading-7 text-sm text-gray-600">プロフィール画像, 2MB以下</label>
      <input type="file" id="avatar" name="avatar" multiple accept="image/png, image/jpeg, image/jpg" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
      </div>
  </div>
  @if (explode('.', Route::currentRouteName())[1]==='edit')
    <div class="p-2 lg:w-1/2 sm:w-full mx-auto">
        <div class="relative">
            <div class="w-32">
                <x-thumbnail :filename="$user->background_image" type="users"/>
            </div>
        </div>
    </div>
  @endif
  <div class="p-2 lg:w-1/2 sm:w-full mx-auto">
      <div class="relative">
      <label for="background_image" class="leading-7 text-sm text-gray-600">背景画像, 横長画像推奨, 2MB以下</label>
      <input type="file" id="background_image" name="image" multiple accept="image/png, image/jpeg, image/jpg" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
      </div>
  </div>
  <div class="p-2 lg:w-1/2 sm:w-full mx-auto">
      <div class="relative">
        <label for="profile" class="leading-7 text-sm text-gray-600">プロフィール</label>
        <textarea id="profile" name="profile" rows="10" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">{{ old('profile') ?? $user->profile }}</textarea>
      </div>
  </div>
  <div class="p-2 lg:w-1/2 sm:w-full mx-auto">
      <div class="relative">
        <label for="url" class="leading-7 text-sm text-gray-600">URL</label>
        <input type="text" id="url" name="url" value="{{ old('url') ?? $user->url }}" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
      </div>
  </div>
  <div class="p-2 lg:w-1/2 sm:w-full mx-auto">
      <div class="relative">
        <label for="prefecture_id" class="leading-7 text-sm text-gray-600">都道府県</label>
        <select name="prefecture_id" id="prefecture_id" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
            @foreach($prefectures as $prefecture)
                @if ($prefecture->id===$user->prefecture_id)
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
        <label for="through" class="leading-7 text-sm text-gray-600">すり抜け</label>
        <div class="block mt-1 w-full">
            <div class="relative flex justify-around">
                <div><input type="radio" name="through" value="1" class="mr-2" @if($user->through===1) checked @endif>無</div>
                <div><input type="radio" name="through" value="0" class="mr-2" @if($user->through===0) checked @endif>有</div>
            </div>
        </div>
      </div>
  </div>
  <div class="p-2 w-full flex justify-around mt-4">
      <button type="button" onclick="location.href='{{ route('user.profile', ['user' => $user->uid]) }}'" class="bg-gray-200 border-0 py-2 px-8 focus:outline-none hover:bg-gray-400 rounded text-lg">戻る</button>
      <button type="submit" class="text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">登録する</button>
  </div>
</div>
