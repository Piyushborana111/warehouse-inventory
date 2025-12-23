<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [
            'warehouse.create',
            'warehouse.update',
            'warehouse.delete',

            'product.create',
            'product.update',
            'product.delete',

            'stock.adjust',
            'stock.view',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        $admin = Role::firstOrCreate(['name' => 'Admin']);
        $manager = Role::firstOrCreate(['name' => 'Manager']);
        $staff = Role::firstOrCreate(['name' => 'Staff']);

        $admin->givePermissionTo(Permission::all());
        $manager->givePermissionTo([
            'warehouse.update',
            'product.create',
            'product.update',
            'stock.adjust',
            'stock.view',
        ]);

        $staff->givePermissionTo([
            'stock.view',
        ]);
    }
}
