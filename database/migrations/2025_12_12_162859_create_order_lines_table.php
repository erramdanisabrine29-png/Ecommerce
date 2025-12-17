<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('order_lines', function (Blueprint $table) {
            $table->id('id_line');

            // $table->foreignId('id_order')->constrained()->cascadOnDelete();

            // $table->foreignId('id_product')->constrained()->cascadOnDelete();
            $table->foreignId('id_order')->references('id_order')->on('orders')->cascadeOnDelete();
            $table->foreignId('id_product')->references('id_product')->on('products');
            $table->integer('quantity');
            $table->decimal('unit_price', 10, 2);
            $table->decimal('total_price', 10, 2);
            $table->decimal('discount', 10, 2)->nullable();

            $table->string('line_status')->nullable();
            $table->dateTime('added_at')->nullable();

            $table->string('order_product_reference')->nullable();
            $table->string('order_product_name')->nullable();
            $table->json('order_product_specs')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('order_lines');
    }
};
