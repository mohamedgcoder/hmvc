<?php

namespace module\contacts\Database\Seeders;

use Illuminate\Database\Seeder;
use Module\Contacts\Data\ContactsData;
use Module\Settings\Database\Seeders\Settings;

class EmailsSeeder extends Seeder
{
    protected array $Settings;

    public function __construct()
    {
        $this->Settings = ContactsData::getMailSettings();
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // store email
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
