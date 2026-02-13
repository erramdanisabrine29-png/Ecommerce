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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->decimal('price_ht', 10, 2)->comment('Price excluding tax');
            $table->decimal('tax_rate', 5, 2)->default(0)->comment('Tax percentage');
            $table->integer('stock')->default(0)->comment('Current stock available');
            $table->integer('security_threshold')->default(10)->comment('Minimum stock before alert');
            $table->json('characteristics')->nullable()->comment('Product features (color, size, etc)');
            $table->json('images')->nullable()->comment('Product images URLs/paths');
            $table->json('sales_statistics')->nullable()->comment('Sales data (sold, views, etc)');
            $table->foreignId('store_id')->constrained()->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();

            // Performance indexes
            $table->index('store_id');
            $table->index('stock');
            $table->index('created_at');
            $table->fullText(['name', 'description']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
