<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id('id_payment');

            $table->unsignedBigInteger('id_order');
            $table->foreign('id_order')->references('id_order')->on('orders')->onDelete('cascade');

            $table->string('reference')->nullable();
            $table->string('method')->nullable();
            $table->string('payment_status')->nullable();

            $table->decimal('amount', 10, 2);
            $table->string('currency')->default('EUR');

            $table->dateTime('paid_at')->nullable();
            $table->string('paypal_transaction')->nullable();

            $table->text('comment')->nullable();
            $table->text('refund_reason')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
