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
        Schema::create('master_startup', function (Blueprint $table) {
            $table->id('ms_id');
            $table->date('ms_startdate');
            $table->date('ms_enddate')->nullable();
            $table->string('ms_pks')->nullable();
            $table->unsignedBigInteger('ms_phone');
            $table->string('ms_name')->nullable();
            $table->text('ms_address')->nullable();
            $table->string('ms_website')->nullable();
            $table->string('ms_logo')->nullable();
            $table->string('ms_socialmedia')->nullable();
            $table->string('ms_legal')->nullable();
            $table->string('ms_link_legal')->nullable();
            $table->tinyInteger('mt_riset')->nullable();
            $table->string('ms_email');
            $table->string('ms_yearly_income')->nullable();
            $table->string('ms_year_founded')->nullable();
            $table->string('ms_funding_sources')->nullable();
            $table->string('ms_focus_area')->nullable();
            // $table->unsignedBigInteger('mm_id');
            $table->string('ms_npwp')->nullable();
            $table->string('ms_pitchdeck')->nullable();
            $table->unsignedBigInteger('user_id');
            // $table->unsignedBigInteger('mpd_id');
            $table->tinyInteger('ms_status');
            $table->timestamps();

            $table->foreignId('mc_id')->nullable()->constrained('master_categories', 'mc_id')->nullable();
            $table->foreignId('mpd_id')->nullable()->constrained('master_periodeprogram', 'mpd_id')->nullable();
            // $table->foreignId('mpd_id')->references('mpd_id')->on('master_periodeprogram');
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
