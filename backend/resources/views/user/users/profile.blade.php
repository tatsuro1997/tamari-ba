<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <x-flash-message status="session('status')" />
                    <section class="text-gray-600 body-font">
                        <div class="xl:w-3/4 md:w-full container px-5 py-8 mx-auto">
                            <div class="flex justify-end mb-4">
                                @can('isAdmin')
                                    <button onclick="location.href='{{ route('owner.tags.index') }}'"  class="text-black bg-gray-200 border-0 py-2 px-8 focus:outline-none hover:bg-gray-400 rounded text-lg mr-4">タグの編集</button>
                                    <x-road.import />
                                @endcan
                                {{-- <button onclick="location.href='{{ route('user.roads.index') }}'"  class="text-black bg-gray-200 border-0 py-2 px-8 focus:outline-none hover:bg-gray-400 rounded text-lg">一覧に戻る</button> --}}
                            </div>
                            <div class="h-full border-2 border-gray-200 border-opacity-60 rounded-lg overflow-hidden">
                                <x-thumbnail filename="{{ $user->background_image ?? ''}}" type="users" />
                                <div class="flex justify-around h-20">
                                    <x-avatar type="profile" avatar="{{$user->avatar}}" uid="{{$user->uid}}" />
                                    @if ($user->id === Auth::user()->id)
                                        <button  onclick="location.href='{{ route('user.edit', ['user' => $user->uid ]) }}'" class="text-black bg-gray-200 border-0 py-2 px-6 mr-2 focus:outline-none hover:bg-gray400 rounded h-10 mt-4">Edit Profile</button>
                                    @endif
                                </div>
                                <div class="p-6 relative">
                                    <h1 class="title-font text-lg font-medium text-gray-900 mb-3">{{ $user->name }}</h1>
                                    <p class="leading-relaxed mb-3">{!!nl2br(e($user->profile))!!}</p>
                                    <div class="lg:flex justify-between">
                                        @if ($user->url)
                                            <a href="{{ $user->url }}" class="leading-relaxed text-right" target="_blank" rel="noopener noreferrer"><i class="fas fa-link mr-2"></i>{{ $user->url }}</a>
                                        @else
                                            <p class="leading-relaxed text-right"><i class="fas fa-link mr-2"></i>URLが設定されていません</p>
                                        @endif
                                        <div class="flex justify-end">
                                            @if ($user->through==0)
                                                <p class="leading-relaxed mb-1 mr-2"><i class="fas fa-motorcycle mr-2 w-4"></i></p>
                                            @endif
                                            <p class="leading-relaxed"><i class="far fa-calendar-alt mr-2"></i>{{ $user->created_at->format('Y-m-d') }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <x-user.posts :user="$user" :bikes="$bikes" :roads="$roads" :boards="$boards" :like="$like" />
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
