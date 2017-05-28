<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateproductsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('hid');
            $table->string('name');
            $table->string('start_date');
            $table->integer('category')->unsigned();
            $table->string('zipcode');
            $table->integer('company');
            $table->integer('pref');
            $table->string('address01');
            $table->string('address02');
            $table->integer('level');
            $table->integer('rank');
            $table->string('image');
            $table->string('top_image');
            $table->text('description');
            $table->text('position');
            $table->integer('display_flg');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('category')->references('id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('products');
    }
}
