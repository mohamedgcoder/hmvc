<?php

namespace Module\Settings\Http\Controllers\Web\Panel;

use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;
use Stevebauman\Location\Facades\Location;

use Module\Settings\Models\Setting;
use Module\Languages\Models\Translations;

class SettingsController extends Controller
{
    protected string $namespace;
    protected string $module;

    public function __construct() {
        $this->namespace = basename(dirname(__DIR__, 4));
        $this->module = Str::lower($this->namespace);
    }

    /**
     * --
     */
    public function index()
    {
        $title = _trans($this->namespace, 'title');

        // if (!$this->checkPermission('view ' . $this->module, $title)) {
        //     return redirect(Route('panel'));
        // }

        _active_menu([_modulelowerSingularName($this->namespace), $this->module]);

        return view(_moduleName($this->namespace) . '::index', ['namespace' => $this->namespace, 'module' => $this->module], compact(['title']));
    }

    public function identitySettings()
    {
        $this->module = 'identity';
        $title = _trans($this->namespace, $this->module.'.header');

        // if (!$this->checkPermission('view ' . $this->module, $title)) {
        //     return redirect(Route('panel'));
        // }

        _active_menu([_modulelowerSingularName($this->namespace), $this->module]);
        $settings = _settingTranslated('name');

        return view(_moduleName($this->namespace).'::panel.pages.'. $this->module , ['namespace' => $this->namespace] , compact(['title', 'settings']));
    }

    public function appearanceSettings()
    {
        $this->module = 'appearance';
        $title = _trans($this->namespace, $this->module.'.header');

        // if (!$this->checkPermission('view ' . $this->module, $title)) {
        //     return redirect(Route('panel'));
        // }

        _active_menu([_modulelowerSingularName($this->namespace), $this->module]);

        return view(_moduleName($this->namespace).'::panel.pages.'. $this->module , ['namespace' => $this->namespace] , compact(['title']));
    }

    public function systemSettings()
    {
        $this->module = 'system';
        $title = _trans($this->namespace, $this->module.'.header');
        // $location = Location::get();

        // if (!$this->checkPermission('view ' . $this->module, $title)) {
        //     return redirect(Route('panel'));
        // }

        _active_menu([_modulelowerSingularName($this->namespace), $this->module]);

        return view(_moduleName($this->namespace).'::panel.pages.'. $this->module , ['namespace' => $this->namespace] , compact(['title']));
    }

    public function seoSettings()
    {
        $this->module = 'seo';
        $title = _trans($this->namespace, $this->module.'.header');

        // if (!$this->checkPermission('view ' . $this->module, $title)) {
        //     return redirect(Route('panel'));
        // }

        _active_menu([_modulelowerSingularName($this->namespace), $this->module]);
        $settings = _settingTranslated();

        return view(_moduleName($this->namespace).'::panel.pages.'. $this->module , ['namespace' => $this->namespace] , compact(['title', 'settings']));
    }

    public function socialSettings()
    {
        $this->module = 'social';
        $title = _trans($this->namespace, $this->module.'.header');

        // if (!$this->checkPermission('view ' . $this->module, $title)) {
        //     return redirect(Route('panel'));
        // }

        _active_menu([_modulelowerSingularName($this->namespace), $this->module]);

        return view(_moduleName($this->namespace).'::panel.pages.'. $this->module , ['namespace' => $this->namespace] , compact(['title']));
    }

    public function securitySettings()
    {
        $this->module = 'security';
        $title = _trans($this->namespace, $this->module.'.header');

        // if (!$this->checkPermission('view ' . $this->module, $title)) {
        //     return redirect(Route('panel'));
        // }

        _active_menu([_modulelowerSingularName($this->namespace), $this->module]);

        return view(_moduleName($this->namespace).'::panel.pages.'. $this->module , ['namespace' => $this->namespace] , compact(['title']));
    }

    public function integrationsSettings()
    {
        $this->module = 'integrations';
        $title = _trans($this->namespace, $this->module.'.header');

        // if (!$this->checkPermission('view ' . $this->module, $title)) {
        //     return redirect(Route('panel'));
        // }

        _active_menu([_modulelowerSingularName($this->namespace), $this->module]);

        return view(_moduleName($this->namespace).'::panel.pages.'. $this->module , ['namespace' => $this->namespace] , compact(['title']));
    }

    public function update(Request $request)
    {
        try {
            foreach($request->all() as $setting => $value){
                if(Arr::accessible($value)){
                    $key = Setting::where('setting', $setting)->first()->id;
                    foreach($value as $lang => $val){
                        Translations::updateOrCreate([
                            'key' => $key,
                            'lang' => $lang,
                            'module' => 'settings',
                        ], [
                            'value' => $val,
                        ]);
                    }
                }else{
                    // if($setting == 'debug')
                    //     config(['debug' , $value]);

                    // if($setting == 'env')
                    //     env('APP_ENV', $value);

                    // if($setting == 'timezone')
                    //     config(['app.timezone' => $setting]);

                    Setting::where('setting', $setting)->update(['value' => $value]);
                }
            }

            _set_config_settings();

        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     *  GGenerate System key
     */
    public static function generateSystemKey()
    {
        $system_key = sha1(Str::lower(env('APP_NAME')) . Carbon::now() . '-' . 'mgcoder');

        Setting::where(['module' => 'system', 'setting' => 'system_key'])->update(['value' => $system_key]);
        return $system_key;
    }

    /**
     *  GGenerate Secret key
     */
    public static function generateSecretKey()
    {
        $appName = (DB::connection()->getName() == 'tenant')? DB::getDatabaseName() : env('APP_NAME');
        $domain = (DB::connection()->getName() == 'tenant')? Str::lower($appName).'.'.env('APP_NAME').'.'.Str::lower(env('APP_DOMAIN')) : env('APP_NAME').'.'.Str::lower(env('APP_DOMAIN'));
        $secret_key = hash('sha256', Str::lower($appName) . Carbon::now() . 'mgcoder' . Str::lower($domain));

        Setting::where(['module' => 'system', 'setting' => 'secret_key'])->update(['value' => $secret_key]);
        return $secret_key;
    }

    public static function setEnvAttribute(string $key, string $value): bool
    {
        $path = base_path('.env');
        try {
            if (file_exists($path)) {
                file_put_contents($path, str_replace(
                    $key.'='.env($key), $key.'='.$value, file_get_contents($path)
                ));
            }

            return true;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function clearCashe()
    {
        Artisan::call('optimize:clear', ['--quiet' => true]);
    }
}
