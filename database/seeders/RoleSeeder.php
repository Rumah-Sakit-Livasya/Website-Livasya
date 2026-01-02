<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create Roles
        $superAdmin = Role::create(['name' => 'super-admin']);
        $user = Role::create(['name' => 'user']);
        $pelamar = Role::create(['name' => 'pelamar']);

        // Give all permissions to Super Admin (optional if using Gate::before)
        // For now we just create the roles.

        // Assign 'super-admin' to the first user if exists
        $firstUser = User::first();
        if ($firstUser) {
            $firstUser->assignRole($superAdmin);
        }
    }
}
