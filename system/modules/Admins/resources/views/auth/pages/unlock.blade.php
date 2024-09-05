@extends(_moduleName($namespace).'::' . $module.'.index')

@push('styles')
@endpush

@section('content')

    <!-- unlock form -->
    <form class="login-form" action="{{ route('admins.signin') }}" method="post">
        @if(request('redirect') != null)
            <input type="hidden" name="redirect" value="{{ request('redirect') }}"/>
        @endif
        @csrf
        <div class="card mb-0">
            <div class="card-body">
                <div class="text-center mb-3">
                    <img class="rounded-circle" src="{{ _get_image($profile, 'profile') }}" width="160" height="160" alt="">
                    <h5 class="mb-0">{{ $userName }}</h5>
                    <span class="d-block text-muted">{{ _trans($namespace, 'auth.message.unlock') }}</span>
                </div>

                @include(_current_theme('components.alerts'))

                {{-- @include(_current_theme('components.fields.textbox'), [
                    'id' => 'redirect',
                    'name' => 'redirect',
                    'type' => 'hidden',
                    'value' => $redirect
                ]) --}}

                @include(_current_theme('components.fields.textbox'), [
                    'id' => 'auth_email',
                    'name' => 'login',
                    'type' => 'hidden',
                    'value' => $userEmail
                ])

                @include(_current_theme('components.fields.textbox'), [
                    'id' => 'auth_password',
                    'name' => 'password',
                    'type' => 'password',
                    'placeholder' => Str::title(_trans($namespace, 'auth.password')),
                    'icon' => 'icon-user-lock text-muted',
                    'iconPosition' => 'left',
                    'oninput' => 'validatePassword()',
                    'required' => true
                ])

                <div class="form-group d-flex align-items-center">
                    <a href="{{ route('admins.forgetPassword') }}" class="ml-auto">{{ Str::title(_trans($namespace, 'auth.message.forgot_password')) }}</a>
                </div>

                @include(_current_theme('components.buttons.primary'), [
                    'id' => 'auth_unlock',
                    'name' => 'unlock',
                    'type' => 'submit',
                    'style' => 'btn',
                    'class' => 'btn-block',
                    'value' => Str::title(_trans($namespace, 'auth.button.unlock')),
                    'icon' => 'icon-unlocked mr-2',
                    'iconPosition' => 'left',
                    'disabled' => true,
                ])

            </div>
        </div>
    </form>
    <!-- /unlock form -->

@endsection

@push('footer-scripts')

    <script type="text/javascript">

        function validatePassword()
        {
            var password = $('#auth_password').val();
            if(password != ''){
                $('#auth_unlock').prop("disabled",false);
            }else{
                $('#auth_unlock').prop("disabled",true);
            }
        }

    </script>

@endpush
