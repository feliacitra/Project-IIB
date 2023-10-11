<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PresentationEvaluator extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('presentation_evaluator', function (Blueprint $table) {
            $table->id('pe_id');
            $table->foreignId('ps_id')->nullable()->constrained('presentation_schedules', 'ps_id')->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->constrained('users', 'id');
            $table->foreignId('scs_id')->nullable()->constrained('startup_componentstatus', 'scs_id');
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
    }
}