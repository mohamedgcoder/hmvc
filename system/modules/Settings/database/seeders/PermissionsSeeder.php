<?php

namespace module\Settings\Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Module\Permissions\Database\Seeders\Permissions as SeedersPermissions;

class PermissionsSeeder extends Seeder
{
    protected $module;
    protected $Role_names;
    protected $Permissions;
    protected $guard_name;

    public function __construct()
    {
        // set module
        $this->module = Str::lower(basename(dirname(__DIR__, 2)));

        // set Permissions to roles
        $this->Role_names = [
            'owner', 'ceo', 'general manager',
        ];

        $this->Permissions = [
            'view '.$this->module,
            'search '.$this->module,
            'add '._moduleSingular($this->module),
            'view '._moduleSingular($this->module),
            'edit '._moduleSingular($this->module),
            'delete '._moduleSingular($this->module),
            'trash '._moduleSingular($this->module),
            'restore '._moduleSingular($this->module),
            'change '._moduleSingular($this->module).' status',
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
        new SeedersPermissions($data);
    }
}
