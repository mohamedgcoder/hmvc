@php
$li = ['all-'.$namespace, 'add-new-'._modulelowerName($namespace)];
@endphp

<li class="nav-item nav-item-submenu @if(isset(session('menu-item')[1]) && in_array(session('menu-item')[1], $li))nav-item-open @endif">
    <a href="#" class="nav-link @if(isset(session('menu-item')[0]) && session('menu-item')[0] == $namespace)active @endif">
        <i class="icon-user-lock" title="{{ _trans($namespace, 'title') }}"></i>
        <span>{{ Str::title(_trans($namespace, 'title')) }}</span>
    </a>

    <ul class="nav nav-group-sub" data-submenu-title="Layouts" @if(isset(session('menu-item')[1]) && in_array(session('menu-item')[1], $li))style="display: block" @endif>
        {{-- <li class="nav-item"><a href="{{ route($namespace.'.index') }}" class="nav-link @if(isset(session('menu-item')[1]) && session('menu-item')[1] == 'all-'.$namespace)active @endif">{{ Str::title(_trans($namespace, 'view.all')) }}</a></li>
        <li class="nav-item"><a href="{{ route($namespace.'.create') }}" class="nav-link @if(isset(session('menu-item')[1]) && session('menu-item')[1] == 'add-new-'._modulelowerSingularName($namespace))active @endif">{{ Str::title(_trans($namespace, 'add.new')) }}</a></li> --}}
    </ul>
</li>
