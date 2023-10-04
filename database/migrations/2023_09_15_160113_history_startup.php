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
            $table->foreignId('ms_id')->nullable()->constrained('master_startup', 'ms_id');
            $table->bigInteger('mpd_id');
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
        Schema::dropIfExists('history_startup');
    }
}
