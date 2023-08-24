<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStartupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('startup', function (Blueprint $table) {
            $table->id();
            $table->date('ms_startdate');
            $table->date('ms_enddate')->nullable();
            $table->string('ms_pks')->nullable();
            $table->string('ms_link_pks')->nullable();
            $table->unsignedBigInteger('ms_phone');
            $table->string('ms_name');
            $table->text('ms_address')->nullable();
            $table->string('ms_website')->nullable();
            $table->string('ms_logo')->nullable();
            $table->string('ms_socialmedia')->nullable();
            $table->string('ms_legal')->nullable();
            $table->string('ms_link_legal')->nullable();
            $table->tinyInteger('mt_riset')->nullable();
            $table->string('ms_proposal');
            $table->string('ms_pithdeck')->nullable();
            $table->unsignedBigInteger('mm_id');
            $table->string('ms_npwp')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('mpd_id');
            $table->tinyInteger('ms_status');
            $table->timestamps();

            $table->foreign('mm_id')->references('mm_id')->on('master_members');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('startup');
    }
}
