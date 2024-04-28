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
        $role1 = Role::create(['name' => 'Admin']);
        $role2 = Role::create(['name' => 'Employee']);

        Permission::create(['name' => 'admin.dashboard'])->syncRoles([$role1, $role2]);

        Permission::create(['name' => 'admin.product.index'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.product.create'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.product.edit'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.product.delete'])->assignRole($role1);



    }
}
