<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RegistationAnswer extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('registation_answer', function (Blueprint $table) {
            $table->id('ra_id');
            $table->integer('ra_score');
            $table->timestamps();
            // $table->unsignedBigInteger('mqr_id');
            // $table->unsignedBigInteger('mq_id');
            // $table->unsignedBigInteger('user_id');

            // $table->foreign('mqr_id')->references('mqr_id')->on('master_questionrange')->restrictOnDelete();
            // $table->foreign('mq_id')->references('id')->on('master_question')->restrictOnDelete();
            // $table->foreign('user_id')->references('id')->on('users')->restrictOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('registation_answer');
    }
}
