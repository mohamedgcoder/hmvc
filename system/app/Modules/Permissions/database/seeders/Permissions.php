<?php

namespace permissions\Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class Permissions extends Seeder
{
    protected $Role_names;
    protected $Permissions;
    protected $guard_name;

    public function __construct(array $data)
    {
        // set Permissions to roles
        $this->Role_names = $data['Role_names'];

        $this->Permissions = $data['Permissions'];

        $this->guard_name = $data['guard_name'];

        $this->run();
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // create Permissions
        $this->createPermission();

        // Assign Permissions to Role
        $this->setPermissionsToRoles();
    }

    public function createPermission()
    {
        foreach ($this->Permissions as $permission) {
            Permission::create(['guard_name' => $this->guard_name, 'name' => $permission]);
        }
    }

    public function setPermissionsToRoles()
    {
        foreach ($this->Role_names as $k => $roleName) {
            // get role by name
            $role = Role::findByName($roleName, $this->guard_name);

            // Assign existing permissions to Role
            $role->givePermissionTo($this->Permissions);
        }
    }
}
