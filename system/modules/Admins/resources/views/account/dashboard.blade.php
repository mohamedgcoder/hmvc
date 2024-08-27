@extends(_current_theme('index'))

@push('styles')
    {{-- style here --}}
@endpush

@section('title', _title_separation() . Str::title($title))

@section('content')
Dashboard
@endsection()

@push('scripts')
    {{-- script file or code here --}}
@endpush
