@extends(_current_theme('index'))

@section('page-header')
<div class="breadcrumb-line header-elements-lg-inline mt-3">
    <div class="d-flex">
        <div class="breadcrumb">
            <a href="{{ route('panel') }}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> {{ _trans('Admins', 'dashboard.title') }}</a>
            <!-- <a href="components_page_header.html" class="breadcrumb-item">Account</a> -->
            <span class="breadcrumb-item active">{{ __('control_panel.system_data') }}</span>
            <span class="breadcrumb-item active">{{ __('control_panel.genders.title') }}</span>
        </div>

        <a href="#" class="header-elements-toggle text-body d-lg-none"><i class="icon-more"></i></a>
    </div>
</div>
								
@endsection()

@section('content')
{{ __('control_panel.genders.title') }}
@endsection()