<?php

use Jenssegers\Agent\Agent;
use Illuminate\Support\Str;
use Module\Settings\Models\Setting;
use Module\Languages\Models\Language;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;

/*
|--------------------------------------------------------------------------
| languages
|--------------------------------------------------------------------------
|
| //
|
 */
if (!function_exists('_get_languages')) {
    function _get_languages()
    {
        $languages = [];
        try {
            $data = Language::with('nameTrans')->whereIn('code', explode(',', _settings('language', 'available_locales')))->arrangement()->get();

            foreach ($data as $row) {
                $languages[$row['code']]['id'] = $row['id'];
                $languages[$row['code']]['flag'] = $row['flag'];
                $languages[$row['code']]['direction'] = $row['direction'];
                $languages[$row['code']]['status'] = $row['status'];
                $languages[$row['code']]['name'] = $row['name'];
                foreach ($row['nameTrans'] as $trans) {
                    $languages[$row['code']]['trans'][$trans['lang']] = $trans['value'];
                }
            }

        } catch (\Throwable $th) {
            // throw $th;
        }

        return $languages;
    }
}

/*
|--------------------------------------------------------------------------
| current Language
|--------------------------------------------------------------------------
|
| return current language of system
|
 */

if (!function_exists('_current_Language')) {
    function _current_Language()
    {
        return (_is_api()) ? ((request()->header('locale') != null) ? request()->header('locale') : _default_lang()) : ((Session::has('locale')) ? Session::get('locale') : _default_lang());
    }
}

/*
|--------------------------------------------------------------------------
| default lang
|--------------------------------------------------------------------------
|
| return defult language of system
|
 */
if (!function_exists('_default_lang')) {
    function _default_lang()
    {
        $defaultLang = env('APP_LANGUAGE');
        if(!Setting::where(['setting' => 'default_based_on_device', 'module' => 'language'])->first()->value){
            return $defaultLang;
        }

        // check if supported language or not
        foreach(_get_languages() as $key => $value) {
            if(in_array($key, _browser_languages())){
                return $key;
            }
        }

        return $defaultLang;
    }
}

/*
|--------------------------------------------------------------------------
| browser languages
|--------------------------------------------------------------------------
|
| return browser languages
|
 */
if (!function_exists('_browser_languages')) {
    function _browser_languages()
    {
        // get browser accept languages
        $agent = new Agent();
        return $agent->languages();
    }
}

/*
|--------------------------------------------------------------------------
| direction of system
|--------------------------------------------------------------------------
|
| return defult direction for current or default language of system
| rtl - ltr
|
 */
if (!function_exists('_dir')) {
    function _dir()
    {
        try {
            return config('app.languages')[_current_Language()]['direction'];
        } catch (\Throwable $th) {
            return 'rtl';
        }
    }
}

/*
|--------------------------------------------------------------------------
| languages data
|--------------------------------------------------------------------------
|
| //
|
 */
if (!function_exists('_get_all_languages')) {
    function _get_all_languages($code = null)
    {
        $languages = [];
        try {
            $path = _system_path('assets/global/data/languages/'.(($code != null)? $code : _current_Language()));
            if(!File::exists($path)) {
                $path = _system_path('assets/global/data/languages/'._default_lang());
            }
            $file = $path.'/language.json';
            $languages = json_decode(file_get_contents($file), true);
        } catch (\Throwable $th) {
            // throw $th;
        }
        return $languages;
    }
}

// /*
// |--------------------------------------------------------------------------
// | flags from folder
// |--------------------------------------------------------------------------
// |
// | //
// |
//  */
// if (!function_exists('_get_flags')) {
//     function _get_flags()
//     {
//         $flags = [];
//         try {
//             $directory = _RD(). '/assets/global/flags';
//             $flags = array_diff(scandir($directory), ['..', '.', 'svg']);
//         } catch (\Throwable $th) {
//             // throw $th;
//         }
//         return $flags;
//     }
// }

/*
|--------------------------------------------------------------------------
| countries names
|--------------------------------------------------------------------------
|
| //
|
 */
if (!function_exists('_get_countries')) {
    function _get_countries()
    {
        $countries = [];
        try {
            $path = _system_path('assets/global/data/countries/'._current_Language());
            if(!File::exists($path)) {
                $path = _system_path('assets/global/data/countries/'._default_lang());
            }
            $file = $path.'/country.json';
            $countries = json_decode(file_get_contents($file), true);
        } catch (\Throwable $th) {
            // throw $th;
        }
        return $countries;
    }
}

/*
|--------------------------------------------------------------------------
| limit of string
|--------------------------------------------------------------------------
|
| //
|
 */
if (!function_exists('_limit_of')) {
    function _limit_of($string, $limit)
    {
        $string = Str::of($string)->limit($limit, preserveWords:true);
        return $string;
    }
}
