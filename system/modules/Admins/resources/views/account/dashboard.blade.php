@extends(_current_theme('index'))

@push('styles')
    {{-- style here --}}
@endpush

@section('title', _title_separation() . Str::title($title))

@section('content')
<h1 class="text-primary">Dashboard</h1>
@endsection()

@push('scripts')
    {{-- script file or code here --}}
@endpush
