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

            $table->unsignedBigInteger('id_order');
            $table->foreign('id_order')->references('id_order')->on('orders')->onDelete('cascade');

            $table->unsignedBigInteger('id_product');
            $table->foreign('id_product')->references('id_product')->on('products')->onDelete('cascade');

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
