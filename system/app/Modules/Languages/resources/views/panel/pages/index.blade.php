@extends(_current_theme('index'))

@push('styles')
    {{-- style here --}}
@endpush

{{-- @section('title', _title_separation().Str::title($title)) --}}

@section('content')
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dtUserList">
                <thead>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Email Verificata</th>
                    <th>Stato</th>
                    <th>Created</th>
                    <th>Action</th>
                </thead>
            </table>
        </div>
    </div>
</div>
@endsection()

@push('footer-scripts')
    {{-- <script src="{{ _assets('js/plugins/datatables.min.js') }}"></script> --}}
    <script>
        // $(function() {
        //     var table =  $('#dtUserList').DataTable({
        //         processing: true,
        //         serverSide: true,
        //         ajax: '{{ url('all') }}',
        //         columns: [
        //             { data: 'id', name: 'id', visible: false },
        //             { data: 'status', name: 'status' },
        //             { data: 'code', name: 'code' },
        //         ],
        //         order: [[0, 'asc']]
        //     });
        // });
    </script>
@endpush
