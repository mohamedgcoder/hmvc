<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
            \Permissions\Database\Seeders\RolesSeeder::class,
            \Settings\Database\Seeders\DataSeeder::class,
            \General\Database\Seeders\StatusSeeder::class,
            \General\Database\Seeders\TitlesSeeder::class,
            \General\Database\Seeders\GendersSeeder::class,
            \General\Database\Seeders\ConnectionTypesSeeder::class,
            \Languages\Database\Seeders\DataSeeder::class,
            \Admins\Database\Seeders\DataSeeder::class,
            \Contacts\Database\Seeders\EmailsSeeder::class,
            \Contacts\Database\Seeders\PhonesSeeder::class,
            \Contacts\Database\Seeders\SocialAppSeeder::class,

            // System Module

            // Permissions
            \Permissions\Database\Seeders\PermissionsSeeder::class,
            \Settings\Database\Seeders\PermissionsSeeder::class,
            \General\Database\Seeders\PermissionsSeeder::class,
            \Languages\Database\Seeders\PermissionsSeeder::class,
            \Admins\Database\Seeders\PermissionsSeeder::class,
            \Contacts\Database\Seeders\PermissionsSeeder::class,

        ]);

        if(env("APP_TENANCY")){
            // if system is landlord or don't have tenancy
            if(DB::connection()->getName() == 'landlord' || _settings('settings', 'tenancy') == 0){
                $this->call([
                    // core Modules
                    \Licenses\Database\Seeders\LicensesSeeder::class,
                    \Tenancy\Database\Seeders\TenantsSeeder::class,

                    // System Module
                    \Sectors\Database\Seeders\DataSeeder::class,
                    \Agents\Database\Seeders\AgentsSeeder::class,

                    // core Permissions
                    \Licenses\Database\Seeders\PermissionsSeeder::class,
                    \Tenancy\Database\Seeders\PermissionsSeeder::class,

                    // System Permissions
                    \Accounts\Database\Seeders\PermissionsSeeder::class,
                    \Sectors\Database\Seeders\PermissionsSeeder::class,
                    \Agents\Database\Seeders\PermissionsSeeder::class,
                ]);
            }

            // if system is tenant
            if(DB::connection()->getName() == 'tenant' && _settings('settings', 'tenancy') == 1){
                $this->call([
                    // core Modules

                    // System Module

                    // core Permissions

                    // System Permissions
                    \Sectors\Database\Seeders\PermissionsSeeder::class,
                    \Menus\Database\Seeders\PermissionsSeeder::class,
                ]);
            }

            // plugin
            $this->call([
                \Permissions\Database\Seeders\PluginSeeder::class,
                \Settings\Database\Seeders\PluginSeeder::class,
                \Contacts\Database\Seeders\PluginSeeder::class,
                \General\Database\Seeders\PluginSeeder::class,
                \Languages\Database\Seeders\PluginSeeder::class,
                \Plugins\Database\Seeders\PluginsSeeder::class,
                \Tenancy\Database\Seeders\PluginSeeder::class,
                \Licenses\Database\Seeders\PluginSeeder::class,
                \Admins\Database\Seeders\PluginSeeder::class,
                \Agents\Database\Seeders\PluginSeeder::class,
                \Sectors\Database\Seeders\PluginSeeder::class,
                \Accounts\Database\Seeders\PluginSeeder::class,
                \Companies\Database\Seeders\PluginSeeder::class,
                \Brands\Database\Seeders\PluginSeeder::class,
                \Menus\Database\Seeders\PluginSeeder::class,
            ]);
        }
    }
}
