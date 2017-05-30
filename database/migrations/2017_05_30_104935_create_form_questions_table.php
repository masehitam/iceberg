<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFormQuestionsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_questions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id')->unsigned();
            $table->string('name');
            $table->string('name_code');
            $table->integer('columns');
            $table->integer('type')->unsigned();
            $table->text('options')->nullable();
            $table->text('default_value')->nullable();
            $table->integer('required')->unsigned()->nullable();
            $table->integer('min_value')->unsigned()->nullable();
            $table->integer('max_value')->unsigned()->nullable();
            $table->integer('minlength')->unsigned()->nullable();
            $table->integer('maxlength')->unsigned()->nullable();
            $table->string('regex')->nullable();
            $table->string('validation')->nullable();
            $table->integer('rank')->unsigned()->nullable();
            $table->text('description')->nullable();
            $table->integer('display_flg')->unsigned()->default(0);
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
        Schema::drop('form_questions');
    }
}
