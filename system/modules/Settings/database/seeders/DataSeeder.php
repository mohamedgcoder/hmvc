<?php

namespace module\Settings\Database\Seeders;

use Illuminate\Database\Seeder;
use Module\Settings\Data\SettingsData;
use Module\Settings\Database\Seeders\Settings;


class DataSeeder extends Seeder
{
    protected $Settings;

    public function __construct()
    {
        $this->Settings = SettingsData::getSettings();
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(count($this->Settings) > 0){
            new Settings($this->Settings);
        }
    }
}
