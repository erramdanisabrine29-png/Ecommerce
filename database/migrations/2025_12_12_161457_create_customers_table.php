<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id('id_customer');

            // FK -> user
            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')
                  ->references('id_user')
                  ->on('users')
                  ->onDelete('cascade');

            $table->string('last_name_customer')->nullable();
            $table->string('first_name_customer')->nullable();
            $table->string('email')->unique();
            $table->string('phone')->nullable();

            $table->text('address')->nullable();
            $table->string('city')->nullable();
            $table->string('country')->nullable();
            $table->string('postal_code')->nullable();

            $table->string('gender')->nullable();
            $table->string('preferred_language')->nullable();
            $table->string('preferred_currency')->nullable();

            $table->dateTime('created_at_customer')->nullable();

            $table->decimal('total_spent', 10, 2)->default(0);
            $table->integer('order_count')->default(0);
            $table->integer('loyalty_points')->default(0);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
