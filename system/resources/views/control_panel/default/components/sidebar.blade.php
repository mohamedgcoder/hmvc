
<div class="sidebar sidebar-light sidebar-main sidebar-expand-lg align-self-start {{ session('_sidebar_main_resized') }}">
    <!-- Sidebar content -->
    <div class="sidebar-content">
        <!-- Header -->
        <div class="sidebar-section sidebar-header">
            <div class="sidebar-section-body d-flex align-items-center justify-content-center pb-0">
                <h6 class="sidebar-resize-hide flex-1 mb-0">{{ Str::title(_trans('Admins', 'main_menu')) }}</h6>
                <div>
                    <button type="button" class="btn btn-outline-light text-body border-transparent btn-icon rounded-pill btn-sm sidebar-control sidebar-main-resize d-none d-lg-inline-flex">
                        <i class="icon-transmission"></i>
                    </button>

                    <button type="button" class="btn btn-outline-light text-body border-transparent btn-icon rounded-pill btn-sm sidebar-mobile-main-toggle d-lg-none">
                        <i class="icon-cross2"></i>
                    </button>
                </div>
            </div>
        </div>
        <!-- /header -->

        <!-- User menu -->
        <div class="sidebar-section sidebar-user">
            <div class="sidebar-section-body d-flex justify-content-center">
                <a href="{{ route('admins.profile') }}">
                    <img src="{{ _get_image(auth()->user()->profile_pic, 'profile') }}" class="rounded-circle" alt="{{ auth()->user()->name }}">
                </a>

                <div class="sidebar-resize-hide flex-1 ml-3">
                    <div class="font-weight-semibold">{{ Str::ucfirst(auth()->user()->name) }}</div>
                    <div class="font-size-sm line-height-sm text-muted">
                        {{ auth()->user()->email }}
                    </div>
                </div>
            </div>
        </div>
        <!-- /user menu -->

        <!-- Main navigation -->
        <div class="sidebar-section">
            @include(_current_theme('components.menu.index'))
        </div>
        <!-- /main navigation -->

    </div>
    <!-- /sidebar content -->

</div>
{{ session()->forget('_sidebar_main_resized') }}
