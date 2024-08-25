<?php

use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| get Module Path
|--------------------------------------------------------------------------
|
|
| @return string
|
 */
if (!function_exists('_getModulePath')) {
    function _getModulePath(string $moduleName)
    {
        return app_path('Modules' . _DS() . $moduleName . _DS());
    }
}

/*
|--------------------------------------------------------------------------
| Load Config File
|--------------------------------------------------------------------------
|
|
| @return string
|
 */
if (!function_exists('_loadConfigFile')) {
    function _loadConfigFile(string $moduleName, string $fileName)
    {
        return _getModulePath($moduleName) . 'config' . _DS() . Str::lower(Str::singular($fileName)) . '.php';
    }
}

/*
|--------------------------------------------------------------------------
| Load Route
|--------------------------------------------------------------------------
|
|
| @return string
|
 */
if (!function_exists('_loadRoute')) {
    function _loadRoute(string $moduleName, string $fileName)
    {
        return _getModulePath($moduleName) . 'routes' . _DS() . $fileName . '.php';
    }
}

/*
|--------------------------------------------------------------------------
| Load Views
|--------------------------------------------------------------------------
|
|
| @return string
|
 */
if (!function_exists('_loadViews')) {
    function _loadViews(string $moduleName)
    {
        return _getModulePath($moduleName) . 'resources' . _DS() . 'views';
    }
}

/*
|--------------------------------------------------------------------------
| Load Translations
|--------------------------------------------------------------------------
|
|
| @return string
|
 */
if (!function_exists('_loadTranslations')) {
    function _loadTranslations(string $moduleName)
    {
        return _getModulePath($moduleName) . 'resources' . _DS() . 'lang';
    }
}

/*
|--------------------------------------------------------------------------
| Load Migrations
|--------------------------------------------------------------------------
|
|
| @return string
|
 */
if (!function_exists('_loadMigrations')) {
    function _loadMigrations(string $moduleName)
    {
        return _getModulePath($moduleName) . 'database' . _DS() . 'migrations';
    }
}

/*
|--------------------------------------------------------------------------
| Load Seeders
|--------------------------------------------------------------------------
|
|
| @return string
|
 */
if (!function_exists('_loadSeeders')) {
    function _loadSeeders(string $moduleName)
    {
        return _getModulePath($moduleName) . 'database' . _DS() . 'seeders';
    }
}

/*
|--------------------------------------------------------------------------
| Module Route Files
|--------------------------------------------------------------------------
|
|
| @return string
|
 */
if (!function_exists('_routeFiles')) {
    function _routeFiles(string $moduleName)
    {
        $routeFiles = [];
        $route_folders = scandir(_getModulePath($moduleName) . 'routes');
        foreach ($route_folders as $route) {
            if (!is_dir($route) && ($route != '.') && ($route != '..')) {
                $route_files = scandir(_getModulePath($moduleName) . 'routes' . _DS() . $route);
                foreach ($route_files as $file) {
                    if (!is_dir($file) && ($file != '.') && ($file != '..')) {
                        if (Str::is('*.php', $file)) {
                            array_push($routeFiles, $route . _DS() . Str::before($file, '.php'));
                        }
                    }
                }
            }
        }
        return $routeFiles;
    }
}

/*
|--------------------------------------------------------------------------
| Module Config Files
|--------------------------------------------------------------------------
|
|
| @return string
|
 */
if (!function_exists('_configFiles')) {
    function _configFiles(string $moduleName)
    {
        $configFiles = [];
        $config_folders = scandir(_getModulePath($moduleName) . 'config');
        foreach ($config_folders as $config) {
            if (!is_dir($config) && ($config != '.') && ($config != '..')) {
                if (Str::is('*.php', $config)) {
                    array_push($configFiles, Str::before($config, '.php'));
                }
            }
        }
        return $configFiles;
    }
}

/*
|--------------------------------------------------------------------------
| Module Prefix
|--------------------------------------------------------------------------
|
|
| @return string
|
 */
if (!function_exists('_modulePrefix')) {
    function _modulePrefix(string $moduleName)
    {
        return _config(Str::lower(_moduleSingular($moduleName)), 'module.prefix');
    }
}

/*
|--------------------------------------------------------------------------
| Module Name
|--------------------------------------------------------------------------
|
|
| @return string
|
 */
if (!function_exists('_moduleName')) {
    function _moduleName(string $moduleName)
    {
        return Str::ucfirst(Str::singular($moduleName));
    }
}

/*
|--------------------------------------------------------------------------
| Module lower Name
|--------------------------------------------------------------------------
|
|
| @return string
|
 */
if (!function_exists('_modulelowerName')) {
    function _modulelowerName(string $moduleName)
    {
        return Str::lower($moduleName);
    }
}

/*
|--------------------------------------------------------------------------
| Module lower Singular Name
|--------------------------------------------------------------------------
|
|
| @return string
|
 */
if (!function_exists('_modulelowerSingularName')) {
    function _modulelowerSingularName(string $moduleName)
    {
        return Str::lower(Str::singular($moduleName));
    }
}

/*
|--------------------------------------------------------------------------
| Module Singular
|--------------------------------------------------------------------------
|
|
| @return string
|
 */
if (!function_exists('_moduleSingular')) {
    function _moduleSingular(string $moduleName)
    {
        return Str::singular($moduleName);
    }
}

/*
|--------------------------------------------------------------------------
| Module Has Route
|--------------------------------------------------------------------------
|
|
| @return string
|
 */
if (!function_exists('_moduleHasRoute')) {
    function _moduleHasRoute(string $moduleName)
    {
        return _config($moduleName, 'routes.' . ((_is_admin())? 'Panel' : 'Front' ) . (_is_api() ? '.api' : '.web'));
    }
}

/*
|--------------------------------------------------------------------------
| Module Namespace
|--------------------------------------------------------------------------
|
|
| @return string
|
 */
if (!function_exists('_moduleNamespace')) {
    function _moduleNamespace(string $moduleName)
    {
        $is_back_end = '.' . ((_is_admin())? 'Panel' : 'Front' );
        $is_api = _is_api() ? '.api' : '.web';
        $ruleConfig = _config($moduleName, 'routes' . $is_back_end . $is_api);
        return $moduleName . '\Http\Controllers' . ((_is_admin() && $ruleConfig) ? '\Panel' : ((!_is_admin() && $ruleConfig) ? '\Front' : ''));
    }
}

/*
|--------------------------------------------------------------------------
| Module Middleware
|--------------------------------------------------------------------------
|
|
| @return string
|
 */
if (!function_exists('_moduleMiddleware')) {
    function _moduleMiddleware(string $moduleName, string $type = 'guest')
    {
        $middleware = [];
        $middleware = _config($moduleName, 'middleware.' . ((_is_admin())? 'Panel' : 'Front' ) . '.' . (_is_api() ? 'api' : 'web') . '.' . $type);
        $tenant = _config($moduleName, 'middleware.' . ((_is_admin())? 'Panel' : 'Front' ) . '.' . (_is_api() ? 'api' : 'web') . '.tenant');

        if($tenant)
            array_push($middleware,'tenant');

        return $middleware;
    }
}

/*
|--------------------------------------------------------------------------
| Module Config variable
|--------------------------------------------------------------------------
|
|
| @return data
|
 */
if (!function_exists('_config')) {
    function _config(string $moduleName, string $path)
    {
        return config(Str::lower(_moduleName($moduleName)).'-m.' . $path);
    }
}

/*
|--------------------------------------------------------------------------
| Module Localization
|--------------------------------------------------------------------------
|
|
| @return string
|
 */
if (!function_exists('_trans')) {
    function _trans(string $moduleName, string $path, $count = null, $array = [])
    {

        if(is_int($count))
            return trans_choice(_moduleName($moduleName) . '::index.' . $path, $count, $array);

        return __(_moduleName($moduleName) . '::index.' . $path, $array);
    }
}

/*
|--------------------------------------------------------------------------
| Module Exists
|--------------------------------------------------------------------------
|
| @return string
|
 */

// get all modules folders name as modules names
if (!function_exists('_systemModules')) {
    function _systemModules()
    {
        $modules = [];
        // $modules_dir = scandir(app_path('Modules' . _DS()));

        // foreach($modules_dir as $dir){
        //     if(is_dir($dir) && ($dir != '.') && ($dir != '..'))
        //     dd($dir);
        //         // array_push($modules, $dir);
        // }
        return $modules;
    }
}

// check if module name in config file for module same
if (!function_exists('_moduleExist')) {
    function _moduleExist(string $moduleName)
    {
        try {
            $config = _config(Str::lower(_moduleSingular(Str::ucfirst($moduleName))), 'module.name');
            return ($config == $moduleName) ? true : false ;
        } catch (\Throwable $th) {
            return false ;
        }
    }
}

// checkif modules if found by call moduleExist fun.
if (!function_exists('_anyModuleExist')) {
    function _anyModuleExist(array $modules)
    {
        $exist = false;
        foreach($modules as $moduleName){
            if(_moduleExist($moduleName))
                $exist = true;
        }

        return $exist;
    }
}
