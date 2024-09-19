<script type="text/javascript">
    function setDarkhref()
    {
        var href = "{{ _assets('css/'._dir().'/all-dark.min.css') }}";
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
