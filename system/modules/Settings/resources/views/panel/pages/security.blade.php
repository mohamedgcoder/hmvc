@extends(_current_theme('index'))

@push('styles')
    {{-- style here --}}
@endpush

@section('title', _title_separation().Str::title($title))

@section('breadcrumb')
    <span class="breadcrumb-item active">{{ Str::title(_trans($namespace, 'title')) }}</span>
    <span class="breadcrumb-item active">{{ Str::title(_trans($namespace, 'security.title')) }}</span>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h5 class="card-title text-muted">{{ Str::title(_trans($namespace, 'security.header')) }}</h5>
    </div>
</div>

<div class="row mt-2">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <legend class="font-weight-semibold text-muted">
                    <h5 class="card-title">{{ Str::title(_trans($namespace, 'security.api_integrations')) }}</h5>
                </legend>
            </div>
            <div class="card-body">
                <form action="#">
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-lg-4 col-form-label">
                            {{ Str::title(_trans($namespace, 'security.system_key')) }}:
                            {{-- <i class="far fa-copy" style="cursor: pointer;" onclick="copyData('system')"></i> --}}
                        </label>
                        <div class="col-sm-12 col-md-10 col-lg-8">
                            @include(_current_theme('components.fields.textbox'), [
                                'id' => 'system_key',
                                'name' => 'system_key',
                                'placeholder' => _settings('settings', 'system_key'),
                                'icon' => 'fas fa-sync',
                                'iconPosition' => 'right',
                                'iconClick' => 'generateSystemKey',
                                'iconColor' => 'text-success',
                                'required' => false
                                ])
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-lg-4 col-form-label">
                            {{ Str::title(_trans($namespace, 'security.secret_key')) }}:
                            {{-- <i class="far fa-copy" style="cursor: pointer;" onclick="copyData('secret')"></i> --}}
                        </label>

                        <div class="col-sm-12 col-md-10 col-lg-8">
                            @include(_current_theme('components.fields.textbox'), [
                                'id' => 'secret_key',
                                'name' => 'secret_key',
                                'placeholder' => _settings('settings', 'secret_key'),
                                'icon' => 'fas fa-sync',
                                'iconPosition' => 'right',
                                'iconClick' => 'generateSecretKey',
                                'iconColor' => 'text-success',
                                'required' => false
                            ])
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection()

@push('footer-scripts')
    <script type="text/javascript">
        function generateSystemKey()
        {
            var url = "{{ Route('settings.system.key') }}";
            $.ajax({
                url: url,
                type: 'PUT',
                contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
                success: function (response) {
                    console.log(response);
                    if(response){
                        $('#system_key').val(response);
                        $('#system_key').attr('placeholder', response);
                        $('#system_key_message-error').html('');
                    }else{
                        $('#system_key_message-error').html('error');
                    }
                },
                error: function () {
                    $('#system_key_message-error').html('error');
                    emailVerifying = false;
                }
            });
        }

        function generateSecretKey()
        {
            var url = "{{ Route('settings.secret.key') }}";
            $.ajax({
                url: url,
                type: 'PUT',
                contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
                success: function (response) {
                    console.log(response);
                    if(response){
                        $('#secret_key').val(response);
                        $('#secret_key').attr('placeholder', response);
                        $('#secret_key_message-error').html('');
                    }else{
                        $('#secret_key_message-error').html('error');
                    }
                },
                error: function () {
                    $('#secret_key_message-error').html('error');
                    emailVerifying = false;
                }
            });
        }

        function copyData(key)
        {
            if(key === 'system'){
                let text = "{{_settings('settings', 'system_key')}}";
            }

            if(key === 'secret'){
                let text = "{{_settings('settings', 'secret_key')}}";
            }

            navigator.clipboard.writeText(text);
            alert("Copied the text: " + text);
        }
    </script>
@endpush
