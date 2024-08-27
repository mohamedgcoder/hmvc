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
        <script type="module" src="https://cdnjs.cloudflare.com/ajax/libs/js-cookie/3.0.1/js.cookie.min.js"></script>

        <script>
            $(function() {
                if(Cookies.get('theme_mode') != 'undefined'){
                    if(Cookies.get('theme_mode') == 'dark'){
                        setDarkhref();
                    }else{
                        setLighthref();
                    }
                }
            });

            function setDarkhref()
            {
                var href = "{{ _assets('css/'._dir().'/auth-all-dark.min.css') }}";
                $("#theme_mode").attr("checked", true);
                $('#auth-theme-mode').attr('href', href);
            }

            function setLighthref()
            {
                var href = "{{ _assets('css/'._dir().'/auth-all.min.css') }}";
                $('#auth-theme-mode').attr('href', href);
            }
        </script>
    @endpush

    @include(_current_theme('layouts.footer.scripts'))

    @include(_current_theme('layouts.html.end'))
