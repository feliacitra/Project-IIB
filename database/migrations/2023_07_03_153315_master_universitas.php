<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MasterUniversitas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      //
            Schema::create('master_universitas', function (Blueprint $table) {
            $table->id('mu_id');
            $table->string('mu_name');
            $table->string('mu_description')->nullable();
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
      Schema::dropIfExists('master_universitas');
    }
}
