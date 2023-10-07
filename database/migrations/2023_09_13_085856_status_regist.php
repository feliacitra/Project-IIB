<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class StatusRegist extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('status_regist', function (Blueprint $table) {
            $table->id('srt_id');
            $table->foreignId('ms_id')->nullable()->constrained('master_startup', 'ms_id');
            $table->timestamps();
            $table->tinyInteger('srt_step');
            $table->string('srt_status')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('status_regist');
    }
}
