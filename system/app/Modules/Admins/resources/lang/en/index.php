<?php

return [
    'main_menu' => 'main menu',
    'main' => 'main',
    'title' => 'admins',
    'admin' => 'admin',
    'administration' => 'administration',

    'view' => [
        'all' => 'all admins',
        'admin' => 'view admin',
    ],
    'add' => [
        'new' => 'add new admin',
    ],

    'name' => 'name',
    'phone' => 'phone',
    'email' => 'email',
    'user_title' => 'title',
    'code' => 'code',
    'gender' => 'gender',
    'status' => 'status',
    'action' => 'action',


    'dashboard' => [
        'title' => 'dashboard',
    ],

    'profile' => [
        'title' => 'profile',
        'update-profile' => 'update profile',
        'update-password' => 'update password',
        'account_settings' => 'account settings',
        'my_profile' => 'my profile',
    ],

    // buttons
    'button' => [
        'view' => 'view',
        'edit' => 'edit',
        'delete' => 'delete',
        'distroy' => 'distroy',
        'restore' => 'restore',
        'close' => 'close',

        // profile
        'update_profile' => 'update profile',
        'request_update_profile' => 'request update',
        'requested_update_profile' => 'you can update profile',
        'request_close_account' => 'close account',
    ],


    // messages
    'message' => [
        'delete' => 'are you sure to delete this admin?',
        'deleted-success' => 'admin deleted successfully',
        'deleted-error' => 'this admin can\'t deleted',
        'change-status-success' => 'admin status updated successfuly',
        'change-status-error' => 'something error when change admin status',
        'status-error' => 'admins module not support this status',
        'no-admin-error' => 'no admin found please contact support',
        'suspended' => 'your account is suspended',
        'warning' => 'warning!',
    ],

    // validations
    'validation' => [
        'required' => 'The :Attribute field is required.',
    ],

    // auth
    'auth' => [
        'login' => 'login',
        'logout' => 'logout',
        'signin' => 'signin',
        'your_email' => 'your email',
        'username' => 'username',
        'password' => 'password',
        'current_password' => 'current password',
        'new_password' => 'new password',
        'confirmation_password' => 'confirmation password',
        'remember' => 'remember',
        'forgot' => 'Forgot password',

        'button' => [
            'signin' => 'signin',
            'unlock' => 'unlock',
            'reset_password' => 'reset',
            'set_password' => 'set password',
        ],


        'message' => [
            'login' => 'login to your account',
            'credentials' => 'your credentials',
            'unlock' => 'unlock your account',
            'signin' => 'login to your account',
            'have_an_account' => 'have an account?',
            'logged-out' => 'you will be logged out in <span class="font-weight-semibold">:min</span> minutes of inactivity',
            'failed' => 'the username or password you entered is incorrect.',

            // email
            'incorrect' => 'you enter incorrect mail.',
            'email-notfound' => 'this email does not belong to any account.',
            'reset_mail_sent' => 'an email has been sent to your email with a link to update your password.',
            'failed_mail_sent' => 'your account is not active and can\'t reset password. please call support.',

            // password
            'forgot_password' => 'forgot password?',
            'password_recovery' => 'password recovery',
            'recovery_instructions' => 'We\'ll send you instructions in email',
            'reset_password' => 'password recovery',
            'password_at_least' => 'you have to enter at least :digit digit!',
            'password_not_match' => 'passwords don\'t match',
            'update_password' => 'update password',
            'incorrect' => 'The provided password is incorrect.',
            'same_password' => 'choose new password you didn\'t use it before.',
            'session_reset_password_expired' => 'your reset password session is expired or change.',
        ],
    ],

    'email_message'=> [
        "new_sign_in" => "A new sign-in on",
    ],

    'front' => [
        'view' => 'view website',
    ]
];
