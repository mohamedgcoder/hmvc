<?php

use Module\Settings\Models\Setting;

/*
|--------------------------------------------------------------------------
| settings
|--------------------------------------------------------------------------
|
| //
|
 */
if (!function_exists('_get_settings')) {
    function _get_settings()
    {
        $settings = [];
        try {
            $data = Setting::with('valueTrans')->where('autoload', 1)->get();

            foreach ($data as $setting) {
                if($setting['translation']){
                    foreach ($setting['valueTrans'] as $trans) {
                        $setting['value'] = $trans['value'];
                    }
                }
                array_push($settings, $setting);
            }
        } catch (\Throwable $th) {
            // throw $th;
        }
        return $settings;
    }
}

if (!function_exists('_settings')) {
    function _settings($module = null, $variable = null)
    {
        try {
            $settings = config('app.settings');
            $modules = [];
            $settingsByModule = [];
            foreach($settings as $setting){
                if(!in_array($setting['module'] ,$modules)){
                    $settingsByModule[$setting['module']] = [];
                    array_push($modules, $setting['module']);
                }
                $settingsByModule[$setting['module']][$setting['setting']] = $setting['value'];
            }

            if($variable != null)
                return (isset($settingsByModule[$module][$variable]))? $settingsByModule[$module][$variable] : null;

            if($module != null)
                return (isset($settingsByModule[$module]))? $settingsByModule[$module] : null;

            return $settingsByModule;
        } catch (\Throwable$th) {
            throw $th;
        }
    }
}

if (!function_exists('_settingTranslated')) {
    function _settingTranslated($variable = null, $lang = null)
    {
        try {
            $settingTranslations = [];
            $settings = Setting::with('translations')->get();

            foreach ($settings as $setting) {
                foreach ($setting['translations'] as $translation) {
                    $settingTranslations[$setting['setting']][$translation['lang']] = $translation['value'];
                }
            }

            // set un saved language
            foreach(explode(',', _settings('language', 'available_locales')) as $local){
                foreach ($settingTranslations as $key => $trans) {
                    if(!array_key_exists($local, $trans))
                        $settingTranslations[$key][$local] = $trans[_default_lang()];
                }
            }

            // if request setting and spec. lang
            if($variable !== null && $lang !== null)
                return (isset($settingTranslations[$variable][$lang]))? $settingTranslations[$variable][$lang] : null;

            // if request spec. setting
            if($variable !== null)
                return (isset($settingTranslations[$variable]))? $settingTranslations[$variable] : null;


            return $settingTranslations;
        } catch (\Throwable$th) {
            throw $th;
        }
    }
}

/*
|--------------------------------------------------------------------------
| config settings
|--------------------------------------------------------------------------
|
| // config settings
|
 */
if (!function_exists('_set_config_settings')) {
    function _set_config_settings()
    {
        try {
            // set setting congigration
            $systemConfig = _get_settings();
            config(['app.settings' => $systemConfig]);
        } catch (\Throwable $th) {
            // throw $th;
        }
    }
}

/*
|--------------------------------------------------------------------------
| timezone data
|--------------------------------------------------------------------------
|
| //
|
 */
if (!function_exists('_get_timezone')) {
    function _get_timezone()
    {
        $timezone = [];
        try {
            $file = _RD(). 'assets/global/data/continents/en/continent.json';
            $timezone = json_decode(file_get_contents($file), true);
        } catch (\Throwable $th) {
            // throw $th;
        }
        return $timezone;
    }
}

/*
|--------------------------------------------------------------------------
| logout All Users
|--------------------------------------------------------------------------
|
| //
|
 */
if (!function_exists('_logoutAllUsers')) {
    function _logoutAllUsers()
    {
        $sessions = glob(storage_path("framework/sessions/*"));
        foreach($sessions as $file){
        if(is_file($file))
            unlink($file);
        }
    }
}

/*
|--------------------------------------------------------------------------
| Clear Log Files
|--------------------------------------------------------------------------
|
| //
|
 */
if (!function_exists('_clearLogs')) {
    function _clearLogs()
    {
        $logs = glob(storage_path("logs/*"));
        foreach($logs as $log){
        if(is_file($log))
            unlink($log);
        }
    }
}

/*
|--------------------------------------------------------------------------
| Clear Views
|--------------------------------------------------------------------------
|
| //
|
 */
if (!function_exists('_clearViews')) {
    function _clearViews()
    {
        $views = glob(storage_path("framework/views/*"));
        foreach($views as $view){
        if(is_file($view))
            unlink($view);
        }
    }
}
