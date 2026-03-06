<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * Adds webhook_secret column back to stores table.
     * This column stores the plain webhook secret (for display/reference)
     * while webhook_secret_encrypted stores the encrypted version for security.
     */
    public function up(): void
    {
        Schema::table('stores', function (Blueprint $table) {
            // Add webhook_secret column if it doesn't exist
            if (!Schema::hasColumn('stores', 'webhook_secret')) {
                $table->string('webhook_secret')->nullable()->after('webhook_secret_encrypted');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('stores', function (Blueprint $table) {
            $table->dropColumnIfExists('webhook_secret');
        });
    }
};

