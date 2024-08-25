<?php

namespace languages\Database\Seeders;

use Illuminate\Database\Seeder;
use Permissions\Database\Seeders\Permissions as SeedersPermissions;

class PermissionsSeeder extends Seeder
{
    protected $module;
    protected $Role_names;
    protected $Permissions;
    protected $guard_name;

    public function __construct()
    {
        // set Permissions to roles
        $this->Role_names = [
            'owner', 'ceo', 'general manager',
        ];

        $this->Permissions = [
            'add language', 'view languages', 'view language', 'edit language', 'delete language',
            'trash language', 'restore language', 'change language status',
        ];

        $this->guard_name = 'admin';
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data['Role_names'] = $this->Role_names;

        $data['Permissions'] = $this->Permissions;

        $data['guard_name'] = $this->guard_name;

        // create Permissions
        $permissions = new SeedersPermissions($data);
    }
}
