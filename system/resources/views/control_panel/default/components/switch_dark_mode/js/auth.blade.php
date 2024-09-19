<script>
    function setDarkhref()
    {
        var href = "{{ _assets('css/'._dir().'/auth-all-dark.min.css') }}";
        $('#auth-theme-mode').attr('href', href);
    }

    function setLighthref()
    {
        var href = "{{ _assets('css/'._dir().'/auth-all.min.css') }}";
        $('#auth-theme-mode').attr('href', href);
    }
</script>
