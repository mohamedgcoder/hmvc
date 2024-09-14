<?php

namespace module\contacts\Database\Seeders;

use Illuminate\Database\Seeder;
use Module\Contacts\Data\Data;
use Module\Menus\database\seeders\Menus;
use Module\Settings\Database\Seeders\Settings;

class EmailsSeeder extends Seeder
{
    protected array $settings;
    protected $menu;

    public function __construct()
    {
        $this->settings = Data::getMailSettings();
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
            if(!empty($this->settings)){
                new Settings($this->settings);
            }

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
