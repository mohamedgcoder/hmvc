        <!-- Global stylesheets -->
        <link id="theme-mode" href="{{ _assets('css/'._dir().'/all.min.css') }}" rel="stylesheet" type="text/css">
        <!-- /global stylesheets -->

        <style>
            .navbar-dark{
                background-color: {{ _settings('settings', 'navbar_color') }};
            }
            /*
            *   scrollbar
            */
            /* html{
                scrollbar-color: {{ _settings('settings', 'navbar_color') }} #ffffff;
                --scrollbarBG: #ffffff;
                --thumbBG: #ffffff;
            }
            body {
                scrollbar-width: 10px;
                scrollbar-color: var(--thumbBG) var(--scrollbarBG);
            }
            ::-webkit-scrollbar {
                width: 10px;
            }
            ::-webkit-scrollbar-track {
                background: var(--scrollbarBG);
            }
            ::-webkit-scrollbar-thumb {
                background-color: var(--thumbBG) ;
                border-radius: 6px;
                border: 3px solid var(--scrollbarBG);
            } */
        </style>

        @include(_current_theme('layouts.head.colors'))

        @stack('styles')
