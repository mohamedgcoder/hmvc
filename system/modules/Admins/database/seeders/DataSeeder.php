<?php

namespace module\admins\Database\Seeders;

use Module\Admins\Data\Data;
use Module\Admins\Models\Admin;
use Faker\Factory as Faker;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Module\Languages\Models\Translations;
use Illuminate\Support\Facades\Hash;
use Module\Menus\Database\Seeders\Menus;
use Module\Settings\Database\Seeders\Settings;
use Module\Admins\Data\Settings as DataSettings;
use Module\Admins\Http\Controllers\Web\Panel\AdminsController;

class DataSeeder extends Seeder
{
    protected array $titles;
    protected $appName;
    protected $domain;
    protected $menu;
    protected array $settings;

    public function __construct()
    {
        $this->menu = Data::getMenu();
        $this->titles = Data::getData();
        $this->settings = DataSettings::getSettings();

        $this->appName = (DB::connection()->getName() == 'tenant')? DB::getDatabaseName() : env('APP_NAME');
        $this->domain = (DB::connection()->getName() == 'tenant')? Str::lower($this->appName).'.'.Str::lower(env('APP_DOMAIN')) : Str::lower(env('APP_DOMAIN'));
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach($this->titles as $title){
            $name = ($title == 'developer')? 'mohamed coder' : $title;
            $ownerAdminId = DB::connection('landlord')->table('admins')->where('id', 1)->select(['code'])->first();
            $code = AdminsController::generateAdminCode(($title == 'developer')? 'mohamed coder' : $title);
            Admin::insert([
                'code' => $code,
                'name' => $name,
                'phone' => '+20 '.Faker::create()->numerify('##########'),
                'email' => Str::replace(' ', '_', $title).'@'.$this->domain,
                'email_verified_at' => now(),
                'password' => Hash::make('123456'),
                'can_update_profile' => ($title == 'owner')? 1 : 0,
                'title' => Translations::where(['lang' => 'en', 'module' => 'titles', 'value' => $title])->select(['key'])->first()->key,
                'status' => 2,
                'gender' => (in_array($title, ['hr', 'marketing', 'content_manager']))? 2 : 1 ,
                'profile_pic' => 'users/profile/'.Str::replace(' ', '_', $name).'.png',
                'api_token' => Str::random(64),
                'created_by' => $code
                // 'created_by' => ($ownerAdminId == null)? 1: $ownerAdminId->code
            ]);
        }

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
