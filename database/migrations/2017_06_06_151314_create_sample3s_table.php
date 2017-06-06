<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSample3sTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sample3s', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title1');
            $table->string('subtitle', 25);
            $table->text('answer001');
            $table->string('email');
            $table->string('start_date');
            $table->integer('number');
            $table->string('zipcode');
            $table->string('password');
            $table->string('image');
            $table->integer('category');
            $table->integer('pref');
            $table->integer('popular');
            $table->integer('display_flg');
            $table->integer('hid')->default(1);
            $table->integer('created_id')->default(1);
            $table->integer('updated_id')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('sample3s');
    }
}
