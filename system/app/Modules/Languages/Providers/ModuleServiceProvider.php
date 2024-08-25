<?php

namespace Languages\Providers;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;
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
            if(Schema::hasTable('languages') && Schema::hasTable('settings')){
                // config('app.locale', _settings('language', 'default'));
            }
        }catch(\Exception $e){
            return $e->getMessage();
        }
    }
}
