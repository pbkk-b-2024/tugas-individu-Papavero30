<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesSeeder extends Seeder
{
    public function run(): void
    {
        $role_admin = Role::firstOrCreate(['name' => 'admin']);
        $role_customer = Role::firstOrCreate(['name' => 'customer']);

        $permissions = [
            'create categories', 'read categories', 'update categories', 'delete categories',
            'create suppliers', 'read suppliers', 'update suppliers', 'delete suppliers',
            'create products', 'read products', 'update products', 'delete products',
            'create orders', 'read orders', 'update orders', 'delete orders',
            'create order details', 'read order details', 'update order details', 'delete order details',
            'create feedback', 'read feedback', 'update feedback', 'delete feedback',
            'create supplier products', 'read supplier products', 'update supplier products', 'delete supplier products',
            'create inventories', 'read inventories', 'update inventories', 'delete inventories',
            'create recommendations', 'read recommendations', 'update recommendations', 'delete recommendations',
            'create actions', 'read actions', 'update actions', 'delete actions',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        $role_admin->syncPermissions($permissions);

        $customer_permissions = [
            'create orders', 'read orders',
            'create feedback', 'read feedback',
            'read recommendations',
        ];

        $role_customer->syncPermissions($customer_permissions);
    }
}