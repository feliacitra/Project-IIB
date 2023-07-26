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
        Schema::create('master_components', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->primary('mct_id');
            $table->tinyInteger('mct_step');
            $table->foreignId('mpd_id')->constrained('master_periodeprogram');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('master_components');
    }
}
