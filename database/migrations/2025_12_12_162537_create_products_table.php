<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id('id_product');

            $table->foreignId('id_merchant')->references('id_merchant')->on('merchants')->cascadeOnDelete();


            $table->string('reference')->nullable();
            $table->string('variant_reference')->nullable();
            $table->string('ean')->nullable();

            $table->string('product_name');
            $table->text('description')->nullable();
            $table->json('specifications')->nullable();

            $table->decimal('price_excl_tax', 10, 2);
            $table->decimal('price_incl_tax', 10, 2);
            $table->string('unit')->nullable();
            $table->decimal('tax', 5, 2)->nullable();

            $table->integer('available_stock')->default(0);
            $table->integer('safety_stock')->default(0);

            $table->json('images')->nullable();
            $table->json('documents')->nullable();

            $table->integer('sales_count')->default(0);
            $table->integer('views_count')->default(0);
            $table->decimal('average_rating', 3, 2)->default(0);

            $table->dateTime('updated_at_product')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
