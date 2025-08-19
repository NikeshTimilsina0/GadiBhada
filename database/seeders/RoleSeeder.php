<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // List of permissions
        $roles = [
            'Admin',
        ];

        // Create each role if it doesn't exist
        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role]);
        }

        $adminRole = Role::where('name', 'Admin')->first();
        $permissions = Permission::all();

        if ($adminRole) {
            $adminRole->givePermissionTo($permissions);
        }
    }
}
