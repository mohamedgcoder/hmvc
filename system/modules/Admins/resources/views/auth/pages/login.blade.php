@extends(_moduleName($namespace).'::' . $module.'.index')

@push('styles')

@endpush

@section('content')
    <!-- Login card -->
    <form class="login-form" action="{{ route('admins.signin') }}" method="post">
        @if(request('redirect') != null)
            <input type="hidden" name="redirect" value="{{ request('redirect') }}"/>
            <input type="hidden" name="type" value="login"/>
        @endif
        @csrf
        <div class="card mb-0">
            <div class="card-body">
                <div class="text-center mb-3">
                    <i class="icon-reading icon-2x text-secondary border-secondary border-3 rounded-pill p-3 mb-3 mt-1"></i>
                    <h5 class="mb-0">{{ _trans($namespace, 'auth.message.login') }}</h5>
                    <span class="d-block text-muted">{{ _trans($namespace, 'auth.message.credentials') }}</span>
                </div>

                @include(_current_theme('components.alerts'))

                @include(_current_theme('components.fields.textbox'), [
                    'id' => 'auth_email',
                    'name' => 'login',
                    'placeholder' => _trans($namespace, 'email'),
                    'oninput' => 'checkIfFoundEmail()',
                    'icon' => 'far fa-envelope  text-muted',
                    'iconPosition' => 'left',
                    'required' => true
                ])

                @include(_current_theme('components.fields.textbox'), [
                    'id' => 'login-password',
                    'name' => 'password',
                    'type' => 'password',
                    'placeholder' => _trans($namespace, 'auth.password'),
                    'oninput' => 'validatePassword()',
                    'icon' => 'icon-lock2 text-muted',
                    'iconPosition' => 'left',
                    'required' => true
                ])

                <div class="form-group d-flex align-items-center">
                    {{-- <label class="custom-control custom-checkbox">
                        <input type="checkbox" name="remember" class="custom-control-input" checked>
                        <span class="custom-control-label">{{ Str::title(_trans($namespace, 'auth.remember')) }}</span>
                    </label> --}}

                    <a href="{{ route('admins.forgetPassword') }}" class="ml-auto text-capitalize">{{_trans($namespace, 'auth.message.forgot_password')}}</a>
                </div>

                @if(_settings('settings', 'expiration_logged_in') !== null && _settings('settings', 'expiration_logged_in') > 0)
                    <div class="col alert alert-info border-0">
                        {{ Str::of(_trans($namespace, 'auth.message.logged-out', null, ['min' => _settings('settings', 'expiration_logged_in')]))->toHtmlString() }}
                    </div>
                @endif

                @include(_current_theme('components.buttons.primary'), [
                    'id' => 'auth_login',
                    'name' => 'login',
                    'type' => 'submit',
                    'style' => 'btn',
                    'class' => 'btn-block',
                    'value' => _trans($namespace, 'auth.button.signin'),
                    'disabled' => true,
                ])

            </div>
        </div>
    </form>
    <!-- /login card -->

@endsection

@push('footer-scripts')
    <script type="text/javascript">
        var emailVerifying = false;
        $(document).ready(function(){
            $('#auth_email').val('');
            $('#auth_password').val('');
            if("{{ (new Jenssegers\Agent\Agent)->browser() }}" == "Chrome"){
                function preventBack(){window.history.forward();}
                setTimeout("preventBack()", 0);
                window.onunload = function(){null};
            }

            if("{{ (new Jenssegers\Agent\Agent)->browser() }}" == "Firefox"){
                history.pushState(null, null, location.href);
                history.back();
                history.forward();
                window.onpopstate = function () { history.go(1); };
            }

            if("{{ (new Jenssegers\Agent\Agent)->browser() }}" == "Safari"){
                function noBack(){window.history.forward();}
                noBack();
                window.onload=noBack;
                window.onpageshow=function(evt){if(evt.persisted)noBack();}
                window.onunload=function(){void(0);}
            }
        });

        function checkIfFoundEmail()
        {
            var reg = {{ _reg() }};
            var email = $('#auth_email').val();
            var password = $('#auth_password').val();
            if(email != '' && reg.test(email) == true){
                var url = "{{ Route('admins.check.email') }}";
                $.ajax({
                url: url,
                type: 'POST',
                data: jQuery.param({ email: email}),
                contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
                success: function (response) {
                    if(response.status){
                        $('#auth_email_message-error').html('');
                        $('#auth_email').removeClass('is-invalid');
                        $('#auth_email').addClass('is-valid');
                        emailVerifying = true;
                        if(password != ''){
                            $('#auth_login').prop("disabled",false);
                        }else{
                            $('#auth_login').prop("disabled",true);
                        }
                    }else{
                        $('#auth_email_message-error').html(response.message);
                        $('#auth_email').removeClass('is-valid');
                        $('#auth_email').addClass('is-invalid');
                        $('#auth_login').prop("disabled",true);
                        emailVerifying = false;
                    }
                },
                error: function () {
                    $('#auth_email_message-error').html('error');
                    $('#auth_login').prop("disabled",true);
                    emailVerifying = false;
                }
            });
            }else{
                $('#auth_email').removeClass('is-valid');
                $('#auth_email').removeClass('is-invalid');
                $('#auth_email_message-error').html('');
                $('#auth_login').prop("disabled",true);
                emailVerifying = false;
            }
        };

        function validatePassword()
        {
            var password = $('#auth_password').val();
            if(password != '' && emailVerifying){
                $('#auth_login').prop("disabled",false);
            }else{
                $('#auth_login').prop("disabled",true);
            }
        }
    </script>

@endpush
