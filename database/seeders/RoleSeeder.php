<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $role1 = Role::create(['name' => 'Admin']);
        $role2 = Role::create(['name' => 'Employee']);

        Permission::create(['name' => 'admin.dashboard'])->syncRoles([$role1, $role2]);

        Permission::create(['name' => 'admin.category.index'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.category.create'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.category.edit'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.category.delete'])->assignRole($role1);

        Permission::create(['name' => 'admin.product.index'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.product.create'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.product.edit'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.product.delete'])->assignRole($role1);

        Permission::create(['name' => 'admin.users.index'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.users.edit'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.users.update'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.users.create'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.users.store'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.users.delete'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.users.destroy'])->syncRoles([$role1]);

        Permission::create(['name' => 'admin.sale.index'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.sale.create'])->syncRoles([$role1], $role2);
        Permission::create(['name' => 'admin.sale.edit'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.sale.delete'])->assignRole($role1);
    }
}
