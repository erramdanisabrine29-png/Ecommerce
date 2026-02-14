<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('stores', function (Blueprint $table) {
            // Add missing columns if they don't exist
            if (!Schema::hasColumn('stores', 'url')) {
                $table->string('url')->nullable()->after('name');
            }
            if (!Schema::hasColumn('stores', 'ssl_certificate_status')) {
                $table->enum('ssl_certificate_status', ['active', 'inactive', 'expired', 'pending'])->default('pending')->after('url');
            }
            if (!Schema::hasColumn('stores', 'tax_rate')) {
                $table->decimal('tax_rate', 5, 2)->default(0)->comment('Tax rate as percentage (e.g., 20.00 for 20%)')->after('ssl_certificate_status');
            }
            if (!Schema::hasColumn('stores', 'minimum_stock')) {
                $table->integer('minimum_stock')->default(10)->comment('Minimum stock level before alert')->after('tax_rate');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('stores', function (Blueprint $table) {
            $table->dropColumnIfExists('url');
            $table->dropColumnIfExists('ssl_certificate_status');
            $table->dropColumnIfExists('tax_rate');
            $table->dropColumnIfExists('minimum_stock');
        });
    }
};
