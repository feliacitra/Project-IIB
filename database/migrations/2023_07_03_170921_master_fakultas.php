<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MasterFakultas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('master_fakultas', function (Blueprint $table) {
            $table->id('mf_id');
            $table->string('mf_name');
            $table->string('mf_description')->nullable();
            $table->foreignId('mu_id')->nullable()->constrained('master_universitas', 'mu_id')->nullable();
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
        //
        Schema::dropIfExists('master_fakultas');
    }
}