<?php

use Carbon\Carbon;
use Tenancy\Models\Tenant;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;

use function PHPUnit\Framework\isNull;

/*
|--------------------------------------------------------------------------
| Return RD ( route directory )
|--------------------------------------------------------------------------
|
|
| @return string
|
 */
if (!function_exists('_RD')) {
    function _RD(string $path = null) :string
    {
        return $_SERVER['DOCUMENT_ROOT']. '/' . ($path == null ? '': '/'. $path);
    }
};

/*
|--------------------------------------------------------------------------
| Return DS ( directory separator "\" )
|--------------------------------------------------------------------------
|
|
| @return string
|
 */
if (!function_exists('_DS')) {
    function _DS()
    {
        return DIRECTORY_SEPARATOR; //
    }
}

/*
|--------------------------------------------------------------------------
| Return Reg for email validation
|--------------------------------------------------------------------------
|
|
| @return string
|
 */
if (!function_exists('_reg')) {
    function _reg() :string
    {
        return "/^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/";
    }
};

/*
|--------------------------------------------------------------------------
| Prefix
|--------------------------------------------------------------------------
|
| return prefix value of system for admin - default is dashboard.
|
 */
if (!function_exists('_prefix')) {
    function _prefix(string $type, string $path = null)
    {
        $explode = explode("-", $type);
        if(count($explode) > 1){
            $t = $explode[0];
            $api = "api/";
        }else{
            $t = $type;
            $api = "";
        }

        $prefix = Str::lower(_settings("prefix", $t));

        try {
            if($path == null){
                $Prefix = $api . $prefix;
            }else{
                $Prefix = $api . $prefix . "/" . $path;
            }

            return Str::replace("//", "/", $Prefix);
        } catch (\Throwable$th) {
            throw $th;
        }
    }
};

/*
|--------------------------------------------------------------------------
| Path
|--------------------------------------------------------------------------
|
| return url for system if api or web.
|
 */
// if (!function_exists('_path')) {
//     function _path(string $path = null)
//     {
//         try {
//             return (_is_api()) ? url('api/'.$path) : url($path);
//         } catch (\Throwable$th) {
//             throw $th;
//         }
//     }
// };

/*
|--------------------------------------------------------------------------
| url
|--------------------------------------------------------------------------
|
|
| @return path
|
 */
if (!function_exists('_url')) {
    function _url(string $prefix, $path = null): string
    {
        $prefix = Str::lower(_settings('prefix', $prefix));
        $api = _is_api()? 'api/' : '';

        return url($api . $prefix . '/' . $path);

    }
}

/*
|--------------------------------------------------------------------------
| current type
|--------------------------------------------------------------------------
|
|
| @return boolean
|
 */
// if (!function_exists('_current_type')) {
//     function _current_type()
//     {
//         if (_is_admin()) {
//             return Str::lower('panel');
//         }

//         return Str::lower('dashboard');
//     }
// }

/*
|--------------------------------------------------------------------------
| active menu li
|--------------------------------------------------------------------------
|
|
| @return boolean
|
 */
if (!function_exists('_active_menu')) {
    function _active_menu(array $item)
    {
        session()->forget('menu-item');
        session()->put('menu-item', $item);
    }
}

/*
|--------------------------------------------------------------------------
| Return Human date
|--------------------------------------------------------------------------
|
|  3 minutes 57 seconds ago
|
 */
if (!function_exists('_from')) {
    function _from($date_from, $options = null)
    {
        $options = $options == null ? [
            'parts' => 2,
            'short' => true,
        ] : $options;

        $now = Carbon::now();
        $years = $date_from->diffInYears($now);
        $months = $date_from->copy()->addYear($years)->diffInMonths($now);
        $weeks = $date_from->copy()->addYear($years)->addMonth($months)->diffInWeeks($now);
        $days = $date_from->copy()->addYear($years)->copy()->addMonth($months)->diffInDays($now);
        $hours = $date_from->copy()->addYear($years)->copy()->addMonth($months)->copy()->addDays($days)->diffInHours($now);
        $minutes = $date_from->copy()->addYear($years)->copy()->addMonth($months)->copy()->addDays($days)->addHours($hours)->diffInMinutes($now);
        $seconds = $date_from->copy()->addYear($years)->copy()->addMonth($months)->copy()->addDays($days)->addHours($hours)->addMinutes($minutes)->diffInSeconds($now);

        $from = $now->copy()->subYears($years)->subMonths($months)->subWeeks($weeks)->subDays($days)->subHours($hours)->subMinutes($minutes)->subSeconds($seconds)->diffForHumans($options);

        return $from;
    }
}

if (!function_exists('_auth')) {
    function _auth()
    {
        if(_is_api()) $api = '-api';
        $guard = ((_is_admin())? 'admin' : 'user').$api;
        return Auth::guard($guard)->user();
    }
}


/*
|--------------------------------------------------------------------------
| generate cache name
|--------------------------------------------------------------------------
|
|
|
 */
if (!function_exists('_cache_remember_time')) {
    function _cache_remember_time()
    {
        return _settings('general', 'cache_remember_time');
    }
}

/*
|--------------------------------------------------------------------------
| generate cache name
|--------------------------------------------------------------------------
|
|
|
 */
if (!function_exists('_get_cache_name')) {
    function _get_cache_name(string $key)
    {
        return _settings('settings', 'system_key').'-'.$key.'-'._current_Language().'-'.(Auth::check()? Auth::user()->code : '');
    }
}

/*
|--------------------------------------------------------------------------
| forget cache
|--------------------------------------------------------------------------
|
|
|
 */
if (!function_exists('_forget_cache')) {
    function _forget_cache(string  $cache_name) :bool
    {
        try {
            cache()->forget(_get_cache_name($cache_name));
            return true;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}

/*
|--------------------------------------------------------------------------
| is Admin
|--------------------------------------------------------------------------
|
|
| @return boolean
|
 */
if (!function_exists('_is_admin')) {
    function _is_admin()
    {
        $pathInfoArr = explode('/', request()->getpathInfo());
        if(_is_api()){
            return (isset($pathInfoArr[2]) && $pathInfoArr[2] == _settings('prefix', 'panel')) ? true : false;
        }else{
            return (isset($pathInfoArr[1]) && $pathInfoArr[1] == _settings('prefix', 'panel')) ? true : false;
        }
    }
}

/*
|--------------------------------------------------------------------------
| is api
|--------------------------------------------------------------------------
|
|
| @return boolean
|
 */
if (!function_exists('_is_api')) {
    function _is_api()
    {
        $pathInfoArr = explode('/', request()->getpathInfo());
        $isApi = ($pathInfoArr[1] == 'api' || (isset($pathInfoArr[2]) && $pathInfoArr[2] == 'api'))? true : false;
        return ($isApi) ? true : false;
    }
}

// ________________________________________________________________________________________

/*
|--------------------------------------------------------------------------
| is System Tenancy
|--------------------------------------------------------------------------
|
|
| @return boolean false
|
 */
if (!function_exists('_is_tenancy')) {
    function _is_tenancy()
    {
        return (_settings('settings', 'tenancy') == 1 && Schema::hasTable('tenants'))? true : false ;
    }
}
/*
|--------------------------------------------------------------------------
| is Tenant
|--------------------------------------------------------------------------
|
|
| @return boolean false
|
 */
if (!function_exists('_is_tenant')) {
    function _is_tenant()
    {
        $tenancy = false;
        if(env('APP_TENANCY')){
            $host = request()->getHost();
            $tenancy = ($host != env('APP_DOMAIN'))? true : false ;
        }

        return $tenancy;
    }
}
