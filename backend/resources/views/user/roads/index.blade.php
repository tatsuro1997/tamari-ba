<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            道の投稿一覧
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <x-flash-message status="session('status')" />
                    <section class="text-gray-600 body-font">
                        <div class="container px-5 py-8 mx-auto">
                            <div class="flex justify-end mb-2">
                                <button onclick="location.href='{{ route('user.roads.create') }}'" class="text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">新規登録</button>
                            </div>
                            <div class="flex justify-end mr-auto">
                                <x-search-form :search="isset($search)" type="road" />
                            </div>
                            <x-road.index :roads="$roads" :like="$like" type="index" />
                        </div>
                    </section>
                    {{-- 検索後ページネイトで遷移しても検索結果を保持 --}}
                    {{ $roads->appends(request()->input())->links() }}
                </div>
            </div>
        </div>
    </div>

<script>
  'use strict'
  function deletePost(e){
    'use strict';
    if (confirm('本当に削除しても良いですか？')){
      document.getElementById('delete_'+ e.dataset.id).submit();
    }
  }
</script>
</x-app-layout>
