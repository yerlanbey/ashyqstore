<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->integer('category_id');
            $table->string('name');
            $table->string('slug');
            $table->text('description')->nullable();
            $table->text('image')->nullable();
            $table->double('price')->default(0);
            $table->tinyInteger('new')->default(0);
            $table->tinyInteger('hit')->default(0);
            $table->tinyInteger('recommend')->default(0);
            $table->string('sales')->nullable();
            $table->string('size')->nullable();
            $table->string('color')->nullable();
            $table->integer('user_id');
            $table->unsignedInteger('count')->default(0);
            $table->integer('shop_id');
            $table->tinyInteger('draft')->default(0);
            $table->softDeletes();
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
        Schema::create('products', function (Blueprint $table) {

            $table->dropColumn('category_id');
            $table->dropColumn('name');
            $table->dropColumn('slug');
            $table->dropColumn('description');
            $table->dropColumn('image');
            $table->dropColumn('price');
            $table->dropColumn('new');
            $table->dropColumn('hit');
            $table->dropColumn('recommend');
            $table->dropColumn('sales');
            $table->dropColumn('size');
            $table->dropColumn('color');
            $table->dropColumn('user_id');
            $table->dropColumn('count');
            $table->dropColumn('shop_id');
            $table->dropColumn('draft');

        });
    }
}
