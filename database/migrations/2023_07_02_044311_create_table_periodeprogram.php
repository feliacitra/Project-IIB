<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTablePeriodeprogram extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_periodeprogram', function (Blueprint $table) {
            $table->id('mpd_id');
            $table->timestamps();
            $table->foreignId('mpi_id')->constraint('master_programinkubasi')->onDelete('restrict');
            $table->foreignId('mpe_id')->constraint('master_periode')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('master_periodeprogram');
    }
}
