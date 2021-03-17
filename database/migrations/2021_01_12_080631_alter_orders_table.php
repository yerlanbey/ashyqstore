<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('address')->nullable();
            $table->string('comment')->nullable();
            $table->string('apartment')->nullable();
            $table->string('floor')->nullable();
            $table->string('date')->nullable();
            $table->string('time')->nullable();
            $table->tinyInteger('payment_spot')->default(0);
            $table->tinyInteger('payment_transfer')->default(0);


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('address');
            $table->dropColumn('comment');
            $table->dropColumn('apartment');
            $table->dropColumn('floor');
            $table->dropColumn('date');
            $table->dropColumn('time');
            $table->dropColumn('payment_spot');
            $table->dropColumn('payment_transfer');


        });
    }
}
