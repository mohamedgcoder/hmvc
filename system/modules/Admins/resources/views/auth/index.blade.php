@include(_current_theme('layouts.html.start'))

    @push('styles')
        <link id="auth-theme-mode" href="{{ _assets('css/'._dir().'/auth-all.min.css') }}" rel="stylesheet" type="text/css">
    @endpush

    @include(_current_theme('layouts.head.index'))

    <body>
        <!-- Page content -->
        <div class="page-content">

            <!-- Main content -->
            <div class="content-wrapper">

                <!-- Inner content -->
                <div class="content-inner">

                    <ul class="navbar-nav flex-row align-items-center">
                        {{-- switch_dark_mode --}}
                        @include(_current_theme('components.switch_dark_mode.index'), ['js' => 'auth'])
                        {{-- /switch_dark_mode --}}

                        {{-- Languages --}}
                        @include(_current_theme('components.languages'))
                        {{-- /languages --}}
                    </ul>

                    <!-- Content area -->
                    <div class="content d-flex justify-content-center align-items-center">
                        @yield('content')
                    </div>
                    <!-- /content area -->

                    <div class="text-center mb-3 text-muted">
                        @include(_current_theme('layouts.footer.copyright'))
                    </div>

                </div>
                <!-- /inner content -->

            </div>
            <!-- /main content -->

        </div>
        <!-- /page content -->

    </body>

    @push('footer-scripts')
    @endpush

    @include(_current_theme('layouts.footer.scripts'))

    @include(_current_theme('layouts.html.end'))
