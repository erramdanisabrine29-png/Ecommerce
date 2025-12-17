<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sites', function (Blueprint $table) {
            $table->id('id_site');

            // Foreign key -> merchant
            $table->foreignId('id_merchant')->references('id_merchant')->on('merchants')->cascadeOnDelete();

            $table->string('site_name');
            $table->string('site_url');
            $table->text('description')->nullable();
            $table->text('logo')->nullable();
            $table->text('favicon')->nullable();
            $table->string('hosting_provider')->nullable();
            $table->boolean('ssl_certificate')->default(false);

            $table->dateTime('created_at_site')->nullable();
            $table->dateTime('synchronized_at')->nullable();

            $table->string('site_type')->nullable();
            $table->decimal('vat_rate', 5, 2)->nullable();
            $table->integer('minimum_stock')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sites');
    }
};
