<a class="dropdown-item text-capitalize">
    <i class="fas fa-sun fa-md opacity-80"></i>{{_trans('settings', 'general.dark_mode')}}
    <label class="custom-control custom-switch ml-auto" data-bs-popup="tooltip" data-bs-placement="right" data-bs-original-title="{{ Str::title(_trans('settings', 'general.dark_mode')) }}">
        <input id="theme_mode" type="checkbox" class="custom-control-input">
        <span class="custom-control-label"></span>
    </label>
</a>

@push('footer-scripts')
<script>
    $(function() {
        var mode = "{{ session('theme-mode')}}";

        if(mode != 'undefined' && mode == 'dark'){
            setDarkhref();
        }else{
            setLighthref();
        }

        $('#theme_mode').change(function() {
            if ($(this).is(':checked')) {
                mode = 'dark';
                setDarkhref();
            }else{
                mode = 'light';
                setLighthref();
            }

            $.ajax({
                type: "POST",
                url: "{{ route('theme.mode') }}",
                data: {mode: mode},
                dataType: 'JSON'
            });
        });
    });

    function setDarkhref()
    {
        var href = "{{ _assets('css/'._dir().'/all-dark.min.css') }}";
        $("#theme_mode").attr("checked", true);
        $('#theme-mode').attr('href', href);
        $("#logo").attr("src","{{ _logo('', 'dark') }}");
        $("#logo_icon").attr("src","{{ _logo('icon', 'dark') }}");

        // css
        $('.navbar-dark').css('background-color', '#141517');
        // Use specific config file
        // CKEDITOR.config.customConfig = 'config_dark.js';
    }

    function setLighthref()
    {
        var href = "{{ _assets('css/'._dir().'/all.min.css') }}";
        $('#theme-mode').attr('href', href);
        $("#logo").attr("src","{{ _logo('', 'light') }}");
        $("#logo_icon").attr("src","{{ _logo('icon', 'light') }}");

        // css
        $('.navbar-dark').css('background-color', "{{ _settings('settings', 'navbar_color') }}");
    }
</script>
@endpush
