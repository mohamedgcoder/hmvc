<li class="nav-item nav-item-submenu @if(isset(session('menu-item')[1]) && Str::lower(session('menu-item')[1]) == $item['url'])nav-item-open @endif">
    <a href="{{$item['url']}}" class="nav-link @if(isset(session('menu-item')[0]) && Str::lower(session('menu-item')[0]) == $item['module'])active @endif">
        <i class="{{$item['icon']}}" title="{{ $item['name'] }}"></i>
        <span>{{ Str::title($item['name']) }}</span>
    </a>

    <ul class="nav nav-group-sub" data-submenu-title="Layouts" @if(isset(session('menu-item')[0]) && Str::lower(session('menu-item')[0]) == $item['module'])style="display: block" @endif>
        @foreach($item['children'] as $link)
            {{-- @include(_current_theme('components.menu.link'), ['link' => $link]) --}}
            <li class="nav-item">
                <a href="{{ route($link['module'].'.'.$link['url']) }}" class="nav-link @if(isset(session('menu-item')[1]) && Str::lower(session('menu-item')[1]) == $link['url'])active @endif">
                    <i class="{{$link['icon']}}" title="{{ $link['name'] }}"></i>
                    <span>
                        {{Str::title($link['name'])}}
                        {{-- <span class="d-block font-weight-normal opacity-50">No active orders</span> --}}
                    </span>
                </a>
            </li>
        @endforeach
    </ul>
</li>
