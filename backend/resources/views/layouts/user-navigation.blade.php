@php
   if (!auth('users')->user()) {
       $classes = "flex justify-between";
   }
@endphp

<nav x-data="{ open: false }" class="bg-white border-b border-gray-100 relative z-20">
    <!-- Primary Navigation Menu -->
    <div class='{{ $classes ?? '' }} max-w-7xl mx-auto px-4 sm:px-6 lg:px-8'>
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="/">
                        <div class="flex">
                            <img loading="lazy" width="50" height="50" srcset="{{ asset('images/icon_min.webp') }} 600w, {{ asset('images/icon.webp') }} 1024w" class="lazyload h-12 md:h-14 lg:h-14 sm:mr-4 sm:pt-2">
                            <img loading="lazy" width="114" height="64" srcset="{{ asset('images/logo_min.webp') }} 600w, {{ asset("images/logo.webp") }} 1024w" class="lazyload h-16 hidden md:block lg:block">
                        </div>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('user.bikes.index')" :active="request()->routeIs('user.bikes.index')">
                        {{ __('バイクの投稿') }}
                    </x-nav-link>
                </div>
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('user.roads.index')" :active="request()->routeIs('user.roads.index')">
                        {{ __('道の投稿') }}
                    </x-nav-link>
                </div>
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('user.boards.index')" :active="request()->routeIs('user.boards.index')">
                        {{ __('ツーリング掲示板') }}
                    </x-nav-link>
                </div>
            </div>

            @if(auth('users')->user())
                <div class="flex">
                    <!-- Inquiry -->
                    <div class="hidden lg:block">
                        <a href="{{ route('user.inquiry') }}" class="inline-block mr-4 mt-6 text-sm text-black underline">お問い合わせ</a>
                    </div>
                    <!-- Avatar -->
                    <div class="hidden lg:block">
                         <x-avatar type="nav" avatar="{{Auth::user()->avatar}}" uid="{{Auth::user()->uid}}" />
                    </div>

                    <!-- Settings Dropdown -->
                    <div class="hidden sm:flex sm:items-center sm:ml-6">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                                    @if(auth('users')->user())
                                        <div>{{ Auth::user()->name }}</div>
                                    @endif

                                    <div class="ml-1">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <!-- Authentication -->
                                <form method="POST" action="{{ route('user.logout') }}">
                                    @csrf

                                    <x-dropdown-link :href="route('user.logout')"
                                            onclick="event.preventDefault();
                                                        this.closest('form').submit();">
                                        {{ __('ログアウト') }}
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    </div>
                @endif
                @if(!auth('users')->user())
                    <div class="hidden md:block">
                        <div class="flex fixed top-0 right-0 px-4 py-4 sm:block z-10">
                            <a href="{{ route('user.login') }}" class="inline-block mr-4 mt-4 text-sm text-black underline">ログイン</a>
                            <a href="{{ route('user.register') }}" class="inline-block font-normal mx-auto text-black bg-orange-400 border-0 py-2 px-4 focus:outline-none hover:bg-orange-500 rounded-full text-sm">Tamari-Baに参加</a>
                        </div>
                    </div>
                @endif
            </div>


            <!-- Hamburger -->
            <div class="flex sm:hidden">
                @if(auth('users')->user())
                    <x-avatar type="nav" avatar="{{Auth::user()->avatar}}" uid="{{Auth::user()->uid}}" />
                @endif
                <div class="-mr-2 flex items-center sm:hidden">
                    <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        <!-- Responsive Navigation Menu -->
        <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
            <div class="pt-2 pb-3 space-y-1">
                <x-responsive-nav-link :href="route('user.bikes.index')" :active="request()->routeIs('user.bikes.index')">
                    {{ __('バイクの投稿') }}
                </x-responsive-nav-link>
            </div>
            <div class="pt-2 pb-3 space-y-1">
                <x-responsive-nav-link :href="route('user.roads.index')" :active="request()->routeIs('user.roads.index')">
                    {{ __('道の投稿') }}
                </x-responsive-nav-link>
            </div>
            <div class="pt-2 pb-3 space-y-1">
                <x-responsive-nav-link :href="route('user.boards.index')" :active="request()->routeIs('user.boards.index')">
                    {{ __('ツーリング掲示板') }}
                </x-responsive-nav-link>
            </div>
            <div class="pt-2 pb-3 space-y-1">
                <x-responsive-nav-link :href="route('user.inquiry')" :active="request()->routeIs('user.inquiry')">
                    {{ __('お問い合わせ') }}
                </x-responsive-nav-link>
            </div>


            <!-- Responsive Settings Options -->
            @if(auth('users')->user())
                <div class="pt-4 pb-1 border-t border-gray-200">
                    <div class="px-4">
                        <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                        <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                    </div>

                    <div class="mt-3 space-y-1">
                        <!-- Authentication -->
                        <form method="POST" action="{{ route('user.logout') }}">
                            @csrf

                            <x-responsive-nav-link :href="route('user.logout')"
                            onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('ログアウト') }}
                            </x-responsive-nav-link>
                        </form>
                    </div>
                </div>
            @endif
            @if(!auth('users')->user())
                <div class="pt-4 pb-1 border-t border-gray-200">
                    <div class="mt-3 space-y-1">
                        <!-- Authentication -->
                        <x-responsive-nav-link :href="route('user.login')" :active="request()->routeIs('user.login')">
                            {{ __('ログイン') }}
                        </x-responsive-nav-link>
                    </div>
                </div>
            @endif
        </div>
    </div>

</nav>
