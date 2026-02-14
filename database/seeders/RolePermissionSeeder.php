<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define permissions for different modules
        $permissions = [
            // Users Management
            'users.create', 'users.read', 'users.update', 'users.delete',
            // Products Management
            'products.create', 'products.read', 'products.update', 'products.delete', 'products.publish',
            // Orders Management
            'orders.create', 'orders.read', 'orders.update', 'orders.delete', 'orders.refund',
            // Stores Management
            'stores.create', 'stores.read', 'stores.update', 'stores.delete',
            // Analytics & Reports
            'analytics.read', 'reports.read', 'reports.export',
            // System Settings
            'settings.manage', 'roles.manage'
        ];

        // Create permissions if they don't exist
        foreach ($permissions as $perm) {
            Permission::firstOrCreate(['name' => $perm]);
        }

        // Create roles
        $administrator = Role::firstOrCreate(['name' => 'Administrator']);
        $merchant = Role::firstOrCreate(['name' => 'Merchant']);
        $manager = Role::firstOrCreate(['name' => 'Manager']);
        $employee = Role::firstOrCreate(['name' => 'Employee']);

        // Administrator: Full access to everything
        $administrator->syncPermissions($permissions);

        // Merchant: Commercial access (products, orders, stores)
        $merchantPerms = [
            'products.create', 'products.read', 'products.update', 'products.delete', 'products.publish',
            'orders.read', 'orders.update',
            'stores.create', 'stores.read', 'stores.update',
            'reports.read'
        ];
        $merchant->syncPermissions($merchantPerms);

        // Manager: Analytics access (reports, analytics, some product/order reading)
        $managerPerms = [
            'products.read',
            'orders.read',
            'analytics.read',
            'reports.read', 'reports.export',
            'users.read'
        ];
        $manager->syncPermissions($managerPerms);

        // Employee: Restricted operational access (orders and products reading/updates)
        $employeePerms = [
            'products.read',
            'orders.read', 'orders.update',
            'reports.read'
        ];
        $employee->syncPermissions($employeePerms);
    }
}
