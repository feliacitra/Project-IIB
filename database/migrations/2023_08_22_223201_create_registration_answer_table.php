<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistrationAnswerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registration_answer', function (Blueprint $table) {
            $table->id('ra_id');
            $table->unsignedBigInteger('mqr_id');
            $table->unsignedBigInteger('mq_id');
            $table->unsignedBigInteger('user_id');
            $table->integer('ra_score');

            $table->foreign('mqr_id')->references('mqr_id')->on('master_questionrange');
            $table->foreign('mq_id')->references('id')->on('master_question');
            $table->foreign('user_id')->references('id')->on('users');

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
        Schema::dropIfExists('registration_answer');
    }
}
