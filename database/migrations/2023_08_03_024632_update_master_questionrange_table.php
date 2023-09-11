<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateMasterQuestionrangeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('master_questionrange', function (Blueprint $table) {
            $table->foreignId('mq_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('master_questionrange', function (Blueprint $table) {
            $table->foreignId('mq_id')->constraint('master_question')->onDelete('restrict')->change();
        });
    }
}
