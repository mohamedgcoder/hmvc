<?php

namespace contacts\Database\Seeders;

use Contacts\Models\SocialApp;
use Contacts\Data\ContactsData;
use Illuminate\Database\Seeder;
use Languages\Models\Translations;

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
