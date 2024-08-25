@extends(_current_theme('index'))

@push('styles')
    {{-- style here --}}
@endpush

@section('title', _title_separation().Str::title($title))

@section('content')
<div class="card">
    <div class="card-body">
        {{ $dataTable->table() }}
    </div>
</div>
@endsection()

@push('scripts')
    <script src="{{ _assets('js/plugins/datatables.min.js') }}"></script>
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush
