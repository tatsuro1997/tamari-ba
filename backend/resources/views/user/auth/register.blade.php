<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('user.register') }}" enctype="multipart/form-data">
            @csrf

            <!-- Name -->
            <div>
                <x-label for="name" :value="__('名前 ※必須')" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
            </div>

            <!-- Avatar -->
            <div class="mt-4">
                <x-label for="avatar" :value="__('プロフィール画像 ※必須, 2MB以下')" />

                <x-input id="avatar" type="file" name="avatar" autofocus class="block mt-1 w-full" />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="uid" :value="__('ユーザーID ※必須, 半角英数字, 変更不可')" />

                <x-input id="uid" class="block mt-1 w-full" type="text" name="uid" :value="old('uid')" required />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('メールアドレス ※必須')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('パスワード ※必須')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('確認用パスワード ※必須')" />

                <x-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required />
            </div>

            <!-- Age -->
            <div class="mt-4">
                <x-label for="birthday" :value="__('年齢 ※必須')" />
                <x-input id="birthday" class="block mt-1 w-full" type="date" name="birthday" :value="old('birthday')" required />
            </div>

            <!-- Gender -->
            <div class="mt-4">
                <x-label for="gender" :value="__('性別 ※必須')" />
                <div class="block mt-1 w-full">
                    <div class="relative flex justify-around">
                        <div><input type="radio" name="gender" value="1" class="mr-2" checked>男性</div>
                        <div><input type="radio" name="gender" value="0" class="mr-2">女性</div>
                    </div>
                </div>
            </div>

            <!-- Prefecture -->
            <div class="mt-4">
                <x-label for="prefecture_id" :value="__('都道府県 ※必須')" />
                <select name="prefecture_id" id="prefecture_id" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                    @foreach($prefectures as $prefecture)
                        <option value="{{ $prefecture->id }}">
                            {{ $prefecture->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Experience -->
            <div class="mt-4">
                <x-label for="years_of_experience" :value="__('バイク歴(年) ※必須')" />
                <x-input id="years_of_experience" class="block mt-1 w-full" type="number" name="years_of_experience" :value="old('years_of_experience')" required />
            </div>

            <!-- Through -->
            <div class="mt-4">
                <x-label for="through" :value="__('すり抜け ※必須')" />
                <div class="block mt-1 w-full">
                    <div class="relative flex justify-around">
                        <div><input type="radio" name="through" value="1" class="mr-2" checked>無</div>
                        <div><input type="radio" name="through" value="0" class="mr-2">有</div>
                    </div>
                </div>
            </div>

            <!-- Role -->
            <input type="hidden" name="role" value="5">

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('user.login') }}">
                    {{ __('すでに登録している場合') }}
                </a>

                <x-button class="ml-4">
                    {{ __('登録') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
