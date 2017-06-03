<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateinfosTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('infos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('link');
            $table->string('zipcode');
            $table->string('image');
            $table->integer('category');
            $table->string('public_date');
            $table->string('start_date');
            $table->string('end_date');
            $table->text('body');
            $table->integer('display_flg');
            $table->integer('toppage_flg');
            $table->integer('popular')->nullable();
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
        Schema::drop('infos');
    }
}
