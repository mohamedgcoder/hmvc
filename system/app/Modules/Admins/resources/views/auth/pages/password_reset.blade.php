@extends(_moduleName($namespace).'::' . $module.'.index')

@push('styles')
@endpush

@section('content')

    <!-- password recovery form -->
    <form class="login-form form-validate" action="{{ route('admin.setNewPassword') }}" method="post">
        <input type="hidden" name="_method" value="PUT">
        <input type="hidden" name="token" value="{{ $token }}">
        @csrf
        <div class="card mb-0">
            <div class="card-body">
                <div class="text-center mb-3">
                    <i class="icon-lock2 icon-2x text-secondary border-secondary border-3 rounded-pill p-3 mb-3 mt-1"></i>
                    <h5 class="mb-0">{{ Str::title(_trans($namespace, 'auth.message.update_password')) }}</h5>
                    <!-- <span class="d-block text-muted">{{ __('auth.message.password_recovery') }}</span> -->
                </div>

                @include(_current_theme('components.alerts'))

                @include(_current_theme('components.fields.textbox'), [
                    'id' => 'auth_email',
                    'name' => 'email',
                    'value' => $email,
                    'icon' => 'far fa-envelope',
                    'iconPosition' => 'left',
                    'disabled' => true
                ])

                @include(_current_theme('components.fields.textbox'), [
                    'id' => 'auth_password',
                    'name' => 'password',
                    'type' => 'password',
                    'placeholder' => Str::title(_trans($namespace, 'auth.password')),
                    'icon' => 'icon-lock2 text-muted',
                    'iconPosition' => 'left',
                    'oninput' => 'validatePasswordConfirmation()',
                    'required' => true
                ])

                @include(_current_theme('components.fields.textbox'), [
                    'id' => 'auth_password_confirmation',
                    'name' => 'password_confirmation',
                    'type' => 'password',
                    'placeholder' => Str::title(_trans($namespace, 'auth.confirmation_password')),
                    'icon' => 'icon-lock2 text-muted',
                    'iconPosition' => 'left',
                    'oninput' => 'validatePasswordConfirmation()',
                    'disabled' => true,
                    'required' => true
                ])

                @include(_current_theme('components.buttons.primary'), [
                    'id' => 'auth_set',
                    'name' => 'set',
                    'type' => 'submit',
                    'style' => 'btn',
                    'class' => 'btn-block',
                    'icon' => 'icon-spinner11 mr-2',
                    'value' => Str::title(_trans($namespace, 'auth.button.set_password')),
                    'disabled' => true,
                ])

                <div class="form-group text-center text-muted content-divider">
                    <span class="px-2">{{ Str::title(_trans($namespace, 'auth.message.have_an_account')) }}</span>
                </div>

                <div class="form-group">
                    <a href="{{ route('admin.login') }}" class="d-block text-center">{{ Str::title(_trans($namespace, 'auth.message.login')) }}</a>
                </div>
            </div>
        </div>
    </form>
    <!-- /password recovery form -->

@endsection

@push('footer-scripts')

    <script type="text/javascript">

        function validatePasswordConfirmation()
        {
            var password = $('#auth_password').val();
            var confirmationPassword = $('#auth_password_confirmation').val();
            if(password == ''){
                $('#auth_set').prop("disabled",true);
            }else{
                var url = "{{ Route('admin.check.password.old') }}";
                var passwordLength = "{{ _settings('admin', 'password_length')?: 6 }}";
                var email = $('#auth_email').val();
                if(password.length >= passwordLength){
                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: jQuery.param({ email: email, password:password}),
                        contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
                        success: function (response) {
                            if(response.status){
                                $('#auth_password_message-error').html('');
                                $('#auth_password').removeClass('border-danger');
                                if(password == confirmationPassword){
                                    $('#auth_set').prop("disabled",false);
                                    $('#auth_password_confirmation_message-error').html('');
                                    $('#auth_password_confirmation').removeClass('border-danger');
                                    $('#auth_password_confirmation').addClass('border-success');
                                }else{
                                    if(confirmationPassword != ''){
                                        $('#auth_password_confirmation_message-error').html("{{ Str::title(_trans($namespace, 'auth.message.password_not_match')) }}");
                                        $('#auth_password_confirmation').addClass('border-danger');
                                    }

                                    $('#auth_password_confirmation').prop("disabled",false);
                                    $('#auth_set').prop("disabled",true);
                                }
                            }else{
                                $('#auth_password_message-error').html(response.message);
                                $('#auth_password').addClass('border-danger');
                                $('#auth_password_confirmation_message-error').html('');
                                $('#auth_password_confirmation').removeClass('border-danger');
                                $('#auth_password_confirmation').val('');
                                $('#auth_password_confirmation').prop("disabled",true);
                                $('#auth_set').prop("disabled",true);
                            }
                        },
                        error: function () {
                            $('#auth_set_message-error').html('error');
                            $('#auth_set').prop("disabled",true);
                        }
                    });
                }else{
                    $('#auth_password_message-error').html("{{ Str::title(_trans($namespace, 'auth.message.password_at_least', null, ['digit' => _settings('admin', 'password_length')?: 6])) }}");
                    $('#auth_password').addClass('border-danger');
                }
            }
        }

    </script>

@endpush
