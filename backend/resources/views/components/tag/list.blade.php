<ul class="flex flex-wrap">
    @foreach($tags as $tag)
        <li class="mb-2 ml-2 text-sm shadow-sm bg-gray-200 rounded">
            {{ '#' . $tag->name }}
        </li>
    @endforeach
</ul>
