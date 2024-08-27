@extends(_current_theme('index'))

@push('styles')
    {{-- style here --}}
@endpush

@section('title', _title_separation().Str::title($title))

@section('content')
<div class="card">
    <div class="card-body">

    </div>
</div>
@endsection()

@push('scripts')

@endpush
