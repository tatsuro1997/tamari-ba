<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <x-flash-message status="session('status')" />
                    <section class="text-gray-600 body-font">
                        <div class="container px-5 py-8 mx-auto">
                            <div class="flex justify-end mb-4">
                                <x-search-form :search="isset($search)" type="board" />
                                <button onclick="location.href='{{ route('user.boards.create') }}'"  class="text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">募集作成する</button>
                            </div>
                            <x-board.index :boards="$boards" />
                        </div>
                    </section>
                    {{-- 検索後ページネイトで遷移しても検索結果を保持 --}}
                    {{ $boards->appends(request()->input())->links() }}
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
