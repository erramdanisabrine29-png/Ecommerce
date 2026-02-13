<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class MerchantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create merchant users
        $merchants = [
            [
                'name' => 'John Merchant',
                'email' => 'john@example.com',
                'password' => bcrypt('password'),
                'company_name' => 'TechHub Store',
                'siret' => '12345678901234',
            ],
            [
                'name' => 'Sarah Fashion',
                'email' => 'sarah@example.com',
                'password' => bcrypt('password'),
                'company_name' => 'Fashion Paris',
                'siret' => '98765432109876',
            ],
            [
                'name' => 'Alex Electronics',
                'email' => 'alex@example.com',
                'password' => bcrypt('password'),
                'company_name' => 'Electronics Store',
                'siret' => '11223344556677',
            ],
        ];

        foreach ($merchants as $merchantData) {
            $user = User::firstOrCreate(
                ['email' => $merchantData['email']],
                [
                    'name' => $merchantData['name'],
                    'password' => $merchantData['password'],
                ]
            );

            // Create or update merchant record
            \DB::table('merchants')->updateOrInsert(
                ['user_id' => $user->id],
                [
                    'company_name' => $merchantData['company_name'],
                    'siret' => $merchantData['siret'],
                    'country' => 'France',
                    'currency' => 'EUR',
                    'balance' => 0,
                    'sale_rate' => 0.05,
                    'average_rating' => 0,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );

            // Assign Merchant role
            $user->assignRole('Merchant');
        }

        $this->command->info('Merchants seeded successfully!');
    }
}
