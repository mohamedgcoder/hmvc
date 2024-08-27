<?php

namespace module\Contacts\Database\Seeders;

use Module\Contacts\Models\SocialApp;
use Module\Contacts\Data\ContactsData;
use Illuminate\Database\Seeder;

class SocialAppSeeder extends Seeder
{
    protected array $SocialMediaApps;

    public function __construct()
    {
        $this->SocialMediaApps = ContactsData::getSocialMediaApps();
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        try {
            if(!empty($this->SocialMediaApps)){
                foreach($this->SocialMediaApps as $SocialMediaApp){
                    SocialApp::create([
                        'name' => $SocialMediaApp,
                        'created_by' => 1
                    ]);
                }
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
