<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePresentationSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('presentation_schedules', function (Blueprint $table) {
            $table->id('ps_id');
            $table->date('ps_date');
            $table->time('ps_timestart');
            $table->time('ps_timeend');
            $table->tinyInteger('ps_online');
            $table->string('ps_place', 255);
            $table->string('ps_link', 255);
            $table->unsignedBigInteger('mpd_id');
            
            $table->foreign('mpd_id')->references('mpd_id')->on('master_periodeprogram');
            
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
        Schema::dropIfExists('presentation_schedules');
    }
}
