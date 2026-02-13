<?php

namespace Database\Seeders;

use App\Models\Store;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class StoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create merchant users with multiple stores
        $merchantRole = Role::where('name', 'Merchant')->first();

        // Merchant 1: Small Business (1 store) - create or update to avoid duplicates
        $merchant1 = User::updateOrCreate(
            ['email' => 'merchant1@example.com'],
            [
                'name' => 'John Merchant',
                'email_verified_at' => now(),
                'password' => bcrypt('password123'),
                'active' => true,
                'language' => 'en',
                'timezone' => 'UTC',
            ]
        );
        if (method_exists($merchant1, 'assignRole')) {
            $merchant1->assignRole('Merchant');
        }

        Store::create([
            'name' => 'TechHub Store',
            'url' => 'https://techhub.example.com',
            'api_key' => Store::generateUniqueApiKey(),
            'ssl_certificate_status' => 'active',
            'tax_rate' => 19.0,
            'minimum_stock' => 15,
            'user_id' => $merchant1->id,
        ]);

        // Merchant 2: Medium Business (2 stores)
        $merchant2 = User::updateOrCreate(
            ['email' => 'merchant2@example.com'],
            [
                'name' => 'Sarah Fashion',
                'email_verified_at' => now(),
                'password' => bcrypt('password123'),
                'active' => true,
                'language' => 'en',
                'timezone' => 'UTC',
            ]
        );
        if (method_exists($merchant2, 'assignRole')) {
            $merchant2->assignRole('Merchant');
        }

        Store::create([
            'name' => 'Fashion Paris',
            'url' => 'https://fashion-paris.example.com',
            'api_key' => Store::generateUniqueApiKey(),
            'ssl_certificate_status' => 'active',
            'tax_rate' => 20.0,
            'minimum_stock' => 25,
            'user_id' => $merchant2->id,
        ]);

        Store::create([
            'name' => 'Fashion London',
            'url' => 'https://fashion-london.example.com',
            'api_key' => Store::generateUniqueApiKey(),
            'ssl_certificate_status' => 'active',
            'tax_rate' => 20.0,
            'minimum_stock' => 20,
            'user_id' => $merchant2->id,
        ]);

        // Merchant 3: Large Business (3 stores)
        $merchant3 = User::updateOrCreate(
            ['email' => 'merchant3@example.com'],
            [
                'name' => 'Alex Electronics',
                'email_verified_at' => now(),
                'password' => bcrypt('password123'),
                'active' => true,
                'language' => 'en',
                'timezone' => 'UTC',
            ]
        );
        if (method_exists($merchant3, 'assignRole')) {
            $merchant3->assignRole('Merchant');
        }

        Store::create([
            'name' => 'ElectroMart US',
            'url' => 'https://electromart-us.example.com',
            'api_key' => Store::generateUniqueApiKey(),
            'ssl_certificate_status' => 'active',
            'tax_rate' => 7.5,
            'minimum_stock' => 50,
            'user_id' => $merchant3->id,
        ]);

        Store::create([
            'name' => 'ElectroMart EU',
            'url' => 'https://electromart-eu.example.com',
            'api_key' => Store::generateUniqueApiKey(),
            'ssl_certificate_status' => 'active',
            'tax_rate' => 21.0,
            'minimum_stock' => 45,
            'user_id' => $merchant3->id,
        ]);

        Store::create([
            'name' => 'ElectroMart Asia',
            'url' => 'https://electromart-asia.example.com',
            'api_key' => Store::generateUniqueApiKey(),
            'ssl_certificate_status' => 'expired',
            'tax_rate' => 10.0,
            'minimum_stock' => 30,
            'user_id' => $merchant3->id,
        ]);
    }
}
