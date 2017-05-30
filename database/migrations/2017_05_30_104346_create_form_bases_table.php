<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFormBasesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_bases', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('type')->unsigned();
            $table->string('title');
            $table->string('start_date');
            $table->string('end_date');
            $table->string('image')->nullable();
            $table->integer('limit_cnt')->unsigned()->nullable();
            $table->text('body')->nullable();
            $table->string('mail_title')->nullable();
            $table->text('mail_body')->nullable();
            $table->integer('send_flg')->unsigned()->default(1);
            $table->text('comp_msg')->nullable();
            $table->string('aliase', 500);
            $table->integer('display_flg')->unsigned()->default(0);
            $table->string('ad_tag')->nullable();
            $table->integer('created_id')->unsigned()->default(1);
            $table->integer('updated_id')->unsigned()->default(1);
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
        Schema::drop('form_bases');
    }
}
