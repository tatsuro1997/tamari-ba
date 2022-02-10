@php
    if($type==='bike'){
        $route = route('user.bikes.index');
    }
    if($type==='road'){
        $route = route('user.roads.index');
    }
    if($type==='board'){
        $route = route('user.boards.index');
    }
@endphp

<form class="w-full h-12 text-center flex" method="GET" action="{{ $route }}">
    <input type="search" placeholder="検索" name="search" value="@if (isset($search)) {{ $search }} @endif" class="w-1/2 h-10 mr-2 bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
    <div class="flex h-10 justify-content-center">
        <button class="flex-shrink-0 bg-blue-500 hover:bg-blue-700 border-blue-500 hover:border-blue-700 text-sm border-4 text-white py-1 px-2 rounded" type="submit">検索</button>
        <button class="my-2 ml-2">
            <a href="{{ $route }}" class="flex-shrink-0 border-transparent border-2 text-gray-500 hover:text-gray-800 text-sm py-1 px-2 rounded border-gray-400 border-dotted">
                クリア
            </a>
        </button>
    </div>
</form>
