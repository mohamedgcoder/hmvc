<?php

namespace Module\Contacts\Providers;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;

class ModuleServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $ModuleName = basename(dirname(__DIR__, 1));
        // load config
        $this->loadConfigFiles($ModuleName);

        // load routes
        $this->loadRouteFiles($ModuleName);

        // load view files
        $this->loadViewsFrom(_loadViews($ModuleName), _moduleSingular($ModuleName));

        // load translations file
        $this->loadTranslationsFrom(_loadTranslations($ModuleName), _moduleSingular($ModuleName));

        // load migrations
        $this->loadMigrationsFrom(_loadMigrations($ModuleName));

        // set Config
        $this->setConfig();
    }

    public function loadConfigFiles($ModuleName)
    {
        $configFiles = _configFiles($ModuleName);

        if (!empty($configFiles)) {
            $config = [];
            foreach ($configFiles as $file) {
                $config[$file] = File::getRequire(_loadConfigFile($ModuleName, $file));
            }
        }

        if (!empty($config)) {
            config($config);
        }
    }

    public function loadRouteFiles($ModuleName)
    {
        $routeFiles = _routeFiles($ModuleName);
        if (!empty($routeFiles)) {
            foreach ($routeFiles as $file) {
                $this->loadRoutesFrom(_loadRoute($ModuleName, $file));
            }
        }
    }

    public function setConfig()
    {
        try{
            if(_settings('mail') != null){
                $mailConfig = [
                    'transport' => _settings('mail', 'transport'),
                    'host' => _settings('mail', 'host'),
                    'port' => _settings('mail', 'port'),
                    'encryption' => _settings('mail', 'encryption'),
                    'username' => _settings('mail', 'user_name'),
                    'password' => _settings('mail', 'password'),
                    'timeout' => _settings('mail', 'timeout')
                ];

                //Set configuration values at runtime
                config(['mail.default' => _settings('mail', 'transport')]);
                config(['mail.mailers.'._settings('mail', 'transport') => $mailConfig]);
            }
        }catch(\Exception $e){
            return $e->getMessage();
        }
    }
}
