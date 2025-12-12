<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id('id_order');

            $table->unsignedBigInteger('id_site');
            $table->foreign('id_site')->references('id_site')->on('sites')->onDelete('cascade');

            $table->unsignedBigInteger('id_customer');
            $table->foreign('id_customer')->references('id_customer')->on('customers')->onDelete('cascade');

            $table->string('reference');
            $table->string('channel')->nullable();

            $table->dateTime('created_at_order')->nullable();
            $table->dateTime('paid_at')->nullable();
            $table->dateTime('delivery_date')->nullable();
            $table->dateTime('cancellation_date')->nullable();

            $table->string('order_status')->nullable();
            $table->decimal('total_amount', 10, 2);
            $table->decimal('shipping_amount', 10, 2)->nullable();
            $table->decimal('discount', 10, 2)->nullable();

            $table->text('shipping_address')->nullable();
            $table->text('billing_address')->nullable();

            $table->text('customer_notes')->nullable();
            $table->text('internal_notes')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
