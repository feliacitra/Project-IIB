<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class HistoryStartup extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('history_startup', function (Blueprint $table) {
            $table->id('hs_id');
            $table->foreignId('user_id')->nullable()->constrained('master_startup', 'user_id');
            $table->foreignId('ms_id');
            $table->bigInteger('mpd_id');
            $table->timestamps();

            // $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('history_startup');
    }
}
