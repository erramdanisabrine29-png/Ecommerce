<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * Adds Shopify connection fields and store_token for webhook URL generation.
     */
    public function up(): void
    {
        Schema::table('stores', function (Blueprint $table) {
            // Shopify connection fields
            $table->string('shopify_domain')->nullable()->after('webhook_secret_encrypted');
            $table->text('shopify_token')->nullable()->after('shopify_domain');
            $table->timestamp('shopify_connected_at')->nullable()->after('shopify_token');
            
            // Store token for webhook URL (unique identifier)
            $table->string('store_token')->unique()->nullable()->after('shopify_connected_at');
            
            // Remove old unencrypted webhook_secret (keeping only encrypted version)
            if (Schema::hasColumn('stores', 'webhook_secret')) {
                $table->dropColumn('webhook_secret');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('stores', function (Blueprint $table) {
            // Add back webhook_secret
            $table->string('webhook_secret')->nullable();
            
            // Drop Shopify connection fields
            $table->dropColumn([
                'shopify_domain',
                'shopify_token',
                'shopify_connected_at',
                'store_token',
            ]);
        });
    }
};

