<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Module\Settings\Models\Setting;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // core module and permission seed
        $this->call([
            // core Modules
            \Module\Permissions\Database\Seeders\RolesSeeder::class,
            \Module\General\Database\Seeders\StatusSeeder::class,
            \Module\General\Database\Seeders\TitlesSeeder::class,
            \Module\General\Database\Seeders\GendersSeeder::class,
            \Module\General\Database\Seeders\ConnectionTypesSeeder::class,
            \Module\Languages\Database\Seeders\DataSeeder::class,
            \Module\Menus\Database\Seeders\DataSeeder::class,
            \Module\Admins\Database\Seeders\DataSeeder::class,
            \Module\Settings\Database\Seeders\DataSeeder::class,
            \Module\Contacts\Database\Seeders\EmailsSeeder::class,
            \Module\Contacts\Database\Seeders\PhonesSeeder::class,
            \Module\Contacts\Database\Seeders\SocialAppSeeder::class,

            // System Module

            // Permissions
            \Module\Permissions\Database\Seeders\PermissionsSeeder::class,
            \Module\Settings\Database\Seeders\PermissionsSeeder::class,
            \Module\General\Database\Seeders\PermissionsSeeder::class,
            \Module\Languages\Database\Seeders\PermissionsSeeder::class,
            \Module\Admins\Database\Seeders\PermissionsSeeder::class,
            \Module\Contacts\Database\Seeders\PermissionsSeeder::class,

        ]);

        if(env("APP_TENANCY")){
            // if system is landlord or don't have tenancy
            if(DB::connection()->getName() == 'landlord' || _settings('settings', 'tenancy') == 0){
                $this->call([
                    // core Modules
                    // \Licenses\Database\Seeders\LicensesSeeder::class,
                    // \Tenancy\Database\Seeders\TenantsSeeder::class,

                    // System Modules
                    // \Sectors\Database\Seeders\DataSeeder::class,
                    // \Agents\Database\Seeders\AgentsSeeder::class,

                    // core Permissions
                    // \Licenses\Database\Seeders\PermissionsSeeder::class,
                    // \Tenancy\Database\Seeders\PermissionsSeeder::class,

                    // System Permissions
                    // \Accounts\Database\Seeders\PermissionsSeeder::class,
                    // \Sectors\Database\Seeders\PermissionsSeeder::class,
                    // \Agents\Database\Seeders\PermissionsSeeder::class,
                ]);
            }

            // if system is tenant
            if(DB::connection()->getName() == 'tenant' && _settings('settings', 'tenancy') == 1){
                $this->call([
                    // core Modules

                    // System Module

                    // core Permissions

                    // System Permissions
                    // \Sectors\Database\Seeders\PermissionsSeeder::class,
                    // \Menus\Database\Seeders\PermissionsSeeder::class,
                ]);
            }

            // plugin
            $this->call([
                \Module\Permissions\Database\Seeders\PluginSeeder::class,
                \Module\Settings\Database\Seeders\PluginSeeder::class,
                \Module\Contacts\Database\Seeders\PluginSeeder::class,
                \Module\General\Database\Seeders\PluginSeeder::class,
                \Module\Languages\Database\Seeders\PluginSeeder::class,
                // \Plugins\Database\Seeders\PluginsSeeder::class,
                // \Tenancy\Database\Seeders\PluginSeeder::class,
                // \Licenses\Database\Seeders\PluginSeeder::class,
                \Module\Admins\Database\Seeders\PluginSeeder::class,
                // \Agents\Database\Seeders\PluginSeeder::class,
                // \Sectors\Database\Seeders\PluginSeeder::class,
                // \Accounts\Database\Seeders\PluginSeeder::class,
                // \Companies\Database\Seeders\PluginSeeder::class,
                // \Brands\Database\Seeders\PluginSeeder::class,
                // \Menus\Database\Seeders\PluginSeeder::class,
            ]);
        }
    }
}
