<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * Adds 'connected' boolean column to stores table to track Shopify connection status.
     */
    public function up(): void
    {
        Schema::table('stores', function (Blueprint $table) {
            // Add connected boolean column (default false)
            $table->boolean('connected')->default(false)->after('store_token');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('stores', function (Blueprint $table) {
            $table->dropColumn('connected');
        });
    }
};

