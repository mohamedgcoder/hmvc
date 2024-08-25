        <!-- Core JS files -->
        <script src="{{ _assets('js/global/jquery.min.js') }}"></script>
        <!-- /core JS files -->

        <script>
            $.ajaxSetup({
                beforeSend: function (xhr, settings) {
                    if (settings.url.indexOf(document.domain) >= 0) {
                        xhr.setRequestHeader("X-CSRF-Token", "{{csrf_token()}}");
                    }
                }
            });
        </script>

        @stack('head-scripts')
