<?php

namespace Module\permissions\Database\Seeders;

use Illuminate\Database\Seeder;
use Module\Permissions\Data\Data;
use Module\Menus\database\seeders\Menus;
use Module\Permissions\Database\Seeders\Permissions as SeedersPermissions;

class PermissionsSeeder extends Seeder
{
    protected $Role_names;
    protected $Permissions;
    protected $guard_name;
    protected array $menu;

    public function __construct()
    {
        $Role_names = [
            'owner',
            'ceo',
            'general manager',
            'developer'
        ];

        $Permissions = [
            'add role',
            'view roles',
            'view role',
            'edit role',
            'delete role',
            'trash role',
            'restore role',
            'assign permission to role',
            'assign permission to admin',
            'assign permission to user',
            'view permissions',
        ];

        $guard_name = 'admin';

        // set Permissions to roles
        $this->Role_names = $Role_names;

        $this->Permissions = $Permissions;

        $this->guard_name = $guard_name;

        $this->menu = Data::getMenu();
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

        if(!empty($this->menu)){
            // set setting values
            $this->setMenu();
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
