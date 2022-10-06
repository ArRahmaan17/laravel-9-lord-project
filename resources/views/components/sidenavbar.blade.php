<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">{{ $appTitle }}</a>
            {{-- <a href="index.html">Rarewel Lord</a> --}}
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">Rl</a>
        </div>
        <ul class="sidebar-menu">
            @foreach ($navbar as $item)
                @if (!empty($item->child))
                    <li class="dropdown">
                        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                                class="{{ $item['icon'] }}"></i>
                            <span>{{ $item['name'] }}</span></a>
                        <ul class="dropdown-menu">
                            @foreach ($item->child as $child)
                                <li><a class="nav-link" href="{{ $child->link }}">{{ $child->nama }}</a></li>
                            @endforeach
                        </ul>
                    </li>
                @else
                    <li><a class="nav-link" href="{{ $item->link }}"><i
                                class="{{ $item->icon }}"></i><span>{{ $item->nama }}</span></a></li>
                @endif
            @endforeach
        </ul>
    </aside>
</div>
