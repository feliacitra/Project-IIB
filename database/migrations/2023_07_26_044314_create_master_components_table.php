<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterComponentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_component', function (Blueprint $table) {
            $table->id('mct_id');
            $table->timestamps();
            $table->tinyInteger('mct_step');
            $table->foreignId('mpd_id')->constraint('master_periodeprogram')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('master_component');
    }
}
