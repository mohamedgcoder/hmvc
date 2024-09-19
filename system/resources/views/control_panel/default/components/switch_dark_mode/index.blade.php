<li class="nav-item">
    <a id="theme_mode" class="navbar-nav-link">
        <i class="icon_mode fas fa-sun" style="font-size: 1.1rem;"></i>
    </a>
</li>

@push('footer-scripts')
    <script type="text/javascript">
        window.onload = function() {
            var mode = "{{ session('theme-mode')}}";
            if(mode != 'undefined' && mode == 'dark'){
                setDarkhref();
                changeIcon('dark');
            }else{
                setLighthref();
                changeIcon('light');
            }

            $('#theme_mode').on('click', function() {
                if (mode == 'dark') {
                    mode = 'light';
                    setLighthref();
                    changeIcon('light');
                }else{
                    mode = 'dark';
                    setDarkhref();
                    changeIcon('dark');
                }

                $.ajax({
                    type: "POST",
                    url: "{{ route('theme.mode') }}",
                    data: {mode: mode},
                    dataType: 'JSON'
                });
            });
        };

        function changeIcon(mode)
        {
            if(mode == 'dark'){
                $('.icon_mode').addClass('fa-sun');
                $('.icon_mode').removeClass('fa-moon');
            }else{
                $('.icon_mode').addClass('fa-moon');
                $('.icon_mode').removeClass('fa-sun');
            }
        }
    </script>

    {{-- script --}}
    @include(_current_theme('components.switch_dark_mode.js.'.$js))
    {{-- script --}}
@endpush
