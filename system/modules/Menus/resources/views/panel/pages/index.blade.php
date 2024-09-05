@extends(_current_theme('index'))

@push('styles')
    {{-- style here --}}
@endpush

@section('title', _title_separation().Str::title($title))

@section('breadcrumb')
    <span class="breadcrumb-item active">{!! Str::title(_trans($namespace, 'title')) !!}</span>
@endsection

@section('content')

@endsection()

@push('footer-scripts')
@endpush
