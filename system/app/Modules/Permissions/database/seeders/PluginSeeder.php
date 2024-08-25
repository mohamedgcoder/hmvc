<?php

namespace permissions\Database\Seeders;

use Permissions\Data\Plugin;
use Illuminate\Database\Seeder;
use Plugins\Database\Seeders\Plugins;
use Illuminate\Support\Facades\Schema;

class PluginSeeder extends Seeder
{
    protected $Plugin;

    public function __construct()
    {
        $this->Plugin = Plugin::getPluginData();
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(Schema::hasTable('plugins')){
            // set Plugin values
            $this->setPlugin();
        }
    }

    public function setPlugin(): bool
    {
        try {
            new plugins($this->Plugin);
            return true;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
