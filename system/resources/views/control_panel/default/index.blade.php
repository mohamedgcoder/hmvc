@include(_current_theme('layouts.html.start'))
    <head>
        @include(_current_theme('layouts.head.index'))
    </head>

    <body>
        @include(_current_theme('components.loading'))
        <!-- Main navbar -->
        @include(_current_theme('components.navbar'))
	    <!-- /main navbar -->

        <!-- Page header -->
        @include(_current_theme('components.header'))
	    <!-- /page header -->

        <!-- Page alerts -->
        @include(_current_theme('components.alerts'))
        <!-- /page alerts -->

        <!-- Page content -->
	    <div class="page-content pt-4">

            <!-- Main sidebar -->
            @include(_current_theme('components.sidebar'))
            <!-- /main sidebar -->

            <!-- Main content -->
		    <div class="content-wrapper">

                <!-- Content area -->
                <div class="content">

                    <!-- announcement -->
                    @include(_current_theme('components.announcements'))
                    <!-- /announcement -->

                    @yield('content')

                </div>
                <!-- /content area -->

            </div>
            <!-- /main content -->

        </div>
        <!-- /page content -->

        <!-- Footer -->
        @include(_current_theme('layouts.footer.index'))
	    <!-- /footer -->

    </body>
@include(_current_theme('layouts.html.end'))
