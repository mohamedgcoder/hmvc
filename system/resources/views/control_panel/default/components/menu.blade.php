<ul class="nav nav-sidebar" data-nav-type="accordion">

    @include(_moduleName('admins').'::panel.components.menu', ['namespace' => _modulelowerName('admins')])
    @include(_moduleName('permissions').'::panel.components.menu', ['namespace' => _modulelowerName('permissions')])

    {{-- @include(_moduleName('agents').'::panel.components.menu') --}}

    {{-- <li class="nav-item-header pt-0 mt-2">
        <div class="text-uppercase font-size-xs line-height-xs">Clients</div>
        <i class="icon-menu" title="Main"></i>
    </li> --}}

    {{-- @include(_moduleName('accounts').'::panel.components.menu') --}}
    {{-- @include(_moduleName('companies').'::panel.components.menu') --}}
    {{-- @include(_moduleName('brands').'::panel.components.menu') --}}

    @include(_moduleName('settings').'::panel.components.menu', ['namespace' => _modulelowerName('settings')])
    @include(_moduleName('contacts').'::panel.components.menu', ['namespace' => _modulelowerName('contacts')])
    @include(_moduleName('languages').'::panel.components.menu', ['namespace' => _modulelowerName('languages')])

    <!-- /layout -->

</ul>
