@extends(_current_theme('index'))

@push('styles')
    {{-- style here --}}
@endpush

@section('title', _title_separation().Str::title($title))

@section('breadcrumb')
    <span class="breadcrumb-item active">{{ Str::title(_trans($namespace, 'title')) }}</span>
    <span class="breadcrumb-item active">{{ Str::title(_trans($namespace, 'integrations.title')) }}</span>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        {{-- <h5 class="text-muted">{{ Str::title(_trans($namespace, 'integrations.header')) }}</h5> --}}
        <h5 class="card-title text-muted">{{ Str::title(_trans($namespace, 'integrations.mail')) }}</h5>
    </div>
</div>

<div class="row mt-2">
    <div class="col-lg-12">
        <div class="card border-left-primary rounded-left-0">
            <div class="card-body">
                <form id="formMail" action="#">
                    <div class="row">
                        <div class="col-lg-6">
                            <fieldset>
                                <div class="form-group">
                                    <label>{{ Str::title(_trans($namespace, 'integrations.transport')) }}:</label>
                                    <input type="text" class="form-control" name="transport" value="{{_settings('settings', 'transport')}}">
                                </div>
                                <div class="form-group">
                                    <label>{{ Str::title(_trans($namespace, 'integrations.host')) }}:</label>
                                    <input type="text" class="form-control" name="host" value="{{_settings('settings', 'host')}}">
                                </div>
                                <div class="form-group">
                                    <label>{{ Str::title(_trans($namespace, 'integrations.timeout')) }}:</label>
                                    <input type="text" class="form-control" name="timeout" value="{{_settings('settings', 'timeout')}}">
                                </div>
                                <div class="form-group">
                                    <label>{{ Str::title(_trans($namespace, 'integrations.port')) }}:</label>
                                    <input type="text" class="form-control" name="port" value="{{_settings('settings', 'port')}}">
                                    <span class="form-text text-muted">ex 25 or 465 or 587 or 2525 for pop3.mailtrap.io - 1100 or 9950</span>
                                </div>
                            </fieldset>
                        </div>

                        <div class="col-lg-6">
                            <fieldset>
                                <div class="form-group">
                                    <label>{{ Str::title(_trans($namespace, 'integrations.user_name')) }}:</label>
                                    <input type="text" class="form-control" name="user_name" value="{{_settings('settings', 'user_name')}}">
                                </div>
                                <div class="form-group">
                                    <label>{{ Str::title(_trans($namespace, 'integrations.password')) }}:</label>
                                    <input type="text" class="form-control" name="password" value="{{_settings('settings', 'password')}}">
                                </div>
                                <div class="form-group">
                                    <label>{{ Str::title(_trans($namespace, 'integrations.queue_delay')) }}:</label>
                                    <input type="text" class="form-control" name="queue_delay" value="{{_settings('settings', 'queue_delay')}}">
                                </div>
                                <div class="form-group">
                                    <label>{{ Str::title(_trans($namespace, 'integrations.encryption')) }}:</label>
                                    <input type="text" class="form-control" name="encryption" value="{{_settings('settings', 'encryption')}}">
                                </div>
                            </fieldset>
                        </div>
                    </div>

                    @include(_current_theme('components.buttons.spinner'), [
                        "form" => "formMail",
                        "url" => Route('settings.update'),
                        "id" => "mail",
                        "method" => 'PUT',
                        "float" => "text-right",
                        "value" => __('buttons.save_changes'),
                    ])
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="row">
            <div class="col-lg-12">
                <h5 class="card-title text-muted">{{ Str::title(_trans($namespace, 'integrations.firebase')) }}</h5>
            </div>
        </div>

        <div class="card border-left-danger rounded-left-0">
            <div class="card-body">
                <form id="formFirebase" action="#">
                    <div class="row">
                        <div class="col-lg-6">
                            <fieldset>
                                <div class="form-group">
                                    <label>{{ Str::title(_trans($namespace, 'integrations.firebase_secret_key')) }}:</label>
                                    <input type="text" class="form-control" name="firebase_secret_key" value="{{_settings('settings', 'firebase_secret_key')}}">
                                </div>
                            </fieldset>
                        </div>

                        <div class="col-lg-6">
                            <fieldset>
                                <div class="form-group">
                                    <label>{{ Str::title(_trans($namespace, 'integrations.fcm_topic')) }}:</label>
                                    <input type="text" class="form-control" name="fcm_topic" value="{{_settings('settings', 'fcm_topic')}}">
                                </div>
                            </fieldset>
                        </div>
                    </div>

                    @include(_current_theme('components.buttons.spinner'), [
                        "form" => "formFirebase",
                        "url" => Route('settings.update'),
                        "id" => "firebase",
                        "method" => 'PUT',
                        "float" => "text-right",
                        "value" => __('buttons.save_changes'),
                    ])
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="row">
            <div class="col-lg-12">
                <h5 class="card-title text-muted">{{ Str::title(_trans($namespace, 'integrations.google')) }}</h5>
            </div>
        </div>

        <div class="card border-left-warning rounded-left-0">
            <div class="card-body">
                <form id="formGoogle" action="#">
                    <div class="row">
                        <div class="col-lg-6">
                            <fieldset>
                                <div class="form-group">
                                    <label>{{ Str::title(_trans($namespace, 'integrations.google_map_key')) }}</label>
                                    <input type="text" class="form-control" name="google_map_key" value="{{_settings('settings', 'google_map_key')}}">
                                </div>
                            </fieldset>
                        </div>
                    </div>

                    @include(_current_theme('components.buttons.spinner'), [
                        "form" => "formGoogle",
                        "url" => Route('settings.update'),
                        "id" => "google",
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
