<?php

return [
    'title' => 'الإعدادات',

    'general' => [
        'title' => 'إعدادات عامة',
        'dark_mode' => 'الوضع المظلم',
    ],

    'identity' => [
        'title' => 'الهوية',
        'header' => 'إعدادات الهوية',
        'name' => 'الاسم',
        'name-placeholder' => 'الاسم',
        'address' => 'العنوان',
        'address-placeholder' => 'العنوان',
    ],

    'appearance' => [
        'title' => 'المظهر العام',
        'header' => 'إعدادات المظهر العام',
        'title_separation' => 'فاصل العنوان',
        'color' => 'الألوان',
        'color-note' => 'يجب النقر فوق اختيار لضبط اللون في الإعدادات',
        'logo_color' => 'لون الشعار',
        'button_color' => 'الزرار الاساسى',
        'main_color' => 'اللون الأساسي',
        'navbar_color' => 'لون شريط التنقل',
        'border_color' => 'الاطار',
        'hover_color' => 'التغير',
        'focus_color' => 'التركيز',
        'text_color' => 'الكتابة',
        'text_hover_color' => 'الكتابة المتغيرة',
    ],

    'system' => [
        'title' => 'معلومات النظام',
        'header' => 'إعدادات معلومات النظام',
        'domain' => 'النطاق',
        'debug' => 'وضع تصحيح الأخطاء',
        'debug_note' => 'للتطوير',
        'env' => 'بيئة النظام',
        'env_note' => 'محلي: يُستخدم هذا عادةً أثناء التطوير على الجهاز المحلي للمطور. عند ضبطه على الوضع المحلي، قد يعرض <code>السيستم</code> المزيد من معلومات تصحيح الأخطاء ويمكّن ميزات معينة مفيدة أثناء التطوير.
                        الإنتاج: عندما يكون التطبيق نشطًا ويتم استخدامه من قبل المستخدمين النهائيين، يجب تعيين <code>APP_ENV</code> على الإنتاج. في هذا الوضع، يتم منع رسائل الخطأ أو التقليل منها لتجنب كشف المعلومات الحساسة.
                        التدريج: يُستخدم هذا غالبًا لبيئة ما قبل الإنتاج التي تعكس بيئة الإنتاج بأكبر قدر ممكن. يتم استخدامه للاختبار النهائي قبل النشر في الإنتاج.
                        الاختبار: يتم استخدام هذه البيئة عند إجراء اختبارات تلقائية، مثل اختبارات <code>PHPUnit</code> أو اختبارات متصفح Dusk. تم تكوين <code>السيستم</code> لاستخدام إعدادات مختلفة تم تحسينها لبيئات الاختبار.',
        'timezone' => 'وحدة زمنية',
        'expiration_logged_in' => 'إنتهاء صلاحية جلسة تسجيل الدخول بعد',
        'expiration_logged_in_note' => 'بالثوانى',
        'expiration_reset_password' => 'تنتهي صلاحية جلسة إعادة تعيين كلمة المرور بعد ذلك',
        'api_pagination' => 'api pagination count',
        'api_pagination_note' => '0 يعني عدم وجود ترقيم الصفحات',
        'web_pagination' => 'web pagination count',
        'web_pagination_note' => '0 يعني عدم وجود ترقيم الصفحات',
        'local' => 'محلي',
        'production' => 'إنتاج',
        'staging' => 'التدريج',
        'testing' => 'اختبارات',
    ],

    'mobile' => [
        'title' => 'إعدادات الموبيل',
        'header' => 'إعدادات الموبيل',
    ],

    'seo' => [
        'title' => 'محركات البحث',
        'header' => 'إعدادات محركات البحث',
        'slogan' => 'الشعار',
        'slogan-placeholder' => 'اكتب شعار النظام الخاص بك',
        'description' => 'الوصف',
        'description-placeholder' => 'قم بوصف تطبيقك',
        'keywords' => 'الكلمات الدالة',
        'keywords-def' => 'يمكنك إضافة كلمات رئيسية تحدد نظام السيو الخاص بك، وتفصله عن طريق الإدخال',
    ],

    'social' => [
        'title' => 'التواصل الاجتماعي',
        'header' => 'إعدادات التواصل الاجتماعي',
    ],

    'security' => [
        'title' => 'الحماية',
        'header' => 'إعدادات الحماية',
        'api_integrations' => 'بيانات ربط النظام',
        'system_key' => 'مفتاح النظام',
        'secret_key' => 'المفتاح السري',
    ],

    'integrations' => [
        'title' => 'الربط الخارجى',
        'header' => 'إعدادات الربط الخارجى',
        'mail' => 'mail',
        'transport' => 'transport',
        'host' => 'host',
        'port' => 'port',
        'timeout' => 'timeout',
        'queue_delay' => 'queue delay',
        'encryption' => 'encryption',
        'user_name' => 'user name',
        'password' => 'password',
        'firebase' => 'firebase',
        'firebase_secret_key' => 'firebase secret key',
        'fcm_topic' => 'fcm topic',
        'google' => 'google',
        'google_map_key' => 'google map key',
    ],

];
