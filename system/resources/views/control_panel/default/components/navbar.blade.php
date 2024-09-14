<div class="navbar navbar-expand-lg navbar-dark navbar-static">
    <div class="d-flex flex-1 d-lg-none">
        <button type="button" class="navbar-toggler sidebar-mobile-main-toggle">
            <i class="icon-transmission"></i>
        </button>
    </div>

    <div class="navbar-brand text-center text-lg-left">
        <a href="{{ route('admins.panel') }}" class="d-inline-block">
            <img src="{{ _logo(null, 'light') }}" class="d-none d-sm-block" alt="{{ implode(' ', Str::ucsplit(_settings('settings', 'name'))) }}">
            <img src="{{ _logo('icon', 'light') }}" class="d-sm-none" alt="{{ implode(' ', Str::ucsplit(_settings('settings', 'name'))) }}">
        </a>
    </div>

    <div class="collapse navbar-collapse order-2 order-lg-1" id="navbar_search"></div>

    <div class="order-1 order-lg-2 d-flex flex-1 flex-lg-0 justify-content-end align-items-center">
        <ul class="navbar-nav flex-row order-1 order-lg-2 flex-1 flex-lg-0 justify-content-end align-items-center">

			<!-- Languages -->
			@include(_current_theme('components.languages'))
			<!-- /languages -->

			<li class="nav-item nav-item-dropdown-lg dropdown dropdown-user h-100">
				<a href="#" class="navbar-nav-link navbar-nav-link-toggler dropdown-toggle d-inline-flex align-items-center h-100" data-toggle="dropdown">
					<img src="{{ _get_image(auth()->user()->profile_pic, 'profile') }}" class="rounded-pill mr-lg-2" height="34" width="34" alt="{{ auth()->user()->name }}" style="border: 2px solid #ffffff">
					<span class="d-none d-lg-inline-block text-capitalize">{{ auth()->user()->name }}</span>
				</a>

				<div class="dropdown-menu dropdown-menu-right">
                    <a href="{{ url('') }}" class="dropdown-item text-capitalize">
                        <i class="fas fa-external-link-alt"></i>
                        {{ _trans('admins', 'front.view') }}
                    </a>
					<a href="{{ route('admins.profile') }}#update" class="dropdown-item text-capitalize">
                        <i class="fas fa-id-card-alt"></i>
                        {{ _trans('admins', 'profile.my_profile') }}
                    </a>
					<a href="#" class="dropdown-item text-capitalize">
                        <i class="fas fa-user-cog"></i>
                        {{ _trans('admins', 'profile.account_settings') }}
                    </a>
					<div class="dropdown-divider"></div>
                    @include(_current_theme('components.switch_dark_mode'))
                    <a href="#" class="dropdown-item text-capitalize" onclick="clearCache()">
                        <i class="fas fa-sync"></i>
                        {{ _trans('admins', 'dashboard.clear cache') }}
                    </a>
					<a href="{{ route('admins.logout') }}" class="dropdown-item text-capitalize">
                        <i class="fas fa-sign-out-alt"></i>
                        {{ _trans('admins', 'auth.logout') }}
                    </a>
				</div>
			</li>
		</ul>
    </div>
</div>
