@component('mail::message')
# {{ _trans($data['namespace'], 'auth.message.reset_password') }}

Welcome {{ $data['data']->name }} <br>
We're sending you this email because you requested a password reset. Click on this link to create a new password:

@component('mail::button', ['url' => route('admins.resetPassword', ['token' => $data['token']])])
Reset Password
@endcomponent

<!-- <center>Or</center><br>
copy this link
<a href="{{ route('admins.resetPassword', $data['token']) }}"> {{route('admins.resetPassword', $data['token']) }}</a><br> -->

If you didn't request a password reset, you can ignore this email. Your password will not be changed.

Thanks,<br>
{{ _settings('settings', 'name') }}
@endcomponent
