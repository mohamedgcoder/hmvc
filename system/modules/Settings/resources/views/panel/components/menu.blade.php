<li class="nav-item-header pt-0 mt-2">
    <div class="text-uppercase font-size-xs line-height-xs">
        {{ Str::title(_trans($namespace, 'title')) }}
    </div>
    <i class="icon-menu" title="{{ Str::title(_trans($namespace, 'title')) }}"></i>
</li>

@php
$li = ['identity', 'appearance','system' , 'seo', 'social', 'security', 'integrations'];
@endphp

<li class="nav-item nav-item-submenu @if(isset(session('menu-item')[1]) && in_array(session('menu-item')[1], $li))nav-item-open @endif">
    <a href="#" class="nav-link @if(isset(session('menu-item')[0]) && session('menu-item')[0] == $namespace)active @endif">
        <i class="fas fa-cogs" title="{{ _trans($namespace, 'general.title') }}"></i>
        <span>{{ Str::title(_trans($namespace, 'general.title')) }}</span>
    </a>

    <ul class="nav nav-group-sub" data-submenu-title="Layouts" @if(isset(session('menu-item')[1]) && in_array(session('menu-item')[1], $li))style="display: block" @endif>
        <li class="nav-item">
            <a href="{{ route(_modulePrefix($namespace).'.identity') }}" class="nav-link @if(isset(session('menu-item')[1]) && session('menu-item')[1] == 'identity')active @endif">
                <i class="fas fa-fingerprint"></i> {{ Str::title(_trans($namespace, 'identity.title')) }}
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route(_modulePrefix($namespace).'.appearance') }}" class="nav-link @if(isset(session('menu-item')[1]) && session('menu-item')[1] == 'appearance')active @endif">
                <i class="fas fa-theater-masks"></i> {{ Str::title(_trans($namespace, 'appearance.title')) }}
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route(_modulePrefix($namespace).'.system') }}" class="nav-link @if(isset(session('menu-item')[1]) && session('menu-item')[1] == 'system')active @endif">
                <i class="fas fa-wrench"></i> {{ Str::title(_trans($namespace, 'system.title')) }}
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route(_modulePrefix($namespace).'.seo') }}" class="nav-link @if(isset(session('menu-item')[1]) && session('menu-item')[1] == 'seo')active @endif">
                <i class="fab fa-searchengin"></i> {{ Str::title(_trans($namespace, 'seo.title')) }}
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route(_modulePrefix($namespace).'.social') }}" class="nav-link @if(isset(session('menu-item')[1]) && session('menu-item')[1] == 'social')active @endif">
                <i class="fas fa-share-alt"></i> {{ Str::title(_trans($namespace, 'social.title')) }}
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route(_modulePrefix($namespace).'.security') }}" class="nav-link @if(isset(session('menu-item')[1]) && session('menu-item')[1] == 'security')active @endif">
                <i class="fas fa-key"></i> {{ Str::title(_trans($namespace, 'security.title')) }}
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route(_modulePrefix($namespace).'.integrations') }}" class="nav-link @if(isset(session('menu-item')[1]) && session('menu-item')[1] == 'integrations')active @endif">
                <i class="fas fa-link"></i> {{ Str::title(_trans($namespace, 'integrations.title')) }}
            </a>
        </li>
        {{-- <li class="nav-item"><a href="{{ route($namespace.'.index') }}" class="nav-link @if(isset(session('menu-item')[1]) && session('menu-item')[1] == 'all-')active @endif">{{ Str::title(_trans($namespace, 'view.all')) }}</a></li>
        <li class="nav-item"><a href="{{ route($namespace.'.create') }}" class="nav-link @if(isset(session('menu-item')[1]) && session('menu-item')[1] == 'add-new-'._modulePrefix($namespace))active @endif">{{ Str::title(_trans($namespace, 'add.new')) }}</a></li> --}}
    </ul>
</li>
