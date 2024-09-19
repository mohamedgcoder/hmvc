@extends(_current_theme('index'))

@push('styles')
    {{-- style here --}}
@endpush

@section('title', _title_separation().Str::title($title))

@section('breadcrumb')
    <span class="breadcrumb-item active text-capitalize">{{ _trans($namespace, 'title') }}</span>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h5 class="card-title text-muted text-uppercase">{{ _trans($namespace, 'general.title') }}</h5>
    </div>
</div>

<div class="row">

    <div class="col-sm-3">
        <a href="{{route(_modulePrefix($namespace).'.identity')}}" class="card text-center">
            <div class="card-body justify-content-center text-center">
                <i class="fas fa-fingerprint fa-3x text-{{env('APP_NAME')}} rounded-pill p-3 mb-3 mt-2"></i>
                <h5 class="card-title text-dark text-capitalize">{{_trans($namespace, 'identity.title')}}</h5>
            </div>
        </a>
    </div>

    <div class="col-sm-3">
        <a href="{{route(_modulePrefix($namespace).'.appearance')}}" class="card text-center">
            <div class="card-body justify-content-center text-center">
                <i class="fas fa-theater-masks fa-3x text-{{env('APP_NAME')}} rounded-pill p-3 mb-3 mt-2"></i>
                <h5 class="card-title text-dark text-capitalize">{{_trans($namespace, 'appearance.title')}}</h5>
            </div>
        </a>
    </div>

    <div class="col-sm-3">
        <a href="{{route(_modulePrefix($namespace).'.system')}}" class="card text-center">
            <div class="card-body justify-content-center text-center">
                <i class="fas fa-wrench fa-3x text-{{env('APP_NAME')}} rounded-pill p-3 mb-3 mt-2"></i>
                <h5 class="card-title text-dark text-capitalize">{{_trans($namespace, 'system.title')}}</h5>
            </div>
        </a>
    </div>

    <div class="col-sm-3">
        <a href="{{route(_modulePrefix($namespace).'.seo')}}" class="card text-center">
            <div class="card-body justify-content-center text-center">
                <i class="fab fa-searchengin fa-3x text-{{env('APP_NAME')}} rounded-pill p-3 mb-3 mt-2"></i>
                <h5 class="card-title text-dark text-capitalize">{{_trans($namespace, 'seo.title')}}</h5>
            </div>
        </a>
    </div>

    <div class="col-sm-3">
        <a href="{{route(_modulePrefix($namespace).'.social')}}" class="card text-center">
            <div class="card-body justify-content-center text-center">
                <i class="fas fa-share-alt fa-3x text-{{env('APP_NAME')}} rounded-pill p-3 mb-3 mt-2"></i>
                <h5 class="card-title text-dark text-capitalize">{{_trans($namespace, 'social.title')}}</h5>
            </div>
        </a>
    </div>

    <div class="col-sm-3">
        <a href="{{route(_modulePrefix($namespace).'.security')}}" class="card text-center">
            <div class="card-body justify-content-center text-center">
                <i class="fas fa-key fa-3x text-{{env('APP_NAME')}} rounded-pill p-3 mb-3 mt-2"></i>
                <h5 class="card-title text-dark text-capitalize">{{_trans($namespace, 'security.title')}}</h5>
            </div>
        </a>
    </div>

    <div class="col-sm-3">
        <a href="{{route(_modulePrefix($namespace).'.integrations')}}" class="card text-center">
            <div class="card-body justify-content-center text-center">
                <i class="fas fa-link fa-3x text-{{env('APP_NAME')}} rounded-pill p-3 mb-3 mt-2"></i>
                <h5 class="card-title text-dark text-capitalize">{{_trans($namespace, 'integrations.title')}}</h5>
            </div>
        </a>
    </div>

</div>
@endsection()

@push('footer-scripts')
@endpush
