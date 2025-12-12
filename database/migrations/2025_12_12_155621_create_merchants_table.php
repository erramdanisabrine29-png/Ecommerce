<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('merchants', function (Blueprint $table) {
            $table->id('id_merchant');

            // Foreign key user
            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')->references('id_user')->on('users')->onDelete('cascade');

            $table->string('company_name');
            $table->string('siret')->nullable();
            $table->string('iban')->nullable();
            $table->string('phone')->nullable();

            $table->text('address')->nullable();
            $table->string('city')->nullable();
            $table->string('country')->nullable();
            $table->string('postal_code')->nullable();

            $table->string('currency')->default('EUR');
            $table->decimal('balance', 10, 2)->default(0);

            $table->date('registration_date')->nullable();
            $table->decimal('sale_rate', 5, 2)->nullable();
            $table->decimal('average_rating', 3, 2)->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('merchants');
    }
};
