<?php

namespace permissions\Database\Seeders;

use Permissions\Data\RolesData;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

use Admins\Models\Admin;

class RolesSeeder extends Seeder
{
    protected $Roles;
    protected $guard_name;

    public function __construct()
    {
        $this->Roles = RolesData::getRoles();

        $this->guard_name = 'admin';
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create Roles
        $this->createRoles();

        // Assign Roles To Admins
        $this->assignRolesToAdmins();
    }

    public function createRoles()
    {
        // Create super admin Role
        Role::create(['guard_name' => $this->guard_name, 'name' => 'super admin']);

        // Create Roles
        foreach($this->Roles as $role){
            Role::create(['guard_name' => $this->guard_name, 'name' => $role]);
        }
    }

    public function assignRolesToAdmins()
    {
        foreach($this->Roles as $roleName){
            // Find admin to assign existing role
            $admin = Admin::where('email', Str::replace(' ', '_', $roleName).'@ordrz.me')->first();
            if($admin)
                $admin->assignRole($roleName);
        }
    }
}
