<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->string('product_code')->nullable();
            $table->string('food_code')->nullable();
            $table->string('dish_code')->nullable();
            $table->string('name');
            $table->text('comment')->nullable();
            $table->tinyInteger('user_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->dropColumn('product_code');
            $table->dropColumn('food_code');
            $table->dropColumn('dish_code');
            $table->dropColumn('name');
            $table->dropColumn('comment');
            $table->dropColumn('user_id');
        });
    }
}
