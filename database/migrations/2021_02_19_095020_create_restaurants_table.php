<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRestaurantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('restaurants', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->string('work_time');
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->integer('user_id');
            $table->string('theme_code');
            $table->text('image')->nullable();
            $table->tinyInteger('active')->default(0);
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
        Schema::create('restaurants', function (Blueprint $table) {
            $table->dropColumn('name');
            $table->dropColumn('slug');
            $table->dropColumn('work_time');
            $table->dropColumn('address');
            $table->dropColumn('phone');
            $table->dropColumn('user_id');
            $table->dropColumn('theme_code');
            $table->dropColumn('image');
            $table->dropColumn('active');
        });
    }
}
