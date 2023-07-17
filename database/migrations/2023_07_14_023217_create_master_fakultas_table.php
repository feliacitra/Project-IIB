<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterFakultasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_fakultas', function (Blueprint $table) {
            $table->id('mf_id');
            $table->string('mf_name')->unique();
            $table->unsignedBigInteger('mu_id');
            $table->foreign('mu_id')->references('mu_id')->on('master_universitas');
            $table->string('mf_description')->nullable();
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
        Schema::dropIfExists('master_fakultas');
    }
}
