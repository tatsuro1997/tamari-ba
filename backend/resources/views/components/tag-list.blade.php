<ul class="nav nav-pills mb-2">
    {{-- <li class="nav-item">
        {{ link_to_route('user.roads.index', 'すべて', null, [
            'class' => 'nav-link'.
            (request()->segment(3) === null ? ' active' : '')
        ]) }}
    </li> --}}
    @foreach($tags as $tag)
        <li class="nav-item">
            {{ link_to_route('user.roads.index.tag', "#$tag->name", $tag->slug, [
                'class' => 'nav-link'.
                (request()->segment(3) === $tag->slug ? ' active' : '')
            ]) }}
        </li>
    @endforeach
</ul>
