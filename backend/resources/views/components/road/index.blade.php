<div class="flex flex-wrap -m-4">
    @foreach ($roads as $road)
        <div class="p-4 lg:w-1/3 md:w-1/2 w-full">
            <a href="{{ route('user.roads.show', ['road' => $road->id]) }}">
                <div class="h-full border-2 border-gray-200 border-opacity-60 rounded-lg overflow-hidden">
                    <x-thumbnail filename="{{ $road->filename ?? ''}}" type="roads" />
                    <div class="p-6">
                        <div class="flex justify-between">
                            <h1 class="title-font text-lg font-medium text-gray-900 mb-3">{{ $road->title }}</h1>
                            <div class="flex">
                                @if ($type !== 'welcome')
                                    <x-like :road="$road" :like="$like" type="road" />
                                @endif
                                @can('update', $road)
                                    <a onclick="location.href='{{ route('user.roads.edit', ['road' => $road->id ]) }}'" class="py-2 px-2"><i class="far fa-edit"></i></a>
                                @endcan
                                @can('delete', $road)
                                    <form id="delete_{{ $road->id }}" method="post" action="{{ route('user.roads.destroy', ['road' => $road->id ]) }}">
                                        @csrf
                                        @method('delete')
                                        <div class="w-full flex justify-around">
                                            <a href="#" data-id="{{ $road->id }}" onclick="deletePost(this)" class="border-0 py-2"><i class="far fa-trash-alt"></i></a>
                                        </div>
                                    </form>
                                @endcan
                            </div>
                        </div>
                        <x-tag.list :tags="$road->tags" />
                        {{-- @if ($type=='index' || $type=='welcome')
                            <p class="leading-relaxed text-left mb-3 h-24">{{ Str::limit($road->description, 100, ' ...') }}</p>
                        @endif --}}
                        <div class="flex justify-end">
                            <div class="leading-relaxed text-right">{{ $road->created_at->format('Y-m-d') }}</div>
                            @if ($type=='index' || $type=='welcome')
                                <div class="leading-relaxed text-right ml-2"><a href="{{ route('user.profile', ['user' => $road->user->uid ?? Auth::user()->uid]) }}" class="border-b-2 border-indigo-100">{{ $road->user->name }}</a></div>
                            @endif
                        </div>
                    </div>
                </div>
            </a>
        </div>
    @endforeach
</div>

<script>
  'use strict'
  function deletePost(e){
    'use strict';
    if (confirm('??????????????????????????????????????????')){
      document.getElementById('delete_'+ e.dataset.id).submit();
    }
  }
</script>
