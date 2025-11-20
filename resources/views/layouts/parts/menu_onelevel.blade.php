<ul class="nav nav-pills flex-column mb-auto">
    @foreach ($items->reverse() as $item)
        <li class="nav-item ms-4 dropdown mb-1">
            <div class="d-flex">
                <a style="color:rgb(228, 228, 228)" class="link-light"
                    href="{{ route('departaments.show', $item) }}">{{ $item->name }}</a>
                <a href="#" style="color:gray"
                    class="link-light d-flex align-items-center text-white text-decoration-none dropdown-toggle"
                    id="dropdownUser2" data-bs-toggle="dropdown" aria-expanded="false">
                </a>
                <ul class="dropdown-menu
                        dropdown-menu-dark text-small shadow"
                    aria-labelledby="dropdownUser2">

                    @foreach ($subitems->reverse() as $subitem)
                        @if ($subitem->departament_id === $item->id)
                            <li class="nav-item">
                                <a style="" class="link-light dropdown-item" 
                                href="{{ route('slots.index', [$subitem->departament_id, $subitem->id]) }}">
                                {{ $subitem->name }}
                                </a>
                            </li>
                        @endif
                    @endforeach
                    <li class="nav-item">
                        <a href="{{ route('units.create', $item->id) }}" style="" class="link-light dropdown-item"><b>+</b> новый</a>
                    </li>
                </ul>
            </div>
        </li>
    @endforeach
    <li class="nav-item ms-4 dropdown">
        <a style="color:rgb(228, 228, 228)" class="link-light"
            href="{{ route('departaments.create') }}"><b>+</b> новый</a>
    </li>

</ul>
