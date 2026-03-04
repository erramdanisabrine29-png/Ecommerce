<?php

namespace Database\Seeders;

use App\Models\Site;
use App\Models\Merchant;
use Illuminate\Database\Seeder;

class SiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get merchants
        $merchants = Merchant::all();

        if ($merchants->isEmpty()) {
            $this->command->warn('No merchants found. Please run MerchantSeeder first.');
            return;
        }

        $sites = [
            [
                'site_name' => 'Main Store - Paris',
                'site_url' => 'https://store-paris.example.com',
                'description' => 'Main physical store in Paris',
                'site_type' => 'physical',
                'vat_rate' => 20.0,
                'minimum_stock' => 10,
            ],
            [
                'site_name' => 'Online Store',
                'site_url' => 'https://online.example.com',
                'description' => 'E-commerce website',
                'site_type' => 'online',
                'vat_rate' => 20.0,
                'minimum_stock' => 5,
            ],
            [
                'site_name' => 'Secondary Store - Lyon',
                'site_url' => 'https://store-lyon.example.com',
                'description' => 'Secondary store in Lyon',
                'site_type' => 'physical',
                'vat_rate' => 20.0,
                'minimum_stock' => 10,
            ],
        ];

        foreach ($merchants as $merchant) {
            foreach ($sites as $siteData) {
                // Check if site already exists for this merchant
                $existingSite = Site::where('id_merchant', $merchant->id_merchant)
                    ->where('site_name', $siteData['site_name'])
                    ->first();

                if (!$existingSite) {
                    Site::create([
                        'id_merchant' => $merchant->id_merchant,
                        'site_name' => $siteData['site_name'],
                        'site_url' => $siteData['site_url'],
                        'description' => $siteData['description'],
                        'site_type' => $siteData['site_type'],
                        'vat_rate' => $siteData['vat_rate'],
                        'minimum_stock' => $siteData['minimum_stock'],
                    ]);
                }
            }
        }

        $this->command->info('Sites seeded successfully!');
    }
}
