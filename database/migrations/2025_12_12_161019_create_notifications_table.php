<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id('id_notification');

            // Foreign key
            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')
                  ->references('id_user')
                  ->on('users')
                  ->onDelete('cascade');

            $table->string('type')->nullable();
            $table->text('content')->nullable();
            $table->string('channel')->nullable();
            $table->string('priority')->nullable();
            $table->json('recipients')->nullable();
            $table->boolean('is_read')->default(false);

            $table->dateTime('sent_at')->nullable();
            $table->dateTime('read_at')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
