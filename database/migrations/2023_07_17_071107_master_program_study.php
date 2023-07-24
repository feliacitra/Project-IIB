<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MasterProgramStudy extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_programstudy', function (Blueprint $table) {
            $table->id('mps_id');
            $table->string('mps_name');
            $table->foreignId('mf_id')->constrained('master_fakultas', 'mf_id')->onDelete('restrict');
            $table->string('mps_description')->nullable();
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
        Schema::dropIfExists('master_programstudy');
    }
}
