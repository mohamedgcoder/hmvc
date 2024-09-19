@extends(_current_theme('index'))

@push('styles')
    {{-- style here --}}
@endpush

@section('title', _title_separation().Str::title($title))


@section('breadcrumb')
    <span class="breadcrumb-item active">{{ Str::title(_trans($namespace, 'title')) }}</span>
    <span class="breadcrumb-item active">{{ Str::title(_trans($namespace, 'system.title')) }}</span>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h5 class="card-title text-muted">{{ Str::title(_trans($namespace, 'system.header')) }}</h5>
    </div>
</div>

<div class="row mt-2">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <form id="formSystem" action="#">
                    <div class="row">
                        <div class="col-lg-6">
                            <fieldset>
                                <div class="form-group">
                                    <label>{{ Str::title(_trans($namespace, 'system.domain')) }}:</label>
                                    <input type="text" class="form-control" name="domain" value="{{_settings('settings', 'domain')}}" @if(!env('APP_TENANCY') && !_is_tenant())disabled @endif>
                                </div>

                                @if(!env('APP_TENANCY') && !_is_tenant())
                                <div class="form-group">
                                    <label>{{ Str::title(_trans($namespace, 'system.debug')) }}:
                                        @include(_current_theme('components.tooltip'), [
                                            "position" => "top",
                                            "data" => _trans($namespace, 'system.debug_note')
                                        ])
                                    </label>
                                    @include(_current_theme('components.fields.select'), [
                                        "name" => "debug",
                                        "options" => [
                                            "true" => __('index.enable'),
                                            "false" => __('index.disable'),
                                        ],
                                        "selected" => _settings('settings', 'debug'),
                                        "class" => null,
                                        "placeholder" => null,
                                    ])
                                    {{-- <select class="form-control select" name="debug" data-fouc>
                                        <option value="true" @if(_settings('settings', 'debug') == 1)selected @endif>{!!__('index.enable')!!}</option>
                                        <option value="false" @if(_settings('settings', 'debug') == 0)selected @endif>{!!__('index.disable')!!}</option>
                                    </select> --}}
                                </div>
                                @endif

                                {{-- <div class="form-group">
                                    <label>
                                        {{ Str::title(_trans($namespace, 'system.expiration_logged_in')) }}:
                                        @include(_current_theme('components.tooltip'), [
                                            "position" => "top",
                                            "data" => _trans($namespace, 'system.expiration_logged_in_note')
                                        ])
                                    </label>
                                    <input type="text" class="form-control" name="expiration_logged_in" value="{{_settings('settings', 'expiration_logged_in')}}">
                                </div> --}}

                                <div class="form-group">
                                    <label>
                                        {{ Str::title(_trans($namespace, 'system.api_pagination')) }}:
                                        @include(_current_theme('components.tooltip'), [
                                            "position" => "top",
                                            "data" => _trans($namespace, 'system.api_pagination_note')
                                        ])
                                    </label>
                                    <input type="text" class="form-control" name="api_pagination" value="{{_settings('settings', 'api_pagination')}}">
                                </div>
                            </fieldset>
                        </div>

                        <div class="col-lg-6">
                            <fieldset>
                                <div class="form-group">
                                    <label>{{ Str::title(_trans($namespace, 'system.timezone')) }}:</label>
                                    @include(_current_theme('components.fields.select'), [
                                        "name" => "timezone",
                                        "optgroup" => true,
                                        "options" => _get_timezone(),
                                        "selected" => _settings('settings', 'timezone'),
                                        "value" => false,
                                        "class" => null,
                                        "placeholder" => _trans($namespace, 'system.select your timezone'),
                                    ])
                                </div>

                                @if(!env('APP_TENANCY') && !_is_tenant())
                                <div class="form-group">
                                    <label>
                                        {{ Str::title(_trans($namespace, 'system.env')) }}:
                                        @include(_current_theme('components.tooltip'), [
                                            "position" => "top",
                                            "data" => _trans($namespace, 'system.env_note')
                                        ])
                                    </label>
                                    @include(_current_theme('components.fields.select'), [
                                        "name" => "env",
                                        "options" => [
                                            "local" => _trans($namespace, 'system.local'),
                                            "production" => _trans($namespace, 'system.production'),
                                            "staging" => _trans($namespace, 'system.staging'),
                                            "testing" => _trans($namespace, 'system.testing'),
                                        ],
                                        "selected" => _settings('settings', 'env'),
                                        "class" => "",
                                    ])
                                </div>
                                @endif

                                {{-- <div class="form-group">
                                    <label>
                                        {{ Str::title(_trans($namespace, 'system.expiration_reset_password')) }}:
                                        @include(_current_theme('components.tooltip'), [
                                            "position" => "top",
                                            "data" => _trans($namespace, 'system.expiration_logged_in_note')
                                        ])
                                    </label>
                                    <input type="text" class="form-control" name="expiration_reset_password" value="{{_settings('settings', 'expiration_reset_password')}}">
                                </div> --}}

                                <div class="form-group">
                                    <label>{{ Str::title(_trans($namespace, 'system.web_pagination')) }}:
                                        @include(_current_theme('components.tooltip'), [
                                            "position" => "top",
                                            "data" => _trans($namespace, 'system.api_pagination_note')
                                        ])
                                    </label>
                                    <input type="text" class="form-control" name="web_pagination" value="{{_settings('settings', 'web_pagination')}}">
                                </div>
                            </fieldset>
                        </div>
                    </div>

                    @include(_current_theme('components.buttons.spinner'), [
                        "form" => "formSystem",
                        "url" => Route('settings.update'),
                        "id" => "system",
                        "method" => 'PUT',
                        "float" => "text-right",
                        "value" => __('buttons.save_changes'),
                    ])
                </form>

            </div>
        </div>
    </div>
</div>
@endsection()

@push('footer-scripts')
    @include(_current_theme('components.js.select'))

    <script>
        var _success = function() {
            new Noty({
                theme: ' alert bg-success text-white alert-styled-left alert-arrow-left p-0',
                header: 'success',
                text: "{!! __( 'messages.saved') !!}",
                type: 'alert',
                progressBar: true,
                closeWith: ['click']
            }).show();
        };
    </script>
@endpush
