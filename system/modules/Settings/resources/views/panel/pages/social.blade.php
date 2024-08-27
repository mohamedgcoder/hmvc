@extends(_current_theme('index'))

@push('styles')
    {{-- style here --}}
@endpush

@section('title', _title_separation().Str::title($title))

@section('breadcrumb')
    <span class="breadcrumb-item active">{{ Str::title(_trans($namespace, 'title')) }}</span>
    <span class="breadcrumb-item active">{{ Str::title(_trans($namespace, 'social.title')) }}</span>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h5 class="card-title text-muted">{{ Str::title(_trans($namespace, 'social.header')) }}</h5>
    </div>
</div>

<div class="row mt-2">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">

            </div>
        </div>
    </div>
</div>
@endsection()

@push('footer-scripts')
    @include(_current_theme('components.js.select'))
    <script>
        var _success = function() {
            new Noty({
                theme: ' alert bg-success text-white alert-styled-left alert-arrow-left p-0',
                header: 'success',
                text: "{!! __( 'messages.saved') !!}",
                type: 'alert',
                progressBar: true,
                closeWith: ['click']
            }).show();

            window.location.replace("{!! url()->current() !!}");
        };
    </script>
@endpush
