<?php

namespace App\Providers;

use Tenancy\Service\TenantService;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

// use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // set default String Length
        Schema::defaultStringLength(255);

        // detect tenant from request
        if(env("APP_TENANCY"))
            TenantService::detectTenant();

        $systemConfig = _get_settings();
        config(['app.settings' => $systemConfig]);

        $systemLanguages = _get_languages();
        config(['app.languages' => $systemLanguages]);

        if (config('app.env') === 'production') {
            URL::forceScheme('https');
        }
    }
}
