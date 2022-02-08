<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="/">
                        <x-application-logo class="block h-10 w-auto fill-current text-gray-600" />
                    </a>
                </div>
            </div>

            <!-- Login/Logout -->
            <div class="flex fixed top-0 right-0 px-4 py-4 sm:block">
                <a href="{{ route('user.login') }}" class="inline-block mr-4 mt-4 text-sm text-black underline">ログイン</a>
                <a href="{{ route('user.register') }}" class="inline-block font-normal mx-auto text-black bg-orange-400 border-0 py-2 px-4 focus:outline-none hover:bg-orange-500 rounded-full text-sm">Tamari-Baに参加</a>
            </div>
        </div>
    </div>
</nav>
