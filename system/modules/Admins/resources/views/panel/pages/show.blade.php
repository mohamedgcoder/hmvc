@extends(_current_theme('index'))

@section('page-header')
<div class="breadcrumb-line header-elements-lg-inline mt-3">
    <div class="d-flex">
        <div class="breadcrumb">
            <a href="{{ Route('panel') }}" class="breadcrumb-item">
                <i class="icon-home2 mr-2"></i> 
                {{ _trans($namespace, 'dashboard.title') }}
            </a>
            <a href="{{ Route($module.'.index') }}" class="breadcrumb-item">
                {{ _trans($namespace, 'title') }}
            </a>
            <span class="breadcrumb-item active">{{ _trans($namespace, 'view') }}</span>
        </div>

        <a href="#" class="header-elements-toggle text-body d-lg-none"><i class="icon-more"></i></a>
    </div>
</div>

@endsection()

@section('content')

@endsection()