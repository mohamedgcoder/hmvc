<?php

namespace admins\Database\Seeders;

use Admins\Data\Data;
use Admins\Models\Admin;
use Faker\Factory as Faker;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Languages\Models\Translations;
use Illuminate\Support\Facades\Hash;
use Settings\Database\Seeders\Settings;
use Admins\Data\Settings as DataSettings;
use Admins\Http\Controllers\Web\Panel\AdminsController;

class DataSeeder extends Seeder
{
    protected array $Titles;
    protected $appName;
    protected $domain;
    protected array $Settings;

    public function __construct()
    {
        $this->Titles = Data::getData();
        $this->Settings = DataSettings::getSettings();

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
        foreach($this->Titles as $title){
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

        if(!empty($this->Settings)){
            // set setting values
            $this->setSettings();
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
}
