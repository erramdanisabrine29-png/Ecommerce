<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get a user to associate customers with (for user_id field)
        $user = User::first();
        
        if (!$user) {
            $this->command->warn('No users found. Please run UserSeeder first.');
            return;
        }

        $customers = [
            [
                'first_name_customer' => 'John',
                'last_name_customer' => 'Doe',
                'email' => 'john.doe@example.com',
                'phone' => '+33 1 23 45 67 89',
                'address' => '123 Rue de la Paix',
                'city' => 'Paris',
                'country' => 'France',
                'postal_code' => '75001',
            ],
            [
                'first_name_customer' => 'Jane',
                'last_name_customer' => 'Smith',
                'email' => 'jane.smith@example.com',
                'phone' => '+33 1 98 76 54 32',
                'address' => '456 Avenue des Champs-Élysées',
                'city' => 'Paris',
                'country' => 'France',
                'postal_code' => '75008',
            ],
            [
                'first_name_customer' => 'Michael',
                'last_name_customer' => 'Johnson',
                'email' => 'michael.johnson@example.com',
                'phone' => '+33 6 12 34 56 78',
                'address' => '789 Boulevard Saint-Germain',
                'city' => 'Paris',
                'country' => 'France',
                'postal_code' => '75006',
            ],
            [
                'first_name_customer' => 'Emily',
                'last_name_customer' => 'Brown',
                'email' => 'emily.brown@example.com',
                'phone' => '+33 6 87 65 43 21',
                'address' => '321 Rue du Faubourg Saint-Antoine',
                'city' => 'Paris',
                'country' => 'France',
                'postal_code' => '75012',
            ],
            [
                'first_name_customer' => 'David',
                'last_name_customer' => 'Wilson',
                'email' => 'david.wilson@example.com',
                'phone' => '+33 6 55 44 33 22',
                'address' => '654 Place de la Concorde',
                'city' => 'Paris',
                'country' => 'France',
                'postal_code' => '75008',
            ],
        ];

        foreach ($customers as $customerData) {
            // Check if customer already exists by email
            $existingCustomer = Customer::where('email', $customerData['email'])->first();
            
            if (!$existingCustomer) {
                Customer::create([
                    'user_id' => $user->id,
                    'first_name_customer' => $customerData['first_name_customer'],
                    'last_name_customer' => $customerData['last_name_customer'],
                    'email' => $customerData['email'],
                    'phone' => $customerData['phone'],
                    'address' => $customerData['address'],
                    'city' => $customerData['city'],
                    'country' => $customerData['country'],
                    'postal_code' => $customerData['postal_code'],
                ]);
            }
        }

        $this->command->info('Customers seeded successfully!');
    }
}
