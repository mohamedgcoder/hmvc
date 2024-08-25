<?php

namespace settings\Database\Seeders;

use Illuminate\Database\Seeder;
use Settings\Data\SettingsData;
use Settings\Database\Seeders\Settings;


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
