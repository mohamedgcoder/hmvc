@extends(_moduleName($namespace).'::' . $module.'.index')

@push('styles')
@endpush

@section('content')

    <!-- forget password form -->
    <form class="login-form" action="{{ route('admins.recoverPassword') }}" method="post">
        @if(request('redirect') != null)
            <input type="hidden" name="redirect" value="{{ request('redirect') }}"/>
        @endif
        @csrf
        <div class="card mb-0">
            <div class="card-body">
                <div class="text-center mb-3">
                    <i class="icon-spinner11 icon-2x text-secondary border-secondary border-3 rounded-pill p-3 mb-3 mt-1"></i>
                    <h5 class="mb-0">{{ _trans($namespace, 'auth.message.password_recovery') }}</h5>
                    <span class="d-block text-muted">{{ _trans($namespace, 'auth.message.recovery_instructions') }}</span>
                </div>

                @include(_current_theme('components.alerts'))

                @include(_current_theme('components.fields.textbox'), [
                    'id' => 'auth_email',
                    'name' => 'email',
                    'placeholder' => Str::title(_trans($namespace, 'email')),
                    'icon' => 'far fa-envelope',
                    'iconPosition' => 'left',
                    'oninput' => 'checkIfFoundEmail()'
                ])

                @include(_current_theme('components.buttons.primary'), [
                    'id' => 'auth_reset',
                    'name' => 'reset',
                    'type' => 'submit',
                    'style' => 'btn',
                    'class' => 'btn-block',
                    'value' => Str::title(_trans($namespace, 'auth.button.reset_password')),
                    'disabled' => true,
                ])

                <div class="form-group text-center text-muted content-divider">
                    <span class="px-2 text-capitalize">{{_trans($namespace, 'auth.message.have_an_account')}}</span>
                </div>

                <div class="form-group">
                    <a href="{{ route('admins.login') }}" class="d-block text-center text-capitalize">{{_trans($namespace, 'auth.message.login')}}</a>
                </div>
            </div>
        </div>
    </form>
    <!-- /forget password form -->

@endsection

@push('footer-scripts')

    <script type="text/javascript">
        $('#auth_email').val('');
        function checkIfFoundEmail() {
            var reg = {{ _reg() }};
            var email = $('#auth_email').val();
            if(email != '' && reg.test(email) == true){
                var url = "{{ Route('admins.check.email') }}";
                $.ajax({
                url: url,
                type: 'POST',
                data: jQuery.param({ email: email}),
                contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
                success: function (response) {
                    if(response.status){
                        $('#auth_email_message').html('');
                        $('#auth_email').removeClass('is-invalid');
                        $('#auth_email').addClass('is-valid');
                        $('#auth_reset').prop("disabled",false);
                    }else{
                        $('#auth_reset').prop("disabled",true);
                        $('#auth_email_message').html(response.message);
                        $('#auth_email').removeClass('is-valid');
                        $('#auth_email').addClass('is-invalid');
                    }
                },
                error: function () {
                    $('#auth_reset').prop("disabled",true);
                    $('#auth_email_message').html('error');
                }
            });
            }else{
                $('#auth_reset').prop("disabled",true);
                $('#auth_email').removeClass('is-valid');
                $('#auth_email').removeClass('is-invalid');
            }
        };
    </script>

@endpush
