@extends(_current_theme('index'))

@push('styles')
    {{-- style here --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.4/css/dataTables.dataTables.css" />
@endpush

@section('title', _title_separation().Str::title($title))

@section('breadcrumb')
    <span class="breadcrumb-item active">{{ Str::title(_trans($namespace, 'title')) }}</span>
@endsection

@section('content')
<div class="row">
    <div class="col text-right">
        <button class="btn btn-primary " type="button" data-toggle="collapse" data-target="#addAdmin" aria-expanded="false" aria-controls="addAdmin">
            {{Str::title(__('buttons.add the', ['add' => _trans($namespace, 'admin')]))}}
            <i class="fas fa-plus"></i>
        </button>
    </div>
</div>

<div class="row mt-2">
    <div id="addAdmin" class="col-lg-12 collapse">
        <div class="card">
            <div class="card-body">

            </div>
        </div>
    </div>
</div>

<div class="row mt-2">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <table id="adminTable" class="table">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Email</th>
                      </tr>
                    </thead>
                    <tbody></tbody>
                  </table>
            </div>
        </div>
    </div>
</div>
@endsection()

@push('footer-scripts')
    {{-- <script src="{{ _assets('js/plugins/datatables.min.js') }}"></script> --}}
    <script src="https://cdn.datatables.net/2.1.4/js/dataTables.js"></script>
    <script>
        $(document).ready(function () {
            var table = $('#adminTable').DataTable({
                select: true,
                ajax: {
                    url: "{{ Route('admins.getall') }}",
                },
                columns: [
                    { data: 'code' },
                    { data: 'name' },
                    { data: 'phone' },
                    { data: 'email' }
                ]
            });
        });
    </script>
@endpush
