<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * Creates a table for storing orders received from Shopify webhooks.
     */
    public function up(): void
    {
        Schema::create('shopify_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('store_id')->constrained('stores')->onDelete('cascade');
            $table->string('shopify_order_id')->unique(); // Shopify's order ID
            $table->string('order_number')->nullable(); // Human-readable order number
            $table->string('customer_email')->nullable();
            $table->string('customer_name')->nullable();
            $table->string('customer_phone')->nullable();
            $table->decimal('total_price', 12, 2)->default(0);
            $table->string('currency', 3)->default('USD');
            $table->string('financial_status')->nullable(); // pending, paid, refunded, etc.
            $table->string('fulfillment_status')->nullable(); // unfulfilled, fulfilled, partial
            $table->string('order_status')->default('new'); // our internal status
            
            // Order data JSON - stores full Shopify order payload
            $table->json('order_data')->nullable();
            
            // Addresses
            $table->text('shipping_address')->nullable();
            $table->text('billing_address')->nullable();
            
            // Shopify-specific fields
            $table->string('shopify_created_at')->nullable();
            $table->string('shopify_updated_at')->nullable();
            $table->string('checkout_id')->nullable();
            $table->string('checkout_token')->nullable();
            
            // Line items count
            $table->integer('line_items_count')->default(0);
            
            // Processing information
            $table->boolean('processed')->default(false);
            $table->timestamp('processed_at')->nullable();
            
            // Timestamps
            $table->timestamps();
            
            // Indexes for performance
            $table->index(['store_id', 'created_at']);
            $table->index(['shopify_order_id', 'store_id']);
            $table->index('customer_email');
            $table->index('order_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shopify_orders');
    }
};

