<?php

namespace module\Settings\Database\Seeders;

use Illuminate\Database\Seeder;
use Module\Settings\Data\Data;
use module\Menus\Database\Seeders\Menus;
use Module\Settings\Database\Seeders\Settings;

class DataSeeder extends Seeder
{
    protected $settings;
    protected $menu;

    public function __construct()
    {
        $this->settings = Data::getSettings();
        $this->menu = Data::getMenu();
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(!empty($this->settings)){
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
            new Settings($this->settings);
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
