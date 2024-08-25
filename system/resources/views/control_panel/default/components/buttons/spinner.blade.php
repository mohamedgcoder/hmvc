<div class="@if(isset($float) && $float != null){{$float}} @endif mt-2">
    <button
        form="{{$form}}"
        url="{{ $url }}"
        method="{{ $method }}"
        type="button"
        id="{{$id}}"
        class="submit btn @if(isset($class)){{$class}} @else btn-primary @endif btn-ladda btn-ladda-progress"
        data-style="zoom-in"
        data-spinner-color="#333"
        data-spinner-size="20">
        <span class="ladda-label">{{$value}}</span>
    </button>
</div>

@push('footer-scripts')
    <script src="{{ _assets('js/plugins/buttons/spin.min.js') }}"></script>
    <script src="{{ _assets('js/plugins/buttons/ladda.min.js') }}"></script>

    <script>
        Ladda.bind('#'+"{{$id}}" , {
            callback: function(instance) {
                let formName = $('#'+"{{$id}}").attr('form');
                let formUrl = $('#'+"{{$id}}").attr('url');
                let method = $('#'+"{{$id}}").attr('method');
                let data = $("#"+formName).serializeArray();

                $.ajax({
                    url: formUrl,
                    method: method,
                    data: data,
                    success: function (res) {
                        instance.stop();
                        clearInterval(interval);
                        _success();
                    },
                    error: function (xhr, status, error) {
                        instance.stop();
                        clearInterval(interval);
                        _error("{{ __( 'messages.unsaved')}}");
                    }
                });
                var progress = 0;
                var interval = setInterval(function() {
                    progress = Math.min(progress + Math.random() * 0.1, 1);
                    instance.setProgress(progress);
                }, 200);
            }
        });
    </script>
@endpush
