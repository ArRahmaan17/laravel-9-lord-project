<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="/">{{ $appTitle }}</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="/">Rl</a>
        </div>
        <ul class="sidebar-menu">
            @foreach ($navbar as $item)
                @if (json_decode($item['menuChild']) != [])
                    <li class="dropdown">
                        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                                class="{{ $item['menuIcon'] }}"></i>
                            <span>{{ $item['menuName'] }}</span></a>
                        <ul class="dropdown-menu">
                            @foreach (json_decode($item['menuChild']) as $child)
                                <li><a class="nav-link" href="{{ $child->route }}">{{ $child->name }}</a></li>
                            @endforeach
                        </ul>
                    </li>
                @else
                    <li><a class="nav-link" href="{{ $item['menuUrl'] }}"><i
                                class="{{ $item['menuIcon'] }}"></i><span>{{ $item['menuName'] }}</span></a></li>
                @endif
            @endforeach
        </ul>
    </aside>
</div>
