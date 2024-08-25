<?php

return [
    'main_menu' => 'القائة الرئيسية',
    'main' => 'الرئيسية',
    'title' => 'المشرفين',
    'admin' => 'مشرف',
    'administration' => 'الإدارة',

    'view' => [
        'all' => 'جميع المشرفين',
        'admin' => 'عرض بيانات المشرف',
    ],
    'add' => [
        'new' => 'إضافة مشرف جديد',
    ],

    'name' => 'الأسم',
    'phone' => 'رقم الهاتف',
    'email' => 'الإيميل',
    'user_title' => 'اللقب',
    'code' => 'الكود',
    'gender' => 'النوع',
    'status' => 'الحالة',
    'action' => 'خيارات',

    'dashboard' => [
        'title' => 'لوحة التحكم',
    ],

    'profile' => [
        'title' => 'الملف الشخصى',
        'update-profile' => 'تحديث الملف الشخصى',
        'update-password' => 'تحديث كلمة المرور',
        'account_settings' => 'إعدادات الحساب',
        'my_profile' => 'ملفى الشخصى',
    ],

    // buttons
    'button' => [
        'view' => 'عرض',
        'edit' => 'تعديل',
        'delete' => 'حذف',
        'distroy' => 'حذف نهائى',
        'restore' => 'إستعادة',
        'close' => 'غلق',

        // profile
        'update_profile' => 'تحديث الملف الشخصى',
        'request_update_profile' => 'طلب تعديل الملف الشخصى',
        'requested_update_profile' => 'يمكنك تعديل ملفك',
        'request_close_account' => 'غلق الحساب',
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
        'login' => 'تسجيل الدخول',
        'logout' => 'تسجيل الخروج',
        'signin' => 'تسجيل الدخول',
        'your_email' => 'بريدك الإلكتروني',
        'username' => 'اسم المستخدم',
        'password' => 'كلمة المرور',
        'current_password' => 'كلمة المرور الحالية',
        'new_password' => 'كلمة المرور الجديدة',
        'confirmation_password' => 'تأكيد كلمة المرور',
        'remember' => 'تذكرنى',
        'forgot' => 'نسيت كلمة المرور',

        'button' => [
            'signin' => 'تسجيل الدخول',
            'unlock' => 'إالغاء القفل',
            'reset_password' => 'إعادة',
            'set_password' => 'تعين كلمة المرور',
        ],

        'message' => [
            'login' => 'تسجيل الدخول إلى حسابك',
            'credentials' => 'بيانات الاعتماد الخاصة بك',
            'unlock' => 'إلغاء قفل حسابك',
            'signin' => 'تسجيل الدخول إلى حسابك',
            'have_an_account' => 'لديك حساب بالفعل؟',
            'logged-out' => 'سيتم تسجيل خروجك في <span class="font-weight-semibold">:min</span> دقيقة من عدم النشاط.',

            // email
            'incorrect' => 'إدخال بريد غير صحيح.',
            'email-notfound' => 'هذا البريد الإلكتروني لا ينتمي إلى أي حساب.',
            'reset_mail_sent' => 'تم إرسال بريد إلكتروني إلى بريدك الإلكتروني يحتوي على رابط لتحديث كلمة المرور الخاصة بك.',
            'failed_mail_sent' => 'حسابك غير نشط ولا يمكنه إعادة تعيين كلمة المرور. يرجى الاتصال بالدعم.',

            // password
            'forgot_password' => 'نسيت كلمة المرور؟',
            'password_recovery' => 'استعادة كلمة المرور',
            'recovery_instructions' => 'سنرسل لك التعليمات عبر البريد الإلكتروني',
            'reset_password' => 'استعادة كلمة المرور',
            'password_at_least' => 'يجب عليك إدخال :digit أرقام على الأقل!',
            'password_not_match' => 'كلمات المرور غير متطابقة',
            'update_password' => 'تحديث كلمة المرور',
            'incorrect' => 'كلمة المرور المقدمة غير صحيحة.',
            'same_password' => 'اختر كلمة مرور جديدة لم تستخدمها من قبل.',
            'session_reset_password_expired' => 'انتهت صلاحية جلسة إعادة تعيين كلمة المرور أو تغيرت.',
        ],
    ],

    'email_message'=> [
        "new_sign_in" => "تسجيل دخول جديد على",
    ],

    'front' => [
        'view' => 'معاينة الموقع',
    ]
];
