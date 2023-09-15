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
            $table->bigInteger('mqr_id');
            $table->bigInteger('mq_id');
            $table->timestamps();
            $table->foreignId('user_id')->nullable()->constrained('users', 'id');
            $table->foreignId('scs_id')->nullable()->constrained('startup_componentstatus', 'scs_id');
            $table->integer('ra_score');
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
