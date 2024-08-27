<?php

namespace module\Settings\Database\Seeders;

use Module\Settings\Models\Setting;
use Illuminate\Database\Seeder;
use Module\Languages\Models\Translations;

class Settings extends Seeder
{
    protected $SettingsData;

    public function __construct(array $data)
    {
        // set Setting Data
        $this->SettingsData = $data;

        $this->run();
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // save settings
        $this->storeSettings();
    }

    public function storeSettings()
    {
        foreach($this->SettingsData as $module => $settings){
            foreach ($settings as $setting) {
                $id = Setting::insertGetId([
                    'setting' => $setting['key'],
                    'value' => $setting['translation']? null : $setting['value'],
                    'translation' => $setting['translation'],
                    'module' => $module,
                    'created_by' => 1
                ]);

                // if setting has translation
                if($setting['translation']){
                    foreach ($setting['value'] as $k => $value) {
                        Translations::create([
                            'key' => $id,
                            'value' => $value,
                            'lang' => $k,
                            'module' => $module,
                        ]);
                    }
                }
            }
        }
    }
}
