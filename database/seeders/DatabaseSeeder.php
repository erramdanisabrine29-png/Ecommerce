<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call([
            // Create roles & permissions first
            \Database\Seeders\RolePermissionSeeder::class,
            // Create admin user
            adminSeeder::class,
            // Create merchant users (new)
            MerchantSeeder::class,
            // Create products for each merchant
            ProductSeeder::class,
        ]);

        
    }
}
