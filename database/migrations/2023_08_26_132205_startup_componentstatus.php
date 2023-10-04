<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class StartupComponentstatus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('startup_componentstatus', function (Blueprint $table) {
            $table->id('scs_id');
            $table->string('scs_notes')->nullable();
            // $table->foreignId('ra_id')->nullable()->constrained('registation_answer', 'ra_id');
            $table->foreignId('ms_id')->nullable()->constrained('master_startup', 'ms_id');
            $table->timestamps();
            $table->tinyInteger('scs_totalscore');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('status_componentstatus');
    }
}
