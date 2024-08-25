@extends(_current_theme('index'))

@push('styles')
    {{-- style here --}}
@endpush

@section('title', _title_separation() . Str::title($title) . ' - ' . auth()->user()->name)

@section('breadcrumb')
    <span class="breadcrumb-item active">{{ Str::title($title) }}</span>
@endsection()

@section('content')
<div id="update" class="row py-3">
    <div class="col-md-3 border-right">
        <div class="d-flex flex-column align-items-center text-center p-3 py-5">
            <div class="card-img-actions d-inline-block mb-3">
                <img class="rounded-circle" src="{{ _get_image(auth()->user()->profile_pic, 'profile') }}" width="150" height="150" alt="{{ auth()->user()->code }}">
                <div class="card-img-actions-overlay card-img rounded-circle">
                    <a href="#" class="btn btn-outline-white border-2 btn-icon rounded-pill">
                        <i class="icon-pencil"></i>
                    </a>
                </div>
            </div>
            <span class="font-weight-bold">{{ Str::ucfirst(auth()->user()->name) }}</span>
            <span class="text-muted">{{ auth()->user()->code }}</span>
            <span class="text-muted">{{ auth()->user()->email }}</span>
        </div>
        @if(auth()->user()->id != 1)
        <div class="col">
            @if(!_can_update_profile())
                @include(_current_theme('components.buttons.success '), [
                    'id' => 'requestUpdateProfile',
                    'name' => 'requestUpdateProfile',
                    'type' => 'button',
                    'style' => 'btn-outline',
                    'class' => 'btn-sm',
                    'icon' => null,
                    'value' => Str::title(_trans($namespace, 'button.request_update_profile')),
                    'disabled' => (auth()->user()->status == 4)? true : false
                ])
            @else
            <div class="text-center text-muted mb-2 pb-2">
                {{ Str::lower(_trans($namespace, 'button.requested_update_profile')) }}
            </div>
            @endif
        </div>
        @endif

        @if(auth()->user()->id != 1)
        <div class="col">
            @include(_current_theme('components.buttons.danger '), [
                'id' => 'requestUpdateProfile',
                'name' => 'requestUpdateProfile',
                'type' => 'button',
                'style' => 'btn-outline',
                'class' => 'btn-sm',
                'icon' => null,
                'value' => Str::title(_trans($namespace, 'button.request_close_account')),
                'disabled' => (auth()->user()->status == 4)? true : false
            ])
        </div>
        @endif
    </div>
    <div class="col-md-5 border-right">
        <div class="p-3 py-5">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <span class="font-weight-bold text-muted">{{ Str::title(_trans($namespace, 'profile.update-profile')) }}:</span>
            </div>
            <div class="row mt-2">
                <div class="col-md-12">
                    <label class="labels">{{ Str::title(_trans($namespace, 'name')) }}</label>
                    <input type="text" class="form-control" placeholder="first name" value="{{ auth()->user()->name }}" @if(!_can_update_profile()) disabled @endif>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-12">
                    <label class="labels">{{ Str::title(_trans($namespace, 'email')) }}</label>
                    @include(_current_theme('components.fields.textbox'), [
                        'id' => 'email',
                        'name' => 'email',
                        'placeholder' => Str::title(_trans($namespace, 'email')),
                        'value' => auth()->user()->email,
                        'icon' => 'far fa-envelope',
                        'iconPosition' => 'left',
                        'required' => true,
                        'disabled' => !_can_update_profile()
                    ])
                </div>
                <div class="col-md-12">
                    <label class="labels">{{ Str::title(_trans($namespace, 'phone')) }}</label>
                    @include(_current_theme('components.fields.textbox'), [
                        'id' => 'phone',
                        'name' => 'phone',
                        'placeholder' => Str::title(_trans($namespace, 'phone')),
                        'value' => auth()->user()->phone,
                        'icon' => 'icon-phone2',
                        'iconPosition' => 'left',
                        'required' => true,
                        'disabled' => !_can_update_profile()
                    ])
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-12 mb-3">
                    <label class="labels">{{ Str::title(_trans($namespace, 'user_title')) }}</label>
                    <select class="form-control select" name="title" disabled data-fouc>
                        @foreach($titles as $title)
                        <option value="{{ $title['id'] }}" @if($title['id'] == auth()->user()->title)selected @endif>{{ Str::title($title['name']['value']) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-12">
                    <label class="labels">{{ Str::title(_trans($namespace, 'gender')) }}</label>
                    <select class="form-control select" name="gender" data-fouc>
                        @foreach($genders as $gender)
                        <option value="{{ $gender['id'] }}" @if($gender['id'] == auth()->user()->gender)selected @endif>{{ Str::title($gender['name']['value']) }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="mt-5 text-center">
                @include(_current_theme('components.buttons.primary'), [
                    'id' => 'updateProfille',
                    'name' => 'updateProfille',
                    'type' => 'submit',
                    'style' => 'btn',
                    'class' => '',
                    'icon' => null,
                    'value' => Str::title(_trans($namespace, 'button.update_profile')),
                    'disabled' => (auth()->user()->status == 4)? true : false
                ])
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="p-3 py-5">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <span class="font-weight-bold text-muted">{{ Str::title(_trans($namespace, 'profile.update-password')) }}:</span>
            </div>
            <div class="col-md-12">
                @include(_current_theme('components.fields.textbox'), [
                    'id' => 'current_password',
                    'name' => 'current_password',
                    'type' => 'password',
                    'placeholder' => Str::title(_trans($namespace, 'auth.current_password')),
                    'icon' => 'icon-lock2',
                    'iconPosition' => 'left',
                    'oninput' => 'validatePasswordConfirmation()',
                    'required' => true
                ])
            </div>
            <div class="col-md-12">
                @include(_current_theme('components.fields.textbox'), [
                    'id' => 'password',
                    'name' => 'password',
                    'type' => 'password',
                    'placeholder' => Str::title(_trans($namespace, 'auth.new_password')),
                    'icon' => 'icon-lock2',
                    'iconPosition' => 'left',
                    'oninput' => 'validatePasswordConfirmation()',
                    'required' => true
                ])
            </div>
            <div class="col-md-12">
                @include(_current_theme('components.fields.textbox'), [
                    'id' => 'password_confirmation',
                    'name' => 'password_confirmation',
                    'type' => 'password',
                    'placeholder' => Str::title(_trans($namespace, 'auth.confirmation_password')),
                    'icon' => 'icon-lock2',
                    'iconPosition' => 'left',
                    'oninput' => 'validatePasswordConfirmation()',
                    'disabled' => true,
                    'required' => true
                ])
            </div>
            <div class="col-md-12">
                @include(_current_theme('components.buttons.primary'), [
                    'id' => 'set',
                    'name' => 'set',
                    'type' => 'submit',
                    'style' => 'btn',
                    'class' => '',
                    'icon' => null,
                    'value' => Str::title(_trans($namespace, 'auth.button.set_password')),
                    'disabled' => true
                ])
            </div>
        </div>
    </div>
</div>
@endsection()

@push('footer-scripts')
<script src="{{ _assets('js/plugins/select2.min.js') }}"></script>
    <script type="text/javascript">
        $('.select').select2({
            minimumResultsForSearch: Infinity
        });

        function validatePasswordConfirmation()
        {
            var currentPassword = $('#current_password').val();
            var password = $('#password').val();
            var confirmationPassword = $('#password_confirmation').val();
            if(password == ''){
                $('#set').prop("disabled", true);
            }else{
                var url = "{{ Route('admin.check.password.old') }}";
                var passwordLength = "{{ _settings('admin', 'password_length')?: 6 }}";
                var email = $('#email').val();
                if(password.length >= passwordLength){
                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: jQuery.param({ email: email, password:password}),
                        contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
                        success: function (response) {
                            if(response.status){
                                $('#password_message-error').html('');
                                $('#password').removeClass('border-danger');
                                $('#password').addClass('border-success');
                                if(password == confirmationPassword){
                                    if(currentPassword != ''){
                                        $('#set').prop("disabled",false);
                                        $('#current_password').removeClass('border-danger');
                                    }else{
                                        $('#current_password').addClass('border-danger');
                                    }
                                    $('#password_confirmation_message-error').html('');
                                    $('#password_confirmation').removeClass('border-danger');
                                    $('#password_confirmation').addClass('border-success');
                                }else{
                                    if(confirmationPassword != ''){
                                        $('#password_confirmation_message-error').html("{{ Str::title(_trans($namespace, 'auth.message.password_not_match')) }}");
                                        $('#password_confirmation').addClass('border-danger');
                                    }

                                    $('#password_confirmation').prop("disabled",false);
                                    $('#set').prop("disabled",true);
                                }
                            }else{
                                $('#password_message-error').html(response.message);
                                $('#password').removeClass('border-success');
                                $('#password').addClass('border-danger');
                                $('#password_confirmation_message-error').html('');
                                $('#password_confirmation').removeClass('border-danger');
                                $('#password_confirmation').val('');
                                $('#password_confirmation').prop("disabled",true);
                                $('#set').prop("disabled",true);
                            }
                        },
                        error: function () {
                            $('#set_message-error').html('error');
                            $('#set').prop("disabled",true);
                        }
                    });
                }else{
                    $('#password_message-error').html("{{ Str::title(_trans($namespace, 'auth.message.password_at_least', null, ['digit' => _settings('admin', 'password_length')?: 6])) }}");
                    $('#password').addClass('border-danger');
                    $('#set').prop("disabled",true);
                    $('#password_confirmation').prop("disabled",true);
                }
            }
        }

    </script>

@endpush
