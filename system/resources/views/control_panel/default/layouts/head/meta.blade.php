        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="author" content="{{ Str::title(ENV('APP_NAME')) }}"/>
        <meta name="description" content="{{ Str::title(_settings('seo', 'description')) }}"/>

        <link rel="shortcut icon" sizes="16x16 32x32 48x48 64x64" type="image/vnd.microsoft.icon" href="{{ _favicon() }}">

        <meta name="application-name" content="{{ Str::title(_settings('settings', 'name')) }} {{ _title_separation() }}{{ Str::title(_settings('settings', 'slug')) }}"/>
        <meta name="msapplication-TileImage" content=""/>
        <meta name="msapplication-TileColor" content="#{{ _settings('settings', 'main_color') }}"/>
        <meta name="msapplication-square70x70logo" content=""/>
        <meta name="msapplication-square150x150logo" content=""/>
        <meta name="msapplication-wide310x150logo" content=""/>
        <meta name="msapplication-square310x310logo" content=""/>
        <link rel="apple-touch-icon-precomposed" href=""/>

        <meta property="og:type" content="website"/>
        <meta property="og:site_name" content="{{ Str::title(_settings('settings', 'name')) }} {{ _title_separation() }}{{ Str::title(_settings('settings', 'slug')) }}"/>
        <meta property="og:locale" content="{{ app()->getLocale() }}"/>
        <meta property="og:locale:alternate" content="{{ app()->getLocale() }}"/>
        <meta property="og:url" content="{{ url('') }}"/> <!-- url of main request -->
        <meta property="og:title" content="{{ Str::title(_settings('settings', 'name')) }} @yield('title')"/>
        <meta property="og:description" content="Description of page seo"/>

        <meta property="og:image" content="@if(auth()->check()){{ _get_image(auth()->user()->profile_pic, 'profile') }}@else logo Dimentions 630*630 @endif"/>
        <meta property="og:image:width" content="256"/>
        <meta property="og:image:height" content="256"/>

        <meta itemprop="name" content="{{ Str::title(_settings('settings', 'name')) }} {{ _title_separation() }}{{ Str::title(_settings('settings', 'slug')) }}"/>
        <meta itemprop="url" content="{{ url('') }}"/> <!-- url of main request -->
        <meta itemprop="author" content="{{ Str::title(ENV('APP_NAME')) }}"/>
        <meta itemprop="image" content="@if(auth()->check()){{ _get_image(auth()->user()->profile_pic, 'profile') }}@else logo Dimentions 630*630 @endif"/>
        <meta itemprop="description" content="Description of page seo"/>

        <meta name="twitter:card" content="summary"/>
        <meta name="twitter:site" content="{{ Str::title(_settings('social', 'twitter')) }}"/>
        <meta name="twitter:creator" content="{{ Str::title(_settings('social', 'twitter')) }}"/>
        <meta name="twitter:title" content="{{ Str::title(_settings('settings', 'name')) }} @yield('title')"/>
        <meta name="twitter:image" content=""/>
        <meta name="twitter:image:alt" content="{{ Str::title(_settings('settings', 'name')) }} @yield('title')"/>
        <meta name="twitter:description" content="Description of page seo"/>

        <!-- Chrome, Firefox OS and Opera -->
        <meta name="theme-color" content="#{{ _settings('settings', 'main_color') }}">
        <!-- Windows Phone -->
        <meta name="msapplication-navbutton-color" content="#{{ _settings('settings', 'main_color') }}">
        <!-- iOS Safari -->
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="#{{ _settings('settings', 'main_color') }}">
        <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate, no-transform">
        <meta http-equiv="Pragma" content="no-cache">
        <meta http-equiv="Expires" content="-1">

        <meta name="viewport" content="viewport-fit=cover, width=device-width, initial-scale=1, maximum-scale=1">
