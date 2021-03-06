<div class="flex flex-wrap -m-4">
    @foreach ($bikes as $bike)
        <div class="p-4 lg:w-1/3 md:w-1/2">
            <a href="{{ route('user.bikes.show', ['bike' => $bike->id]) }}">
                <div class="h-full border-2 border-gray-200 border-opacity-60 rounded-lg overflow-hidden">
                    <x-thumbnail filename="{{ $bike->bikeImages->first()->filename ?? ''}}" type="bikes" />
                    <div class="p-6">
                        <div class="flex justify-between">
                            <h1 class="title-font text-lg font-medium text-gray-900 mb-3">{{ $bike->title }}</h1>
                            <div class="flex">
                                @if ($type !== 'welcome')
                                    <x-like :bike="$bike" :like="$like" type="bike" />
                                @endif
                                @can('update', $bike)
                                    <a onclick="location.href='{{ route('user.bikes.edit', ['bike' => $bike->id ]) }}'" class="py-2 px-2"><i class="far fa-edit"></i></a>
                                @endcan
                                @can('delete', $bike)
                                    <form id="delete_{{ $bike->id }}" method="post" action="{{ route('user.bikes.destroy', ['bike' => $bike->id ]) }}">
                                        @csrf
                                        @method('delete')
                                        <div class="w-full flex justify-around">
                                            <a href="#" data-id="{{ $bike->id }}" onclick="deletePost(this)" class="border-0 py-2"><i class="far fa-trash-alt"></i></a>
                                        </div>
                                    </form>
                                @endcan
                            </div>
                        </div>
                        <x-tag.list :tags="$bike->tags" />
                        <div class="flex flex-wrap">
                            <i class="fas fa-motorcycle mr-2 w-4"></i>
                            <div class="leading-relaxed text-right mx-4">{{ $bike->maker->name }}</div>
                            <div class="leading-relaxed text-right">{{ $bike->type->name }}</div>
                            <div class="leading-relaxed text-right mx-4">{{ $bike->name }}</div>
                            <div class="leading-relaxed text-right">{{ $bike->engine_size }}</div>
                        </div>
                        @if ($type=='index' || $type=='welcome')
                            <p class="leading-relaxed text-left mb-3 h-24">{{ Str::limit($bike->description, 100, ' ...') }}</p>
                        @endif
                        <div class="flex justify-end">
                            <div class="leading-relaxed text-right">{{ $bike->created_at->format('Y-m-d') }}</div>
                            @if ($type=='index' || $type=='welcome')
                                <div class="leading-relaxed text-right ml-2"><a href="{{ route('user.profile', ['user' => $bike->user->uid ?? Auth::user()->uid]) }}" class="border-b-2 border-indigo-100">{{ $bike->user->name }}</a></div>
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
