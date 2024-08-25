<li class="nav-item">
    <a href="{{ route('admin.panel') }}" class="nav-link @if(session('menu-item')[0] == 'contact')active @endif">
        <i class="fas fa-address-book" title="{{ _trans($namespace, 'dashboard.title') }}"></i>
        <span>
            {{ Str::title(_trans($namespace, 'title')) }}
        </span>
    </a>
</li>
