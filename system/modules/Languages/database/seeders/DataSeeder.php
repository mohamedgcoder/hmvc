<?php

namespace module\languages\Database\Seeders;

use Module\Languages\Data\Data;
use Illuminate\Database\Seeder;
use Module\Languages\Models\Language;
use Module\Menus\Database\Seeders\Menus;
use Module\Languages\Models\Translations;
use Module\Settings\Database\Seeders\Settings;

class DataSeeder extends Seeder
{
    protected array $menu;
    protected array $Plugin;
    protected array $Languages;
    protected array $Translations;
    protected array $Settings;

    public function __construct()
    {
        $this->Languages = Data::getLanguages();
        $this->Translations = Data::getTranslations();
        $this->Settings = Data::getSettings();
        $this->menu = Data::getMenu();
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->Languages as $languages) {
            $id = Language::insertGetId([
                'arrangement' => $languages['arrangement'],
                'code' => $languages['code'],
                'flag' => $languages['flag'],
                'direction' => $languages['direction'],
                'status' => $languages['status'],
                'created_by' => 1,
            ]);

            foreach ($this->Translations[$id-1] as $translations) {
                Translations::create([
                    'key' => $id,
                    'value' => $translations['name'],
                    'lang' => $translations['lang_code'],
                    'module' => 'languages',
                ]);
            }
        }

        if(!empty($this->Settings)){
            // set setting values
            $this->setSettings();
        }

        if(!empty($this->menu)){
            // set setting values
            $this->setMenu();
        }
    }

    public function setSettings(): bool
    {
        try {
            new Settings($this->Settings);
            return true;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function setMenu(): bool
    {
        try {
            new Menus($this->menu);
            return true;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
