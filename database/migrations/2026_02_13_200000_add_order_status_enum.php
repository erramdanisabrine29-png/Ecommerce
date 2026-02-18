<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOrderStatusEnum extends Migration
{
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->enum('order_status', [
                'NEW ORDER', 'CONFIRMED', 'NO ANSWER', 'BUSY', 'CANCELLED',
                'CALL LATER', 'DOUBLE COMMANDE', 'LIVRED', 'REFUSED'
            ])->default('NEW ORDER')->change();
        });
    }

    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('order_status')->change();
        });
    }
}
