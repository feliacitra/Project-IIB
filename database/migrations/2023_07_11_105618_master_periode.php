<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MasterPeriode extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_periode', function (Blueprint $table) {
            $table->id('mpe_id');
            $table->date('mpe_startdate');
            $table->date('mpe_enddate');
            $table->string('mpe_name');
            $table->tinyInteger('mpe_status');
            $table->string('mpe_description')->nullable();
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
        Schema::dropIfExists('master_periode');
    }
}
