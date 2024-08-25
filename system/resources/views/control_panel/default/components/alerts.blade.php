{{-- @if(session()->has('alert'))
    <div class="alert {{ session('alert')['type'] }} border-0 {{ session('alert')['dismissible'] }}">
        <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
        @if(is_array(session('alert')['message']))
        <ul>
            @foreach(session('alert')['message'] as $error)
                <li>{{ Str::title($error) }}</li>
            @endforeach
        </ul>
        @else
            {{ Str::title(session('alert')['message']) }}
        @endif
    </div>
    {{ session()->forget('alert') }}
@endif

@if(session()->has('message'))
    @foreach(session('message')['messages'] as $message)
        <div class="alert {{ session('message')['type'] }} alert-styled-left {{ session('alert')['dismissible'] }}">
            <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
            {{ Str::title($message) }}
        </div>
    @endforeach
    {{ session()->forget('message') }}
@endif --}}
@push('footer-scripts')
    @if(session()->has('error'))
        <script>
            _error("{{ Str::title(session('error')['message']) }}");
        </script>
        {{ session()->forget('error') }}
    @endif

    @if(session()->has('success'))
        <script>
            var _success = function(text) {
                new Noty({
                    theme: ' alert bg-success text-white alert-styled-left alert-arrow-left p-0',
                    header: 'success',
                    text: text,
                    type: 'alert',
                    progressBar: true,
                    closeWith: ['click']
                }).show();
            };
            _success("{{ Str::title(session('success')['message']) }}");
        </script>
        {{ session()->forget('success') }}
    @endif
@endpush
