<?php

namespace module\languages\Database\Seeders;

use Module\Languages\Models\Language;
use Illuminate\Database\Seeder;
use Module\Languages\Data\LanguagesData;
use Module\Languages\Models\Translations;
use Module\Settings\Database\Seeders\Settings;

class DataSeeder extends Seeder
{
    protected $Languages;
    protected $Translations;
    protected array $Settings;
    protected $Plugin;

    public function __construct()
    {
        $this->Languages = LanguagesData::getLanguages();
        $this->Translations = LanguagesData::getTranslations();
        $this->Settings = LanguagesData::getSettings();
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

        // set seeting values
        $this->setSettings();
    }

    public function setSettings(): bool
    {
        try {
            if(!empty($this->Settings)){
                new Settings($this->Settings);
                return true;
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
