<ul class="nav nav-sidebar" data-nav-type="accordion">
    @foreach ($menu as $group => $items)
        @include(_current_theme('components.menu.group'), ['item' => $group])

        @if(!empty($items))
            @foreach($items as $item)
                @if(!empty($item['children']))
                    @include(_current_theme('components.menu.parent'), ['item' => $item])
                @else
                    @if(env('APP_DEBUG') && Route::has($item['module'].'.'.$item['url']))
                        <li class="nav-item">
                            <a href="{{route($item['module'].'.'.$item['url'])}}" class="nav-link @if(Str::lower(session('menu-item')[0]) == $item['module'].'-'.$item['url'])active @endif">
                                <i class="{{$item['icon']}}" title="{{ $item['name'] }}"></i>
                                <span>
                                    {{Str::title($item['name'])}}
                                    {{-- <span class="d-block font-weight-normal opacity-50">No active orders</span> --}}
                                </span>
                            </a>
                        </li>
                    @endif
                @endif
            @endforeach
        @endif

    @endforeach

    {{-- @include(_moduleName('admins').'::panel.components.menu', ['namespace' => _modulelowerName('admins')])
    @include(_moduleName('permissions').'::panel.components.menu', ['namespace' => _modulelowerName('permissions')]) --}}

    {{-- @include(_moduleName('agents').'::panel.components.menu') --}}

    {{-- <li class="nav-item-header pt-0 mt-2">
        <div class="text-uppercase font-size-xs line-height-xs">Clients</div>
        <i class="icon-menu" title="Main"></i>
    </li> --}}

    {{-- @include(_moduleName('accounts').'::panel.components.menu') --}}
    {{-- @include(_moduleName('companies').'::panel.components.menu') --}}
    {{-- @include(_moduleName('brands').'::panel.components.menu') --}}

    {{-- @include(_moduleName('settings').'::panel.components.menu', ['namespace' => _modulelowerName('settings')])
    @include(_moduleName('contacts').'::panel.components.menu', ['namespace' => _modulelowerName('contacts')])
    @include(_moduleName('languages').'::panel.components.menu', ['namespace' => _modulelowerName('languages')]) --}}

    <!-- /layout -->

</ul>
