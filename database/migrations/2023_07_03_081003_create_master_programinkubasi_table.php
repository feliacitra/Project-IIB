<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterProgramInkubasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_programinkubasi', function (Blueprint $table) {
            $table->id('mpi_id');
            $table->string('mpi_name');
            $table->string('mpi_description')->nullable();
            $table->string('mpi_type');
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
        Schema::dropIfExists('master_programinkubasi');
    }
}
