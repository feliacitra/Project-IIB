<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterQuestionrange extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_questionrange', function (Blueprint $table) {
            $table->id('mqr_id');
            $table->timestamps();
            $table->string('mqr_description');
            $table->integer('mqr_poin');
            $table->foreignId('mq_id')->constraint('master_question')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('master_questionrange');
    }
}
