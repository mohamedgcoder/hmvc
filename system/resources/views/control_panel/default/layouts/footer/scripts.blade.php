<script src="{{ _assets('js/global/bootstrap.bundle.min.js') }}"></script>
<script src="{{ _assets('js/'._dir().'/app.js') }}"></script>
{{-- Noty --}}
<script src="{{ _assets('js/plugins/notifications/noty.min.js') }}"></script>

<script type="text/javascript">
    var idleTime = 0;
    $(document).ready(function () {
        // Increment the idle time counter every minute.
        var idleInterval = setInterval(timerIncrement, 60000); // 1 minute

        // Zero the idle timer on mouse movement.
        $(this).mousemove(function (e) {
            idleTime = 0;
        });
        $(this).keypress(function (e) {
            idleTime = 0;
        });
    });

    function timerIncrement() {
        idleTime = idleTime + 1;
        var ex = [
            "{{ _prefix('panel', 'login') }}",
            "{{ _prefix('panel', 'signin') }}",
            "{{ _prefix('panel', 'unlock') }}",
            "{{ _prefix('panel', 'password-recover') }}",
            "{{ _prefix('panel', 'password-reset') }}",
            "{{ _prefix('panel', 'check-if-email-exist') }}",
        ];
        var page = "{{ url()->current() }}";
        var expirationTime = "{{ _settings('settings', 'expiration_logged_in') }}"; // in minute
        if (!ex.includes(page) && idleTime >= expirationTime) {
            window.location = "{{ route('admin.unlock')}}";
        }
    }

    Noty.overrideDefaults({
        layout: 'topRight',
        timeout: 2000,
    });

    var _error = function(text) {
        new Noty({
            theme: ' alert bg-danger text-white alert-styled-left alert-arrow-left p-0',
            header: 'danger',
            text: text,
            type: 'alert',
            progressBar: true,
            closeWith: ['click']
        }).show();
    };
</script>

@stack('footer-scripts')
