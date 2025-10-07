<ul class="nav nav-pills flex-column mb-auto">
    @foreach ($items->reverse() as $item)
        <li class="nav-item ms-4">
            <a style="color:gray" class="link-light" href="#">{{ $item->name }}</a>
        </li>
    @endforeach
</ul>
