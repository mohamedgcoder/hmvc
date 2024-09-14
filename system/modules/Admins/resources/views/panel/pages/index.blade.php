@extends(_current_theme('index'))

@push('styles')
    {{-- style here --}}
@endpush

@section('title', _title_separation().Str::title($title))

@section('breadcrumb')
    <span class="breadcrumb-item active text-capitalize">{{_trans($namespace, 'title')}}</span>
@endsection

@section('content')
<div class="row">
    <div class="col text-right">
        <button class="btn btn-primary text-capitalize" type="button" data-toggle="collapse" data-target="#addAdmin" aria-expanded="false" aria-controls="addAdmin">
            {{__('buttons.add the', ['add' => _trans($namespace, 'admin')])}}
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
                <table id="adminTable" class="table"></table>
            </div>
        </div>
    </div>
</div>
@endsection()

@push('footer-scripts')
@include(_moduleName($namespace).'::panel.components.admins-datatables')
@endpush
