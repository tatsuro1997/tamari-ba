<ul class="flex flex-wrap">
    @foreach($tags as $tag)
        <li class="mb-2 ml-2 text-sm shadow-sm bg-gray-200 rounded hover:text-white hover:bg-gray-500">
            {{ link_to_route('user.roads.index.tag', "#$tag->name", $tag->slug, [
                (request()->segment(3) === $tag->slug ? ' active' : '')
            ]) }}
        </li>
    @endforeach
</ul>
