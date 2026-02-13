<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get merchants from the merchants table that have user_id set
        $merchants = \DB::table('merchants')->pluck('id_merchant');

        if ($merchants->isEmpty()) {
            $this->command->info('No merchants found.');
            return;
        }

        foreach ($merchants as $merchantId) {
            // Tech products
            Product::firstOrCreate(
                ['product_name' => 'Laptop Pro', 'id_merchant' => $merchantId],
                [
                    'reference' => 'LAPTOP-001',
                    'description' => 'Professional laptop for developers',
                    'price_excl_tax' => 999.99,
                    'price_incl_tax' => 1119.99,
                    'tax' => 20,
                    'unit' => 'pcs',
                    'available_stock' => 25,
                    'safety_stock' => 5,
                    'specifications' => json_encode([
                        'color' => 'silver',
                        'processor' => 'Intel i9',
                        'ram' => '32GB',
                        'storage' => '1TB SSD'
                    ]),
                    'images' => json_encode([
                        '/images/laptop-1.jpg',
                        '/images/laptop-2.jpg'
                    ]),
                    'sales_count' => 45,
                    'views_count' => 1250,
                    'average_rating' => 4.8,
                ]
            );

            Product::firstOrCreate(
                ['product_name' => 'Smartphone X', 'id_merchant' => $merchantId],
                [
                    'reference' => 'PHONE-001',
                    'description' => 'Latest smartphone with advanced features',
                    'price_excl_tax' => 799.99,
                    'price_incl_tax' => 959.99,
                    'tax' => 20,
                    'unit' => 'pcs',
                    'available_stock' => 50,
                    'safety_stock' => 10,
                    'specifications' => json_encode([
                        'color' => 'midnight black',
                        'screen' => '6.7 inches',
                        'camera' => '108MP',
                        'battery' => '5000mAh'
                    ]),
                    'images' => json_encode([
                        '/images/phone-1.jpg',
                        '/images/phone-2.jpg'
                    ]),
                    'sales_count' => 120,
                    'views_count' => 2500,
                    'average_rating' => 4.6,
                ]
            );

            Product::firstOrCreate(
                ['product_name' => 'Wireless Headphones', 'id_merchant' => $merchantId],
                [
                    'reference' => 'HEAD-001',
                    'description' => 'Premium noise-canceling headphones',
                    'price_excl_tax' => 299.99,
                    'price_incl_tax' => 359.99,
                    'tax' => 20,
                    'unit' => 'pcs',
                    'available_stock' => 75,
                    'safety_stock' => 15,
                    'specifications' => json_encode([
                        'color' => 'black',
                        'battery' => '30 hours',
                        'driver' => '40mm',
                        'connectivity' => 'Bluetooth 5.2'
                    ]),
                    'images' => json_encode([
                        '/images/headphones-1.jpg'
                    ]),
                    'sales_count' => 200,
                    'views_count' => 3500,
                    'average_rating' => 4.5,
                ]
            );

            Product::firstOrCreate(
                ['product_name' => 'USB-C Charger', 'id_merchant' => $merchantId],
                [
                    'reference' => 'CHARGER-001',
                    'description' => 'Fast charging USB-C charger',
                    'price_excl_tax' => 49.99,
                    'price_incl_tax' => 59.99,
                    'tax' => 20,
                    'unit' => 'pcs',
                    'available_stock' => 200,
                    'safety_stock' => 30,
                    'specifications' => json_encode([
                        'color' => 'white',
                        'power' => '65W',
                        'ports' => '2 USB-C',
                        'certification' => 'PD 3.0'
                    ]),
                    'images' => json_encode([
                        '/images/charger-1.jpg'
                    ]),
                    'sales_count' => 500,
                    'views_count' => 5000,
                    'average_rating' => 4.4,
                ]
            );

            // Fashion products
            Product::firstOrCreate(
                ['product_name' => 'Premium T-Shirt', 'id_merchant' => $merchantId],
                [
                    'reference' => 'TSHIRT-001',
                    'description' => 'High-quality cotton t-shirt',
                    'price_excl_tax' => 29.99,
                    'price_incl_tax' => 35.99,
                    'tax' => 20,
                    'unit' => 'pcs',
                    'available_stock' => 150,
                    'safety_stock' => 20,
                    'specifications' => json_encode([
                        'color' => 'navy blue',
                        'size' => 'L',
                        'material' => '100% cotton',
                        'fit' => 'regular'
                    ]),
                    'images' => json_encode([
                        '/images/tshirt-1.jpg',
                        '/images/tshirt-2.jpg'
                    ]),
                    'sales_count' => 320,
                    'views_count' => 2000,
                    'average_rating' => 4.3,
                ]
            );

            Product::firstOrCreate(
                ['product_name' => 'Denim Jeans', 'id_merchant' => $merchantId],
                [
                    'reference' => 'JEANS-001',
                    'description' => 'Classic denim jeans',
                    'price_excl_tax' => 59.99,
                    'price_incl_tax' => 71.99,
                    'tax' => 20,
                    'unit' => 'pcs',
                    'available_stock' => 100,
                    'safety_stock' => 15,
                    'specifications' => json_encode([
                        'color' => 'dark blue',
                        'size' => '32',
                        'material' => 'cotton denim',
                        'style' => 'slim fit'
                    ]),
                    'images' => json_encode([
                        '/images/jeans-1.jpg'
                    ]),
                    'sales_count' => 180,
                    'views_count' => 1500,
                    'average_rating' => 4.5,
                ]
            );

            Product::firstOrCreate(
                ['product_name' => 'Winter Jacket', 'id_merchant' => $merchantId],
                [
                    'reference' => 'JACKET-001',
                    'description' => 'Warm winter jacket with insulation',
                    'price_excl_tax' => 149.99,
                    'price_incl_tax' => 179.99,
                    'tax' => 20,
                    'unit' => 'pcs',
                    'available_stock' => 40,
                    'safety_stock' => 8,
                    'specifications' => json_encode([
                        'color' => 'black',
                        'material' => 'polyester',
                        'filling' => 'down',
                        'size' => 'M'
                    ]),
                    'images' => json_encode([
                        '/images/jacket-1.jpg',
                        '/images/jacket-2.jpg'
                    ]),
                    'sales_count' => 95,
                    'views_count' => 1200,
                    'average_rating' => 4.7,
                ]
            );

            Product::firstOrCreate(
                ['product_name' => 'Running Shoes', 'id_merchant' => $merchantId],
                [
                    'reference' => 'SHOES-001',
                    'description' => 'Professional running shoes',
                    'price_excl_tax' => 119.99,
                    'price_incl_tax' => 143.99,
                    'tax' => 20,
                    'unit' => 'pcs',
                    'available_stock' => 60,
                    'safety_stock' => 10,
                    'specifications' => json_encode([
                        'color' => 'white/blue',
                        'size' => '42',
                        'material' => 'mesh',
                        'type' => 'running'
                    ]),
                    'images' => json_encode([
                        '/images/shoes-1.jpg'
                    ]),
                    'sales_count' => 210,
                    'views_count' => 1800,
                    'average_rating' => 4.6,
                ]
            );

            // Electronics products
            Product::firstOrCreate(
                ['product_name' => '4K Monitor', 'id_merchant' => $merchantId],
                [
                    'reference' => 'MONITOR-001',
                    'description' => 'Professional 4K display monitor',
                    'price_excl_tax' => 599.99,
                    'price_incl_tax' => 719.99,
                    'tax' => 20,
                    'unit' => 'pcs',
                    'available_stock' => 20,
                    'safety_stock' => 3,
                    'specifications' => json_encode([
                        'size' => '27 inches',
                        'resolution' => '4K',
                        'panel' => 'IPS',
                        'refresh' => '60Hz'
                    ]),
                    'images' => json_encode([
                        '/images/monitor-1.jpg'
                    ]),
                    'sales_count' => 35,
                    'views_count' => 800,
                    'average_rating' => 4.8,
                ]
            );

            Product::firstOrCreate(
                ['product_name' => 'Mechanical Keyboard', 'id_merchant' => $merchantId],
                [
                    'reference' => 'KEYBOARD-001',
                    'description' => 'RGB mechanical keyboard for gaming',
                    'price_excl_tax' => 159.99,
                    'price_incl_tax' => 191.99,
                    'tax' => 20,
                    'unit' => 'pcs',
                    'available_stock' => 80,
                    'safety_stock' => 12,
                    'specifications' => json_encode([
                        'color' => 'black',
                        'type' => 'mechanical',
                        'switches' => 'Cherry MX',
                        'backlight' => 'RGB'
                    ]),
                    'images' => json_encode([
                        '/images/keyboard-1.jpg'
                    ]),
                    'sales_count' => 150,
                    'views_count' => 1600,
                    'average_rating' => 4.7,
                ]
            );

            Product::firstOrCreate(
                ['product_name' => 'Wireless Mouse', 'id_merchant' => $merchantId],
                [
                    'reference' => 'MOUSE-001',
                    'description' => 'Precision wireless mouse',
                    'price_excl_tax' => 49.99,
                    'price_incl_tax' => 59.99,
                    'tax' => 20,
                    'unit' => 'pcs',
                    'available_stock' => 120,
                    'safety_stock' => 20,
                    'specifications' => json_encode([
                        'color' => 'black',
                        'dpi' => '16000',
                        'battery' => '12 months',
                        'connectivity' => '2.4GHz'
                    ]),
                    'images' => json_encode([
                        '/images/mouse-1.jpg'
                    ]),
                    'sales_count' => 280,
                    'views_count' => 2200,
                    'average_rating' => 4.5,
                ]
            );

            Product::firstOrCreate(
                ['product_name' => 'USB Cable (2m)', 'id_merchant' => $merchantId],
                [
                    'reference' => 'CABLE-001',
                    'description' => 'High-quality USB-C cable',
                    'price_excl_tax' => 9.99,
                    'price_incl_tax' => 11.99,
                    'tax' => 20,
                    'unit' => 'pcs',
                    'available_stock' => 500,
                    'safety_stock' => 50,
                    'specifications' => json_encode([
                        'color' => 'black',
                        'length' => '2 meters',
                        'type' => 'USB-C to USB-C',
                        'rating' => '100W'
                    ]),
                    'images' => json_encode([
                        '/images/cable-1.jpg'
                    ]),
                    'sales_count' => 1200,
                    'views_count' => 5500,
                    'average_rating' => 4.4,
                ]
            );
        }

        $this->command->info('Products seeded successfully!');
    }
}
